### Aqualink Recruitment Task for Laravel Developer

## Project Setup Guide

First, Clone the repository.

```bash
git clone https://github.com/atiq-ur/Aq-task-recruitment.git
```

Go to the project directory.

```bash
cd Aq-task-recruitment
``` 

Install the composer & npm dependencies.

```bash
composer install
```

#### Env Configuration.

Copy the `.env.example` file to `.env` and update the database credentials.

Generate artisan key.
```bash
php artisan key:generate
```

#### Database Migration & Seeding.
Configure your database in `.env` file.
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aq_task_recruitment
DB_USERNAME=root
DB_PASSWORD=your_db_password
```

Then run the database migration command to create the tables.

```bash
php artisan migrate
```

Run the server.

```bash
php artisan serve
```
It will serve the app on `http://127.0.0.1:8000` by default.

> Note: you may use valet to generate a local URL(development) such as http://example.test

I have created two API endpoints for the task and two addition API route to get the tasks which is given below.

#### API Endpoints

##### 1. Create/Store Task1 packet data
```bash
POST /api/tasks1
form-data: data: 'valid packet data'
```

##### Get Task1 packet data
```bash
GET /api/task1-packets
```

##### 2. Create/Store Task2 packet data
```bash
POST /api/tasks2
form-data: data: 'valid packet data'
```

##### Get Task2 packet data
```bash
GET /api/task2-packets
```

All API endpoints are given below (Postman example).

```bash
Task 1: 
GET http://127.0.0.1:8000/api/task1-packets
POST http://127.0.0.1:8000/api/task1

Task 2:
GET http://127.0.0.1:8000/api/task2-packets
POST http://127.0.0.1:8000/api/task2
```

I have also added postman collection to this repository. You can import it to your postman and test the API endpoints.
[Postman Collection](https://github.com/atiq-ur/Aq-task-recruitment/blob/master/Aq-task-recruitment.postman_collection.json)

