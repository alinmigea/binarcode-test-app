# BinarCode Assessment

## BE - Senior interview playground template

Prepare ahead a fresh Laravel app environment. Would be good to have Laravel Valet, or something similar so we can test right away.

Imagine you’re stripe, and you want to send notifications to your customers as soon you got a new payment.

1. Create an endpoint called `api/reminders/schedule`
2. Add a custom middleware for this endpoint that checks the header `X-SCHEDULER-HEADER` to be `secret!` otherwise do not allow the request to go through
3. Create a controller and handler method
4. Validate that the request has the correct payload
    ```php
    channel - should be string, required and in the list "mail, database"
    message - should be string, required, max 256
    time - should be a date time ISO
    email - should be email and optional, required only if the "channel" is mail
    ```
5. Create a migration for a new table called `schedulers` with the columns above. Add some more status columns to the migration (`sent_at`, `failed_at`)
6. Create a model with the columns above
7. Store the request payload into the database
8. Create a scheduler command that runs hourly and checks for unsent notifications the notifications to be sent this hour. The `unsent notifications` should be filtered using a model local scope called `scopeReady` and filter them there
9. In the command check the `channel` type and send the notification using `Notification` facade
10. Create a generic mailable class that sends the email in case the channel is email. The email should be queued into the `emails` queue
11. Create a generic notification to send the notification into the database in case the channel requires that
12. Create a test using PHPUnit that ensures the notification is sent through

## Requirements

- PHP >= 8.0

## Installation

```
cd [YOUR WORKSPACE]
git clone git@github.com:alinmigea/binarcode-test-app.git
```

## Local PHP + DATABASE solution

```
## IF YOU HAVE A MYSQL SERVER
composer install
cp .env.example .env
php artisan key:generate
## edit your db connection
```

### Open the app
```
php artisan serve --port 8000
```
Server will be running [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

### DB Connection Validation

```
php artisan migrate
curl http://127.0.0.1:8000/db-test
# [{"Tables_in_binarcode":"failed_jobs"},{"Tables_in_binarcode":"migrations"},{"Tables_in_binarcode":"password_resets"},{"Tables_in_binarcode":"personal_access_tokens"},{"Tables_in_binarcode":"posts"},{"Tables_in_binarcode":"schedulers"},{"Tables_in_binarcode":"users"}]
```

### Exposed routes

```
GET            api/reminders ................................................................. SchedulerController@index
POST           api/reminders/schedule ........................................................ SchedulerController@store
GET            api/reminders/{scheduler} ...................................................... SchedulerController@show
DELETE         api/reminders/{scheduler} ................................................... SchedulerController@destroy
```

### Command setup

```
php artisan schedule:list
```
and the command should be listed. Run it instantly with
```
php artisan send:notifications
```
