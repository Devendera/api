
# steps for application configuration:
1. apply migrations:
    php artisan migrate
2. insert default data:
    php artisan db:seed
3. run the application:
    php artisan serve

# steps for testing api:
1. use /api/register to register
    Sample Request
    {
        "name":"test",
        "email":"test@gmail.com"
        "password":"test@01"
    } 
2. use /api/login to login
    Sample Request
    {
        "email":"test@gmail.com",
        "password":"test@01"
    }

    Respose will contain 'access_token' if login successful.

3. use /api/students to get students.

    Authorization: 
    Bearer Token 'access_token'
        pass 'access_token' in authorization for bearer token

    Headers:
    'Content-Type': application/json,
    'X-Requested-With': XMLHttpRequest
