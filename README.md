
README.md
Simple-blog-in-symfony-4

Installation process

    Clone the blog from github to your computer
    Run composer install
    Add database configuration and swift mailer configuration in .env file

    Run php bin/console doctrine:database:create to create the database
    Run php bin/console doctrine:migrations:diff to create migration
    Run php bin/console doctrine:migrations:migrate to execute the migration
    Run php bin/console doctrine:fixtures:load to insert the default user into database

Wow

Building completed now open your browser and login with username aimal and password password.

If you are not using apache or Nginx just start the server by runing php bin/console server:run command.