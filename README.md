
Fisrt register these services.
-
On a fresh laravel (>=5.4) installation.

    composer require --dev crebs86/acl-laravel:dev-master
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

For protect your controllers insert on:
-
You may call the middleware method from the controller's constructor.

    class MyExemploController extends Controller{
            public function __construct()
            {
                $this->middleware('auth');      //if auth is necessary
                $this->middleware('access');    //if email verification is necessary
                $this->middleware('active');    //if active account is necessary
            }
    }
    
    
Protecting methods:
-

Method Acl::can(array|string, boolean);

First parameter: array or string, noo default value; set permissions needed.

Second parameter: boolean; default true. If the method protected require a super administrator user.

    use Crebs86\Acl\Facades\Acl;
        
    class MyExempleController extends Controller{
            
            public function myMethod()
            {
                Acl::can('permission_name', false);
                //continue...
            }
            
            public function methodRequireSuperAdminUser()
            {
                Acl::can('permission_name', true);  //for require only super-admin users can access the method define second parameter like true
                //continue...
            }
            
            public function multiPermission()
            {
                  Acl::can(['permission_name', 'other_permission'], false);  //for multi permissions set permissions like a array
                  //continue...
            }
    }

Similarly, you can use the helpers:
-

    class MyExempleController extends Controller{
            
            public function myMethod()
            {
                have('permission_name', false);
                //continue...
            }
            
            public function methodRequireSuperAdminUser()
            {
                if(can('permission_name', true)):
                    //continue...
                else:
                    abort(403,'Access Denied');
                endif    
            }
            
            public function multiPermission()
            {
                  have(['permission_name', 'other_permission'], false);
                  //continue...
            }
    }

    
On Blade files
-

    @if(can(['permission_name', 'other_permission'], false))
        <p>You can view this</p>
    @else:
        <p>You don't have permission</p>
    @endif
After installation
-
    http://localhost/login

<strong>E-mail: super-admin@your.app

Password: crebsacl</strong>

You should change the email address and pass.
    
Tanks!    
    
Tanks!
