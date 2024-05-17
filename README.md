# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Clone the repository
```
    git clone https://github.com/mdnurulmomen/univeware.git
```

Switch to the repo folder
```
    cd univeware
```

Install all the dependencies using composer
```
    composer install
```

Copy the example env file and make the required configuration changes in the .env file
```
    cp .env.example .env
```

Generate a new application key
```
    php artisan key:generate
```

Run the database migrations 

(**Set the database connection & credentials mentioned in .env before migrating**)
```
    php artisan migrate
```

Install *node* dependencis
```
npm install
```

After installation, build
```
npm run dev
```

Run the application
```
php artisan serve
```

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/Api/V1` - Contains all the api controllers
- `app/Http/Middleware` - Contains the JWT auth middleware
- `app/Http/Requests/Api` - Contains all the api form requests
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeders` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file
- `tests` - Contains all the application tests

## Environment variables

- `.env` - Environment variables can be set in this file

- `.env.testing` - Environment variables for testing can be set in this file

***Note*** : You can quickly set the database information and other variables in these files and have the application fully working.
