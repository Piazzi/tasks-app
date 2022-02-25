### Installation guide
#### Prerequisites
* PHP: * Version >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension + Database (MySQL, SQLite) + Web Server (Apache)
* Composer.

##### Step by step

1. Clone the repository to your computer;

2. Inside the main project folder, create a file with the name: **.env**; (You can skip steps 2 and 3 by entering the folder through a terminal and using the command "copy .env.example .env ")

3. Copy the contents of the **.env.example** file to the newly created **.env** file;

4. Access the repository with a terminal and run the command: **composer install**;

5. Still in the terminal, generate an application key with the command: **php artisan key:generate**;

6. Configure the **.env** file with the local database settings;

**Example:**

````

DB_DATABASE=your_database_name

DB_USERNAME=your_username

DB_PASSWORD=your_password

````
 
7. In the terminal, run the migrations with the command: **php artisan migrate --seed**;

*Note: The "--seed" flag is only used to seed the bank, if you don't want the bank filled, remove this flag from the command*

8. To run the project, use the command: **php artisan serve**;

10. Access the URL indicated in the terminal;
