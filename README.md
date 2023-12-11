Ecommerce

#role
-admin
-user
-seller
(add new column role in user table, (then do php artisan migrate:refresh))
#make middleware to check current logined user is admin or not

-make middleware (php artisan make:middleware AdminMiddleware) at App/Http/Middleware
#Admin Middleware:
-first check current user is logined or not
-check the role is admin or not
-define that middleware to kernel.php as admin
-use in web.php
