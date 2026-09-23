# PHP Blogging Platform API
A simple implemented blogging platform API, with raw PHP (MVC structure included) for educational perpose and PHP learning.

## Installation Instruction
1. You need to make sure you have `PHP` and `Composer` Installed.
2. Clone the repository (or download the zip file) and go to root directory of project.
3. Install all required packages:
```bash
composer install
```
4. Create `.env` file based on the `.env.example` and add your database details in there.
5. Get all the migrations:
```bash
./vendor/bin/doctrine-migrations migrate
```
6. Run the project on localhost:
```bash
php -S localhost:8000 -t public/
```

## Usage
This is a training project for better understanding the implementation of MVC principles in creating back-end projects.
## LICENSE
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.