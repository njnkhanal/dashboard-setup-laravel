Ecommerce

# role

    - admin
    - user
    - seller
    (add new column role in user table, (then do php artisan migrate:refresh))
    #make middleware to check current logined user is admin or not

    - make middleware (php artisan make:middleware AdminMiddleware) at App/Http/Middleware

# Admin Middleware:

    - first check current user is logined or not
    - check the role is admin or not
    - define that middleware to kernel.php as admin
    - use in web.php

# crud

    - manage user (roles)
    - first create model, migration, controller, resources (php artisan make:model User -mcr for controller only php artisan make:controller UserController)

# make migration for exsisting table

    - command (php artisan make:migration create_new_columns_in_user_table --table=users)
    - add columns and add these also in drop function then migrate
