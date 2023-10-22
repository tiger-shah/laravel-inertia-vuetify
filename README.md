## Laravel via Vuetify (SPA)

This project is a simple Laravel web single page application project via Inertiajs and front-end using Vue and Vuetify components.

The main focus part on this project is the user account area starting with user authentications to user account panel.

This project supports roles and permissions. The main admin is name with "Super Admin".

## Installation
This is the whole installation from beginning:

#### 1. Clone project from [Git repository](https://github.com/tiger-shah/laravel-vuetify)


#### 2. Install Composer packages by running below command:
````
conposer install
````

#### 3. Create .env file and generate application key
````
cp .env.example .env
php artisan key:generate
````

#### 4. Set database connection configs in .env file

#### 5. Migrate the database migrations. (For demo run the command with seed)
````
php artisan migrate
````

#### 6. Create super admin user by running below command:
````
php artisan make:superadmin
````

#### 7. For demo, you can run database seed
````
php artisan db:seed
````
