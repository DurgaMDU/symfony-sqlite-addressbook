<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


use Doctrine\ORM\EntityManagerInterface;

//Entity def
use AppBundle\Entity\Addressbook; 

//Form Validation and Form fields types declr
use AppBundle\Form\FormValidationType; 
use AppBundle\Entity\FormValidation; 

use Symfony\Component\Form\FormError;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; 
use Symfony\Component\Form\Extension\Core\Type\PasswordType; 
use Symfony\Component\Form\Extension\Core\Type\RangeType; 
use Symfony\Component\Form\Extension\Core\Type\EmailType; 
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\Extension\Core\Type\ButtonType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\PercentType; 
use Symfony\Component\Form\Extension\Core\Type\RepeatedType; 

class AddressbookController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/addressbook", name="AddressbookController")
     */
    public function indexAction(Request $request)
    {
		$list = $this->getDoctrine() 
	   ->getRepository('AppBundle:Addressbook') 
	   ->findAll();
	   return $this->render('addressbook/index.html.twig', array('data' => $list));
    }

    /**
     * @Route("/addressbook/add")
     */
     
	public function addAction(Request $request)
	{

	   $ABvalidate = new Addressbook(); 
	   $form = $this->createFormBuilder($ABvalidate) 
		  ->add('firstname', TextType::class)
		  ->add('lastname', TextType::class)
		  ->add('streetandnumber', TextType::class) 
		  ->add('zip', TextType::class) 
		  ->add('city', TextType::class) 
		  ->add('country', TextType::class) 
		  ->add('phonenumber', TextType::class) 
		  ->add('email', TextType::class)
		  ->add('birthday', DateType::class, array( 'label' => 'Birthday','widget' => 'choice', 'years' => range(date('Y')-90, date('Y'))))
		  ->add('picture', FileType::class, array('label' => 'Photo (png, jpeg, <=2MB) ','required' => false,'attr' => [ 'accept' => 'image/*'  ])) 
		  ->add('save', SubmitType::class, array('label' => 'Submit')) 
		  ->getForm();  
		  
	   $form->handleRequest($request);  
	   if ($form->isSubmitted() && $form->isValid()) { 
			 
			 $ABvalidate = $form->getData(); 
			 //return new Response('Form is validated.');
			 
			 
			 $imgfile = $ABvalidate->getPicture(); 
			 if($imgfile !== null) {
				 $fileName = md5(uniqid()).'.'.$imgfile->guessExtension(); 
				 $imgfile->move($this->getParameter('photos_directory'), $fileName); 
				 $ABvalidate->setPicture($fileName); 
			 }
			 
			$entityManager = $this->getDoctrine()->getManager();
			// tells Doctrine you want to (eventually) save the Product (no queries yet)
			$entityManager->persist($ABvalidate);
			// actually executes the queries (i.e. the INSERT query)
			$entityManager->flush();
			
			//return new Response("Your contact was saved"); 
			return $this->redirectToRoute('AddressbookController');			 
		  
		   
	   }else{  
		   //$form->addError(new FormError('All fields marked with * are required'));
		   return $this->render('addressbook/add.html.twig', array( 
			  'form' => $form->createView(), 
			  'profilepic'=>''
		   )); 
	   }

	}
	
	/** 
	   * @Route("/addressbook/update/{id}") 
	*/ 
	public function updateAction(Request $request, Addressbook $AB) { 
		
		$Oldimg=$AB->getPicture();
		if($Oldimg !== null) {
			
			$profilepic = $this->getParameter('kernel.project_dir').'/web/uploads/photos/'.$Oldimg;
			$AB->setPicture(new File($profilepic));
		}
		
		        //$cour->setImage(new File($this->getParameter('images_directory').$img);

		
		$em = $this->getDoctrine()->getManager();
		$editForm = $this->createFormBuilder($AB) ->add('firstname', TextType::class)
			  ->add('lastname', TextType::class)
			  ->add('streetandnumber', TextType::class) 
			  ->add('zip', TextType::class) 
			  ->add('city', TextType::class) 
			  ->add('country', TextType::class) 
			  ->add('phonenumber', TextType::class) 
			  ->add('email', EmailType::class)
			 ->add('birthday', DateType::class, array( 'label' => 'Birthday','widget' => 'choice', 'years' => range(date('Y')-90, date('Y'))))
			 ->add('picture', FileType::class, array('label' => 'Photo (png, jpeg, <=2MB)','required' => false,'attr' => [ 'accept' => 'image/*'  ])) 
			  ->add('save', SubmitType::class, array('label' => 'Submit')) 
			  ->getForm(); 
		$editForm->handleRequest($request);
        if ($editForm->isSubmitted()) {
			$AB = $editForm->getData(); 
			$newimg=$AB->getPicture();
			if($newimg !== null) {			
				 $fileName = md5(uniqid()).'.'.$newimg->guessExtension(); 
				 $newimg->move($this->getParameter('photos_directory'), $fileName); 
				 $AB->setPicture($fileName);			
			}else{
				$AB->setPicture($Oldimg);
			}
            if ($editForm->isValid()) {
                $em->persist($AB);
                $em->flush();
                return $this->redirectToRoute('AddressbookController');
            }
        }
		
		return $this->render('addressbook/add.html.twig', array( 
			  'form' => $editForm->createView(),
			  'profilepic'=>$Oldimg,
			  
		   )); 
		   
	}
	
	
	
	/** 
	   * @Route("/addressbook/delete") 
	*/ 
	public function deleteAction(Request $request){

		$jsonData = array();
		$jsonData['status']=0;
		$jsonData['code']=403;
		if($request->isXmlHttpRequest()){
			$id = $request->get('itemId');
			$em = $this->getDoctrine()->getManager();
			$AB = $em->getRepository("AppBundle:Addressbook")->find($id);
			
		   $em->remove($AB);
		   $em->flush();
		   $jsonData['status']=1;
		   $jsonData['code']=200;
		   return new JsonResponse($jsonData);
		   
			
	  }else{
		  return new JsonResponse($jsonData);
	  }
	}
}
