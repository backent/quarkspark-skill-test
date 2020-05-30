# Skill Test

## Intro
This Readme cover 
 - Installation with docker
 - API documentation


## Installation
Install composer
```bash
./composer install
```

Make .env from .env.example
```bash
cp .env.example .env
```

Generate app key
```bash
./php artisan key:generate
```

Build containers using docker-compose
```bash
docker-compose up -d
```

Set Project permission
```bash
./set-permission
```
Now you can play with it ^^

## docker command helper

### Run Composer
Execute
```bash
./composer {argument}
```
Example
```bash
./composer install
```

### Run php
```bash
./php {argument}
```
Example
```bash
./php -v
```
## Database
This project using mysql database.
You can config the database at docker-compose.yml



## Task
Create a mini project to manage book in small library with spec below
	- have 2 roles ( Admin n user )
	- Admin can do :
		- Add New Book
		- Edit Book
		- Remove Book
		- Approve / Reject Rent Request For a Book
		- Disable/ Enable User

	- User can do :
		- Register
		- Login
		- See List of Book
		- Request Rent For a Book

## API Documentation

### AUTH
- Register

Endpoint 
```
/api/register
```
Method: POST

Require:
	- email
	- name
	- password

### Note: For admin, you can use artisan tinker and include role field with value "admin"

- Login

Endpoint 
```
/api/login
```
Method: POST

Require:
	- email
	- password

### USER

- Change Status User

Endpoint 
```
/api/user/changestatus/{user}

```
Method: POST

Require param:
	- user => user id that need to change the status

### BOOK
- Get list all Book

Endpoint 
```
/api/book
```
Method: GET

- Get 1 Book By ID

Endpoint 
```
/api/book/{book}
```
Method: GET

Require param: 
	- book => book_id

Require:
	- name
	- author

- Add New Book

Endpoint 
```
/api/book
```
Method: POST

Require:
	- name
	- author

- Add edit Book

Endpoint 
```
/api/book/{book}
```
Method: PATCH

Require param: 
	- book => book_id

Require:
	- name
	- author

- Remove Book

Endpoint 
```
/api/book/{book}
```
Method: DELETE

Require param: 
	- book => book_id

### Rent

- Request rent book

Endpoint 
```
/api/rent
```
Method: POST

Require:
	- book_id
	- return_datetime

- Proceed rent book

Endpoint 
```
/api/rent/proceed/{rent}
```
Method: PATCH

Require param:
	- rent => rent id

Require:
	- status


