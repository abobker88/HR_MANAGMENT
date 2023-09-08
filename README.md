# Laravel Task 

1) Anonyms User: can submit the form
2) HR Coordinator: Will Review the form and accept/reject
3) HR Manager: Will Review the form after the acceptance of HR Coordinator and he can accept/reject.

## Installation

Use the package manager [composer](https://laravel.com/) to install laravel.

```bash
composer install
```
setup database in env file 
then migrate database 
```bash
php artisan migrate
```
seed role for manager and coordinator 
```bash
php artisan db:seed
```
## Default Creational
1. user_name: hr_manger
password : 12345678

2. user_name : hr_coordinator
password : 12345678