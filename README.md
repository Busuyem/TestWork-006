HOW TO GET THE PROJECT RUNNING ON YOUR MACHINE

1) Clone the project and follow the following

    a) cd into the project folder and run composer update
    b) run cp .env.example .env
    c) run php artisan key:gen
    d) run php artisan serv
    e) create a database and suply the name in .env file
    f) run php artisan migrate


2) User Endpoints

    a) GET all the users endpoint
       GET http://127.0.0.1:8001/api/users
    b) POST create a user endpoint
        POST http://127.0.0.1:8001/api/users
        Request inputs: {name, email, password, password_confirmation}
    c) GET show a user endpoint
        GET http://127.0.0.1:8001/api/users/{id}
    d) PUT update user resource endpoint
        PUT http://127.0.0.1:8001/api/users/{id}
    e) DELETE destroy a user endpoint
        http://127.0.0.1:8001/api/users/{id}
    f) GET assign role to user endpoint
        http://127.0.0.1:8001/api/users/{userId}/role/{roleId}
    g) GET http://127.0.0.1:8001/api/users/search?search={parameter}

3) Role Endpoints
    a)  GET all roles
        GET http://127.0.0.1:8001/api/roles
    b)  POST create a role
        POST http://127.0.0.1:8001/api/roles
        Request input: {name}
    c)  GET one role
        http://127.0.0.1:8001/api/roles/{id}
    d)  PUT update a role
        http://127.0.0.1:8001/api/roles/{id}
    e)  DELETE a role
        http://127.0.0.1:8001/api/roles/{id}

Note: Ensure to change the port to your localhost.

Thanks.
