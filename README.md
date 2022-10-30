# oc-blog
 

### Install
In order to get started you first need to clone the project:
- `git clone https://github.com/m-perraud/oc-blog.git`

We will need composer for the project. 
- `at the root, run  composer install`



### Prerequisites

-   Composer **version 2** and superior
-   PHP 7.4 and superior
-   A MySQL Server up and running
-   A Virtual Host for the project. ( I used Wamp, here is how you can create it with it : complete the form : http://localhost/add_vhost.php?lang=french` )
-   APACHE with rewrite mode activated


### Database

The database informations are stored in the  Src/Utils/Constant.php file of the project 

![image](https://user-images.githubusercontent.com/98537701/198880602-d997df4a-5a06-42d3-89ce-6634ef8ad5d2.png)

You have to modify those informations if you won't use the same. 

To set up the database, you will need to import the .sql files. You have two options : 
- You want to import the tables and the data we've used : 
    - In this case, you can import the file 'oc-blog.sql' in the folder 'sql' of the project. 
- You only want to import the tables and then create your own data : 
    - In this case, you can import the file 'oc-blog(no-data).sql' in the folder 'sql' of the project. ( You can remove the (no-data) part of the name before importing )
    - Once you have imported the tables, you will have to create yourself an admin account to make sure you access every parts of the website. 
      To do this : you can go on the register page of the website (for exemple, my Virtual Host is named oc-blog, so i'll type this url : http://oc-blog/register ) 
      OR, you can click on the "S'inscrire" link in the menu of the website. 
      Once there, you can complete the form : ID, mail, password. 
      You'll get a message if you respected the conditions and it's a success. 
      Then, you have to modify the 'adminStatus' of the table 'user' from 0 to 1. 
      It'll give you access to the admin dashboard of the website. 
      
 
 ### PHPMailer
 
 To set the mailing, you'll have to add your own informations. 
 To do this, you can go in the Src/Utils/Constant.php file of the project and set up your SMTP : 
 
 ![image](https://user-images.githubusercontent.com/98537701/198881374-9e558a5b-f2ba-4c5a-8dee-efd4f33e0616.png)
 
 If you have any hesitation about the informations you're supposed to set in, you can refer to this part of the sendMail() function : 
 
 ![image](https://user-images.githubusercontent.com/98537701/198881451-c524aea5-dfdd-429d-91c1-6e14a007f2d6.png)
 
 


 
