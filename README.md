# Laratter
Un proyecto de Laravel basado en el [Curso de PHP con Laravel](https://platzi.com/clases/curso-php-laravel/) de [Platzi](https://platzi.com)

## Instalación
1. Crea la instancia en la base de datos con **PostgreeSQL**
```sql
$ psql
# CREATE ROLE laratter with login;
# CREATE DATABASE laratter;
```

2. Genera las migraciones de la base de datos
```
$ php artisan migrate
```

3. Inicia el proyecto y prueba las funcionalidades 
```
$ php artisan serve
```
