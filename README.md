# _Shoe Store_

#### _Databases Extended: Week 4 Independent Project, July 21, 2017_

#### By **Michelle Poterek**

## Description

_This project allows a user to input shoe stores as well as different types of stores. The user has the option to browse by shoes and see the store location or look through shoes a certain location carries._

## Setup/Installation Requirements

_**If you already have MAMP downloaded and installed:**_

````
**open Terminal and navigate to desktop by typing `cd desktop`**


* $ `git clone https://github.com/PoterekM/php-shoes.git`
* $ `cd php-shoes`
* $ `composer install`


**In MAMP**
* Select the Start Servers
* Go to preferences>web server and click on the folder icon next to 'document root'
* Click on 'web' folder of project and hit 'select'
* Hit ok at the bottom of the preferences window


CREATING THE DATABASE

**In your browser (recommended way)**
* Navigate to `http://localhost:8888/phpmyadmin/`
* Upload `shoe_store.sql.zip` (located within the repository)
* If the tests are of interest to you, upload `shoe_store_test.squl.zip` as well.
* when running the tests use the command $ ./vendor/bin/phpunit tests


**OR TO GET THE DATABASE FROM TERMINAL**
> /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
> CREATE DATABASE shoe_store;
> USE shoe_store;
> CREATE TABLE shoes (id serial PRIMARY KEY, brand VARCHAR(30), price INT);
> CREATE TABLE stores (id serial PRIMARY KEY, store VARCHAR(30));
> CREATE TABLE shoes_stores (id serial PRIMARY KEY, shoe_id INT, store_id INT);


````

_**If you need to download and Install MAMP:**_
````
* If you do not have Composer here is a link to their website https://getcomposer.org/download/
* If you do not have MAMP please download from their website https://www.mamp.info/en/downloads/



* Launch your newly-installed MAMP program.
* When MAMP launches you will be greeted by a small window with several options. Click Preferences.
* In the Preferences window, select the Ports tab.
* Set the Apache Port to 8888.
* Set the MySQL Port to 8889.
* Click OK to save your new port configurations.

````

## Technologies Used

* PHP
* Composer
* Twig
* Silex
* CSS
* Bootstrap
* SQL
* Apache
* MAMP

### Acknowledgements
_Thanks to Epicodus for providing some of the MAMP installation instructions at learnhowtoprogram.com_

## Support and contact details
_Please feel free to contact me directly via e-mail at poterekm@gmail.com if you have any questions, comments, ideas, or feedback. Also, I invite you to feel empowered to make any changes to this repository by forking it and making changes accordingly._

## Known Bugs
* The program does not eliminate duplicate entries.

### License

*This project is under the MIT License*

Copyright (c) 2017 **Michelle Poterek**
