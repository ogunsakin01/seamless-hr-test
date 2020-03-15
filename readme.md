### Seamless Interview Test Codes

#### Documentation Link

**[https://documenter.getpostman.com/view/3172372/SzS2xUBZ?version=latest](https://documenter.getpostman.com/view/3172372/SzS2xUBZ?version=latest)**

#### Quick Start
To load in your php dependencies
```bash
$ cd seamlesshr
$ composer install
```
 Once this is complete. Copy your .env.example file to .env and update the following accordingly
 
 ```env
DB_CONNECTION=XXXXX
DB_HOST=XXXXX
DB_PORT=XXXXXX
DB_DATABASE=XXXXXXX
DB_USERNAME=XXXXXXXX
DB_PASSWORD=XXXXXXX
```
Don't forget to replace the Xs with you actual value then proceed to generate a key for your laravel project

```bash
$ php artisan key:generate
```

Then proceed to running your migration command

```bash
$ php artisan migrate
```

Then start the application

```bash
$ php artisan serve
```
