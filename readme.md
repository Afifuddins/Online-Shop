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
<text
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
</text>
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

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
