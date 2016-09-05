# Make a Moduler Application using Laravel5.3

Software development with modules is essential if we are developing expandable software. In this repository i am gonna 
describe  how i configure for the modules in laravel5.3 application. For this [Sujip Dai](https://github.com/sudiptpas) and [Jyot](https://github.com/coderjay12)
 Helped me a lot.
 Let's get started ! 

## Official Documentation of Laravel

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Let's Start

Let's create the one directory for modules inside of root directory of Laravel. For example create "modules" directory 
inside of your project directory. 

Now create the vendor directory and module name, For this create "lara" directory inside of modules directory and "cart"
directory inside of "lara" directory.

We can create required directories inside of that cart directory. Let's Create the src folder and make cartServiceProvider.php
class and write something like this type of code.

```php
<?php

namespace Lara\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerIncludes();
        $this->registerModelEvents();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cart');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cart');
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function registerIncludes()
    {
        foreach (new \DirectoryIterator(__DIR__ . '/../routes/') as $fileInfo) {
            if (!$fileInfo->isDot()) {
                include  __DIR__ . '/../routes/' . $fileInfo->getFilename();
            }
        }
    }
    /**
     * Register the Event Subscriber(Observer) for Models
     *
     * @return void
     */
    public function registerModelEvents()
    {
    }
}
```

## Configure In config/app.php

In config/app.php add the following line in providers array .
```php
Lara\Cart\CartServiceProvider::class,
```
Now provide the path up to vendor inside of composer.json file of root folder, Which becomes like this 
```php
"autoload": {
        "classmap": [
            "database",
            "modules/lara"
        ],
        "psr-4": {
            "App\\": "app/"
        }
    },
```    
## Make composer.json file inside of cart module

we can create composer.json file inside of cart directory, to make go up to your module and enter the command  
```php
composer init
```
Add your required information in this file and autoload your module using this line of code.
```php
"autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "Lara\\Cart\\": "src/"
        }
    }
```

## Make a route file 

Create the routes directory inside of cart module and create the web.php file, In which write this route for 
testing purpose
```php
Route::get('/test',function(){
    return "This is Testing";
});
```

Now run the command below this, and if it work you can ensure that your process is right till now !

```php
php artisan route:list
```
Now we have to make a controller and route will call the controller's method that's why make a route like this.

```php
Route::get('/test',[
    'as'=>'module.test',
    'uses' => 'Lara\Cart\Http\Controllers\CartController@index'
]);
```

## Create a Controller
Inside of cart/src folder create the Http/Controllers/CartController.php and inside controller write the something like this 
type of code.

```php
<?php

namespace Lara\Cart\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class CartController
 * @package Lara\Cart\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return view('cart::carts.index');
    }
}
```
Here cart is the module name and carts is the directory inside of resources/views directory.

## Create a View files

Let's make the layouts directory and master.blade.php file for the master view and write something like this
```php
 <!doctype html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport"
           content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>
     @yield('content')
 </body>
 </html>
```

In index.blade.php file which is situated inside of carts directory just add the content.

```php
@extends('cart::carts.layouts.master')

@section('content')
    <h1>Hello This is Content </h1>
@endsection
```

This is the simple flow of to make configure for the modules to develop the moduler application. we can add the 
styles and javascript for each module. Again some stylesheet and javascript files are required for all modules 
  for this we can make the common module which is the master for all the modules.