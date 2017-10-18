# Firmstep
Firmstep Developer Test

### Description:

This application is used to keep a record of currently queued people at the reception desk. The authorized receptionist is able to select the service and take the customer details depending on the customer type:
* Citizen: title, first name and last name fields
* Organisation: organisation name field
* Anonymous: no input fields

Also customers can only see the currently queued people in the list.

### Installation:
You should have a running php web server and MySQL database server. This project uses PDO extension for database connection so it is essential to have it installed in your **PHP Extensions**

* First download the package
* Copy all the content in the root of your wwwroot.
* Create a database named "firmstep"
* Import "firmstep.sql" file in your database
* If you need to change database setting in the application, you have to edit 'include/config.php' file and change the following:
```
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "firmstep");
define("DB_PORT", 3306);
define("DB_CHARSET", "utf8");
```
* To run the application, simple browse _index.php_ file

To test the receptionist form of application, you have to use these credentials:
* Username: ehsant
* Password: 12345