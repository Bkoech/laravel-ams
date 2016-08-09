#Laravel Application Management System (AMS)

AMS is a package that intends to deliver admin panel that allows you to plug in additional modules in no time.
You can build your own packages and add them to AMS in order to extend its functionality. By default you can manage
users, roles and modules.

Each module can be developed as independed application/package and after small alterations can be turned into plugable
module.

__Warning!__

For the time being AMS is not production ready. It needs some time to "warm up". Please be patient. It will be finished
soon enough.

AMS is based on Laravel 5.2 and hasn't been tested on previous version of the framework.
It uses [admin-lte-laravel](https://github.com/acacha/adminlte-laravel) package in order to provide admin interface. 

##Instalation

At first you need to install _wilgucki/laravel-ams_ package.

<code>composer require wilgucki/laravel-ams</code>

Next add service provider to providers array and change auth provider.

_config/app.php_

    'providers' => [
        // ...
        Wilgucki\LaravelAms\AmsServiceProvider::class,
    ]

_config/auth.php_

    'defaults' => [
        // ...
        'passwords' => 'admins',
    ],
    
    'guards' => [
        'web' => [
            // ...
            'provider' => 'admins',
        ],

        'api' => [
            // ...
            'provider' => 'admins',
        ],
    ],
    
    'providers' => [
        // ...
        'admins' => [
            'driver' => 'eloquent',
            'model' => \Wilgucki\LaravelAms\Models\Admin::class,
        ],
    ],

    'passwords' => [
        // ...
        'admins' => [
            'provider' => 'admins',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

Publish package files with <code>php artisan vendor:publish --provider="Wilgucki\LaravelAms\AmsServiceProvider"</code> command.

Run migrations: <code>php artisan migrate</code> and seeder <code>php artisan db:seed --class=RoleSeeder</code>.

Last step is to create _modules_ dir under root directory.

__If you encounter _class not found_ error at any step of instalation run <code>composer dump-autoload</code> command.__

##Module structure

Modules are independed applications/packages from which you can build your "master" application. Module structure is
almost the same as typical Laravel application/package with few differences.

    vendor_name/
        └─ module_name/
            ├─ config/
            ├─ database/
            |    ├─ factories/
            |    ├─ migrations/
            |    └─ seeds/
            ├─ resources/
            |    ├─ lang/
            |    ├─ public/
            |    └─ views/
            ├─ routes/
            |    ├─ front.php 
            |    └─ admin.php
            ├─ src/
            |    └─ ServiceProvider.php
            ├─ composer.json
            └─ module-config.php


- vendor_name - your vendor name, e.g. john
- module_name - your module name, e.g. newsletter
- config - module configuration files
- database - database specific files: factories, migrations and seeds
- resources/lang - translations
- resources/public - public assets like images, styles, javascript files, fonts, etc.
- resources/views - module views
- routes - module routes, admin.php for backend (admin) routes and front.php for frontend routes
- src - module source code: models, controllers, middlewares, validators, etc.
- ServiceProvider.php - module service provider
- module-config.php - main configuration file required by the AMS

If you are using some external packages, you need to require autoloader in your service provider file.

###composer.json

There is one important rule here. _name_ must be the same as your vendor and module name, e.g. john/newsletter. It means
that you have directory named john with subdirectory named newsletter.

###module-config.php

    return [
        'default_route' => 'paczka.index',
        'acl' => [
            'resources' => [
                'John\Newsletter\Controllers\SomeController' => [
                    'display' => [
                        'index',
                        'show'
                    ],
                    'modify' => [
                        'add',
                        'create',
                        'edit',
                        'update',
                        'destroy'
                    ]
                ]
            ]
        ]
    ];


- default_route - module's default route. Will be used in main menu as link to module. Must be defined in routes/admin.php
- acl - module's access controll list. It allows to define access restrictions to every module action
- resources - keys represent controllers provided by the module. If you don't add controller here it will be available to anyone.
_display_ and _modify_ are user defined names. You can change them. They group controller actions to make it easier to
handle user permisions. Values represent controller's actions you are giving access to.

__SuperAdmin__

This is a special role that is allowed to access _system_ tab. SuperAdmin can manage administrators, roles and modules.
to create SuperAdmin, you need to alter _is_superadmin_ column in _admins_ table and set it to _true_. SuperAdmin is permited to
access any action in every controller.

__User registration__

By default new users are registered with _Admin_ role. It's just a label, you can change it in _RoleSeeder_ class.

####Module instalation

To install module you need to upload zip package containg directory structure presented above. Zip package will be validated,
unziped and moved to proper directory. After that uploader will run _composer update_ command in order to dowlnoad required
packages. They will be placed under vendor directory in your module. Last but not least uploader will alter main _composer.json_
file and add new namespace to psr-4 array. After that _composer dump-autoload_ command will be run.

By default new modules are disabled. You need to enable them in AMS admin panel. When activated module will appear in main menu.

##TODO

- write more tests
- improve documentation
- check for typos
- install modules by providing packagist name or repository address
