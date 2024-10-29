# the name of project
Daily Task Management
# step to run the project 
1- add data base name in phpmyadmin
2- add the database name in .env
3- run the project in termial using this step:
   1 . php artisan config:cache
   2. php artisan config:clear
   //we put this step above (1+2) because in my project i put database name but you want to add new data so this is to clear .env and allow you to put your database
   3. php artisan migrate
# Features
1- i use cron job and Queue ,job in this project   
2- use relations (one to many betwen User and Task)
3- Ui auth to login or register 
# what about this project
this project taking about add tasks by blade so any one who login in our website can add tasks 
and you can update and delete tasks that added by you (you can update or delete the task not yours)
and every day ... every users in our website give email contain the tasks that still "Pending" (the tasks that you add)
# To Run Ui auth do it in terminal to install it
1- composer require laravel/ui
2- php artisan ui bootstrap --auth
3- npm install
4- npm run dev

# To test if the command work you must to do this statement step by step
1- first of all go to .env and update some details like:
    1- MAIL_USERNAME= write the email you want to receive notification to it
    2- MAIL_PASSWORD= here you must to generate password from << App Password >>
    3- MAIL_FROM_ADDRESS="" ... write insaed the quote the same email you write it in << MAIL_USERNAME >>
    4- QUEUE_CONNECTION=database ...to make queue work
2- go to the App\Console\Kernel and instead of << daily() >> write << everyMinute() >> ... to see the response every minute not every day    
2- php artisan queue:work .... this statement to work job
3- php artisan schedule:work ... and this to work command 

# In the end do this
1- php artisan serve
2- write the url and register by the same email you put it in the folder .env 
3- add the button << عرض قائمة المهام  >>
4- add tasks and after that you can recieve the email that contain the tasks that still Pending and added by yours




