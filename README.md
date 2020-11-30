## Asesores Crud

- motor de base de datos: mariaDB
- php version: 7.4
- Laravel version: 8.x

pasos para ejecutar proyecto:

1. ejecutar ``composer install``
2. configurar el archivo .env con las credenciales para la base de datos (para mas informacion revisar documentacion de laravel [Laravel Docs](https://laravel.com/docs/8.x/))
3. ejecutar ``php artisan key:generate``
4. ejecutar ``php artisan jwt:secret``
5. ejecutar ``php artisan migrate``
6. ejecutar ``php artisan db:seed``
7. ejecutar ``php artisan serve``

