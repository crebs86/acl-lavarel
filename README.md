
Fisrt register these services.
-
    composer require crebs86/acl-laravel
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
