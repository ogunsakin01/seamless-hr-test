### A Travel ChatBot

#### Documentation Link

**[https://documenter.getpostman.com/view/3172372/SzS2xUBZ?version=latest](https://documenter.getpostman.com/view/3172372/SzS2xUBZ?version=latest)**
#### Quick Start
To load in your php dependencies
````
$ cd seamlesshr
$ composer install
````

 Once this is complete. Copy your .env.example file to .env and update the following accordingly
 
 ````
DB_CONNECTION=XXXXX
DB_HOST=XXXXX
DB_PORT=XXXXXX
DB_DATABASE=XXXXXXX
DB_USERNAME=XXXXXXXX
DB_PASSWORD=XXXXXXX
````
Don't forget to replace the Xs with you actual value then proceed to generate a key for your laravel project

````
$ php artisan key:generate
````

````

Then proceed to running your migration command

````
$ php artisan migrate
````

Now we can start our chat app by

````
$ php artisan serve
````



