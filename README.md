## Installation
*  Open terminal, navigate to your work directory and execute the following command : `git clone git@gitlab.com:Kirantitech/news-cms-v2.git`    
*  Navigate to the project directory : `cd news-cms-v2`
*  Install Composer Dependencies: `composer install`
*  Copy the _.env.example_ file to _.env_ file : `cp .env.example .env`
*  Generate the Application key: `php artisan key:generate`
*  Set up database details inside `.env` file :    
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=database_username
DB_PASSWORD=database_user_password
```
*  Run the migration and seeders: `php artisan migrate --seed`
*  Generate the permissions:  `php artisan access:generate`
*  Run the application: `php artisan serve`
*  Login as Root and assign necessary permissions to each roles (by clicking on edit button) at: [http://localhost:8000/admin/role](http://localhost:8000/admin/role)

### Login Credentials
* Root(Admin) : `root@cms.com` : `secret`


# Backend Development Instructions

Before using command : `php artisan kiranti:generate model-name`

Make Sure :
    - composer install
    - copy form.yml.example to form.yml

### Form Yml :

- This consists of key as input type and value as column name .
- Pipe (|) can be used if we have multiple columns.
- Supported input types right now are text,textarea,radio .....

### Instructions to be followed after generating :

- Make sure we create a migration first
- Input columns in form.yml
- Add validations in client side and backend both [ Store/UpdateRequest & scripts.blade.php ]
- Add factory with faker properties
  
### Bug &  Fixes

