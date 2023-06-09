# Introduction

This is the code exercise for "LARAVEL DEVELOPER TEST" using:
- Laravel v10
- VueJS v3
- TailwindCSS v3

## Demo

Here is a quick demo video of the app:

https://github.com/louis-l/laravel-code-exercise-849518/assets/10172565/761fd92e-1820-47c2-b82b-e5dd0d57e222


# Get Started

This project runs on Docker (via Laravel Sail). Therefore, you will need to install Docker before running this.

Steps:

1. install Docker if not already
2. pull this project
3. open terminal to the downloaded project and run following commands:

- set up docker containers:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

- create `.env` file:
```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:5JOgmkawnmpvepXJtS4aBQgQe7y9pvZxBuF384bGfv4=
APP_DEBUG=true
APP_URL=http://laravel-code-exercise.test

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_code_exercise
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=.laravel-code-exercise.test

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
#MAIL_MAILER=smtp
#MAIL_HOST=sandbox.smtp.mailtrap.io
#MAIL_PORT=587
#MAIL_USERNAME=mailtrap_username
#MAIL_PASSWORD=mailtrap_password
#MAIL_ENCRYPTION=null
#MAIL_FROM_ADDRESS="hello@example.com"
#MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700
```

- start contains
```shell
./vendor/bin/sail up -d 
```

- run migrations
```shell
./vendor/bin/sail artisan migrate 
```

- run database seeds
```shell
./vendor/bin/sail artisan db:seed 
```

That's it. You now can visit http://laravel-code-exercise.test (or whatever the value set in `APP_URL` env key) to check out the app. Log in using:
- email: `admin@admin.com`
- pass: `password`

# Notes & Assumptions

## 1/ Sending emails

This project uses `mailpit` via Docker container to receive email, can be accessed via http://laravel-code-exercise.test:8025/. 

I have prepared and commented out the env keys to use **MailTrap**. Feel free to uncomment those lines and change the username and password.

## 2/ Send email whenever new company is entered

It's not clear that whom this email should be sent to. So I made an assumption that this email should be sent to the company that got entered. 

And because the company email is not a required field, so this email only gets sent if company email is provided.

## 3/ Company & Employee relationship

As not provided in the requirements, I made an assumption that this is a "one-to-many" relationship, in other words:
- a company can have multiple employees
- an employee belongs to 1 company

## 4/ Testing with phpunit

There is not many business logic to test in this exercise, mostly CRUD, except 1 action called `StoreCompanyLogo`. Therefore, the tests are mostly feature tests rather than unit tests.

Also, the frontend is running on VueJS, which is a client side app. It's best to use Laravel Dusk to actually render the view and assert the real rendered data. But to keep this project simple, I make http tests to cover the CRUD and use Inertia (e.g. `AssertableInertia`) to assert the rendering components and props.

## 5/ Others

- There exist several security best practices, such as request throttling and file upload validation, which should ideally be implemented in real-world applications. However, due to the goal of this project, these practices will be skipped for now.
- Typically, I'd opt for TypeScript when developing new projects. However, since it is not a requirement in this case, I've chosen to utilise ES6 JavaScript and Vite for their efficiency and speed.
- The user interface is built using TailwindCSS, along with certain Tailwind components sourced from flowbite.com and other online platforms.
