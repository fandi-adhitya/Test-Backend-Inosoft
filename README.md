# Tes Teknis Developer Backend PT. Inosoft Trans Sistem

## Panduan Instalasi

Jalankan perintah ini untuk menyelesaikan semua dependensi yang diperlukan.

```sh
composer install
```

Buat & atur file .env Anda seperti .env.example, kemudian konfigurasikan pada bagian database
```sh
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=test-backend-inosoft
DB_USERNAME=<YOUR DB USERNAME>
DB_PASSWORD=<YOUR DB PASSWORD>
```

Jalankan migrasi basis data & buat jwt secret.
```sh
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

Jalankan Aplikasi.
```sh
php artisan serve
```

Import POSTMAN Collection dan Environment yang sudah disertakan dalam repository
```sh
Test Backend Inosoft.postman_collection.json # Postman collection
test-backend-inosoft.postman_environment.json # Postman environment
```

Jalankan Unit Testing
```sh
php artisan test
```
