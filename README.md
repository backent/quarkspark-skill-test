# Laravel with docker

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


