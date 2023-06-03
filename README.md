# Tes Teknis Developer Backend PT. Inosoft Trans Sistem

## Running

Run this commands to resolve all necessary dependencies.

```sh
composer install
```

Create & setting up your .env file, configure the database
```sh
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=test-backend-inosoft
DB_USERNAME=
DB_PASSWORD=
```

Run the database migration & create jwt secret.

```sh
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

## Running Unit Test
```sh
php artisan test
```