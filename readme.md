<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Install Laravel
For manual setup of the application, you need to install a Laravel skeleton application if you don't have one already:

    composer create-project --prefer-dist laravel/laravel myshop

## Database
Make sure that you've created the database in advance and added the configuration to the .env file in your application directory. Sometimes, using the .env file makes problems and you will get exceptions that the connection to the database failed. In that case, add the database credentials to the resource/db section of your ./config/shop.php file too!

For MySQL, you should change the database charset/collation in your config/database.php file before the tables are created to:

'connections' => [
    'mysql' => [
        // ...
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_bin',
        // ...
    ]
]
If you don't have at least MySQL 5.7 installed, you will probably get an error like

Specified key was too long; max key length is 767 bytes

To circumvent this problem, drop the new tables if there have been any created and change the charset/collation setting to these values before installing Aimeos again:

'connections' => [
    'mysql' => [
        // ...
        'charset' => 'utf8',
        'collation' => 'utf8_bin',
        // ...
    ]
]
If you want to use a database server other than MySQL, please have a look into the article about supported database servers and their specific configuration.

## Instalation

Then, add these lines to the composer.json

 "prefer-stable": true,
    "minimum-stability": "dev",
    "require": {
        "aimeos/aimeos-laravel": "~2018.10",
        ...
    },
    "scripts": {
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=public --force",
            "@php artisan migrate"
        ],
        ...
    }
    
    Afterwards, install the Aimeos shop package using

composer update

Next, the Aimeos provider class must be added to the providers array of the config/app.php file so the application and Laravel command task will work:

return array(
    'providers' => array(
        /*
         * Package Service Providers...
         */
        Aimeos\Shop\ShopServiceProvider::class,

        /*
         * Application Service Providers...
         */
    ),
);

In the last step you must now execute these artisan commands to get a working or updated Aimeos installation:

php artisan vendor:publish --all
php artisan migrate
php artisan aimeos:setup --option=setup/default/demo:1
php artisan aimeos:cache
In a production environment or if you don't want that the demo data gets installed, leave out the --option=setup/default/demo:1 option.

## Setup
To see all components and get everything working, you also need to create your main Blade template in resources/views/app.blade.php. This is a working example using the Twitter bootstrap CSS framework:

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('aimeos_header')
	<title>Aimeos on Laravel</title>

	<link type="text/css" rel="stylesheet" href='https://fonts.googleapis.com/css?family=Roboto:400,300'>
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@yield('aimeos_styles')
</head>
<body>
	<nav class="navbar navbar-default">
	<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/">Home</a></li>
				</ul>

				<div class="nav navbar-nav navbar-right">
@yield('aimeos_head')
				</div>
			</div>
		</div>
	</nav>
    <div class="col-xs-12">
@yield('aimeos_nav')
@yield('aimeos_stage')
@yield('aimeos_body')
@yield('aimeos_aside')
@yield('content')
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('aimeos_scripts')
	</body>
</html>
Afterwards, you should clear the Laravel cache files. Otherwise, you might get an exception due to old cached data.

php artisan cache:clear

Then, you should be able to call the catalog list page in your browser. For a quick start, you can use the integrated web server that is available since PHP 5.4. Simply execute this command in the base directory of your application:

php artisan serve

Point your browser to the list page of the shop using:

http://127.0.0.1:8000/index.php/list

Note: Integrating the Aimeos package adds some routes like /list or /admin to your Laravel installation but the home page stays untouched!

Caution: CSRF protection is enabled by default but for the /confirm and /update routes, you may have to disable CSRF if one of the payment providers is sending data via POST requests.

## Admin

To use the admin interface, you have to set up Laravel authentication first:

php artisan make:auth

For more information, please follow the Laravel documentation:

[Laravel 5.7](https://laravel.com/docs/5.7/authentication).
[Laravel 5.6](https://laravel.com/docs/5.6/authentication)
[Laravel 5.5](https://laravel.com/docs/5.5/authentication)
[Laravel 5.4](https://laravel.com/docs/5.4/authentication)
[Laravel 5.3](https://laravel.com/docs/5.3/authentication)
Test if your authentication setup works before you continue. Create an admin account for your Laravel application so you will be able to log into the Aimeos admin interface:

php artisan aimeos:account --admin <email>

The e-mail address is the user name for login and the account will work for the frontend too. To protect the new account, the command will ask you for a password. The same command can create limited accounts by using "--editor" or "--api" instead of "--admin". If you use "--super" the account will have access to all sites.

As a last step, you need to extend the boot() method of your App\Providers\AuthServiceProvider class and add the lines to define how authorization for "admin" is checked in app/Providers/AuthServiceProvider.php:

public function boot()
{
    // Keep the lines before

    Gate::define('admin', function($user, $class, $roles) {
        if( isset( $user->superuser ) && $user->superuser ) {
            return true;
        }
        return app( '\Aimeos\Shop\Base\Support' )->checkUserGroup( $user, $roles );
    });
}
If your ./public directory isn't writable by your web server, you have to create these directories:

mkdir public/files public/preview public/uploads
chmod 777 public/files public/preview public/uploads
In a production environment, you should be more specific about the granted permissions! If you've still started the internal PHP web server (php artisan serve) you should now open this URL in your browser:

http://127.0.0.1:8000/index.php/admin

Enter the e-mail address and the password of the newly created user and press "Login". If you don't get redirected to the admin interface (that depends on the authentication code you've created according to the Laravel documentation), point your browser to the /admin URL again.

To see your uploaded images, you have to adapt your .env file and set the APP_URL:

APP_URL=http://127.0.0.1:8000

Caution: Make sure that you aren't already logged in as a non-admin user! In this case, login won't work because Laravel requires to log out first.
## Hints
To simplify development, you should configure to use no content cache. You can do this in the config/shop.php file of your Laravel application by adding these lines at the bottom:

    'madmin' => array(
        'cache' => array(
            'manager' => array(
                'name' => 'None',
            ),
        ),
    ),

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
