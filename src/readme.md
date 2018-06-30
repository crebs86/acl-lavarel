Offial Site 
-
Docs <a href="http://acl-laravel.webhost.vix.br/docs">http://acl-laravel.webhost.vix.br/docs</a>

Demo <a href="http://acl-laravel.webhost.vix.br/demo">http://acl-laravel.webhost.vix.br/demo</a>

Fisrt register these services.
-
Insert into composer.json psr-4:

            "Crebs86\\Acl\\": "packages/crebs86/acl-laravel/src/"
Insert into 'providers' array on config/app.php:

            Crebs86\Acl\AclProvider::class,
And in 'aliases' array:

        'Acl' => Crebs86\Acl\Facades\Acl::class,
        
Finish with:

        composer dumpautoload

Now run codes bellow:
-
Step 1) Publish views and migrations

    
    php artisan vendor:publish --tag=first --force 

Step 2)  Migrate databases and seed

    composer dumpautoload
    php artisan migrate
    php artisan db:seed

Step 3) Publish Classes
  
    php artisan vendor:publish --tag=second --force

Now register middlewares on app/Http/Kernel.php
-   
        protected $routeMiddleware = [
        //... laravel codes
            'access' => \Crebs86\Acl\Middleware\Access::class,
            'active' => \Crebs86\Acl\Middleware\Activated::class,
        ];

deletar papel