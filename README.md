## Project Setup

```sh
composer install
```

### make a copy of .env.example > .env then setup the database connection

```sh
cp .env.example .env
```

### run the database migrations

```sh
php artisan migrate
```

### run the application

```sh
php artisan serve
```
