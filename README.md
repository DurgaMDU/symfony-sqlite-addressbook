# symfony-sqlite-addressbook 
Creating Simple Addressbook Curd Using Symfony 3.4, Doctrine with SQLite, Twig, PHP7.4+. It is just for basic code.

## Setup
    git clone https://github.com/DurgaMDU/symfony-sqlite-addressbook.git
    cd symfony-sqlite-addressbook
    composer install

    #change database connection SQLite/MYSQL in app/config/config.yml
    After configure your database conf. please use the following commands to create database

	php bin/console doctrine:database:create
	
	To create table inside database using below command
	
	php bin/console doctrine:schema:create
	
	To check Database schema and Mapping 
	
	php bin/console doctrine:schema:validate
	
	To Run Project in Browser 
	
	php bin/console  server:run
		[OK] Server listening on http://127.0.0.1:8000



What's inside focus and used?
--------------

The Symfony Standard Edition3.4 is configured with the following defaults:

  * An AppBundle you can use to change coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;
  
It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**DoctrineBundle**][1] - Adds support for the Doctrine ORM

  * [**TwigBundle**][2] - Adds support for the Twig templating engine


## Author

Durgadevi Maheswaran
