# Hey, before you start!
## Read this one.

Users to login:
Moderator:
username: peter
password: 123456




## Introduction 
Here is a quick explanation of what 
tis small MVC app does and how to start using it. 

The main folder is divided into two folders - _includes_ and _static_
Besides that you find _.htaccess_, _index.php_, and _Routes.php_ in the main 
folder. 

Let's break it down;

1. _index.php_  Please do not change anything there. User always lands on index.php 
no matter what they type as the URL. From that index.php loads all the classes, 
included routing. And that can handle the user's request. 

2. _Routes.php_ That takes the user's request and points to the correct controller. 
You have to make a route whenever you creating a new page. 

3. _includes_ holds _classes_, _Controllers_, and _views_. 
I hope it's kinda self explanatory, Most of the time, you don't touch 
_classes_. 
Whenever you want to mke a new page, create a controller and a view with
the same name. Controller needs to extend the _Controller_ class. And all the 
logic is included there, for example crud operations, sessions, etc. 
Then, in the view you just write the _body_ part. Header and footer is always
included. 

4. _static_ holds css, and js files. (All the other are going to be moved lol)
So here you have to include your css (please use SCSS), and js. 


Questions? 

## Remember to comment 
and remember to use /TODO: xxxx for questions, tasks, etc. 
