# Laravel Demo Project


## Clone the project

``` git@github.com:SamiAibeche/laravel_demo.git ```

------------------------------------

## Clone the project

Create the SQL Database (name : *passport* ) and import the SQL DUMP into.

------------------------------------

## Create the .env. file


```

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:KR1Zi3OckC8wcsL3NZZcgPVwP4KIvY7lodG0QjiESa8=
    APP_DEBUG=true
    APP_URL=http://localhost
    
    LOG_CHANNEL=stack
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=passport
    DB_USERNAME=root
    DB_PASSWORD=password
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    QUEUE_DRIVER=sync
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1
    
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    
```

------------------------------

## Use the Laravel's encrypter

    Before using Laravel's encrypter, you must set a key option in your **config/app.php** configuration file. You should use the

``` php artisan key:generate ```
    
------------------------------

## Locally build/start the container

``` php -S localhost:8888 -t public ```

------------------------------------