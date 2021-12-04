<?php  
namespace AppBundle\Entity;  

use Symfony\Component\Validator\Constraints as Assert; 
use Doctrine\ORM\Mapping as ORM;  
/** 
   * @ORM\Entity 
   * @ORM\Table(name = "Addressbook") 
*/ 
class Addressbook { 
   /** 
      * @Assert\NotBlank() 
   */ 
   /** 
      * @ORM\Column(type = "integer") 
      * @ORM\Id 
      * @ORM\GeneratedValue(strategy = "AUTO") 
   */ 
   private $id;  
   /** 
      * @ORM\Column(type = "string", length = 100) 
      * @Assert\Email( 
         * message = "The email '{{ value }}' is not a valid email.", 
         * checkMX = true 
      * ) 
   */  
   
   private $email;     
   /** 
      * @ORM\Column(type = "string", length = 100) 
      * @Assert\NotBlank() 
   */ 
   private $firstname;  
   /** 
      * @ORM\Column(type = "string", length = 100) 
      * @Assert\NotBlank() 
   */ 
   private $lastname;  
   /** 
      * @ORM\Column(type = "string", length = 255) 
      * @Assert\NotBlank() 
   */ 
   private $streetandnumber;  


   /** 
      * @ORM\Column(type = "string", length = 10)
      * @Assert\NotBlank()  
   */ 
   private $zip;  
   /** 
      * @ORM\Column(type = "string", length = 100) 
      * @Assert\NotBlank() 
   */ 
   private $city;  
    
   /** 
      * @ORM\Column(type = "string", length = 100) 
      * @Assert\NotBlank() 
   */ 
   private $country;  
   
   /** 
      * @ORM\Column(type = "string", length = 20) 
      * @Assert\NotBlank() 
   */ 
   private $phonenumber;  
  
   /** 
      * @ORM\Column(type = "date", nullable = true) 
      * @Assert\Date() 
   */ 
   private $birthday;  
  
   /** 
     * @ORM\Column(type = "string", length = 255, nullable = true) 
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" },maxSize = "2M")
     */ 
   private $picture; 

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Addressbook
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return Addressbook
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return Addressbook
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set streetandnumber.
     *
     * @param string $streetandnumber
     *
     * @return Addressbook
     */
    public function setStreetandnumber($streetandnumber)
    {
        $this->streetandnumber = $streetandnumber;

        return $this;
    }

    /**
     * Get streetandnumber.
     *
     * @return string
     */
    public function getStreetandnumber()
    {
        return $this->streetandnumber;
    }

    /**
     * Set zip.
     *
     * @param string $zip
     *
     * @return Addressbook
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Addressbook
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Addressbook
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phonenumber.
     *
     * @param string $phonenumber
     *
     * @return Addressbook
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber.
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return Addressbook
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set picture.
     *
     * @param string $picture
     *
     * @return Addressbook
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
