<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Dev-Stagram-Laravel

¡Bienvenido a Dev-Stagram-Laravel! Este es un proyecto de red social desarrollado con el framework Laravel.

## Requisitos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- PHP >= 7.4
- Composer
- Laravel CLI
- MySQL

## Instalación

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/Yeyoramirez17/Dev-Stagram-Laravel.git
   ```

2. Navega al directorio del proyecto:

   ```bash
   cd Dev-Stagram-Laravel
   ```

3. Instala las dependencias del proyecto a través de Composer:

   ```bash 
   composer install 
   ```

4. Crea una copia del archivo `.env.example` y renómbralo como `.env`. Luego, actualiza el archivo `.env` con los detalles de tu configuración de base de datos.

5. Genera una clave de aplicación:

   ```bash
   php artisan key:generate
   ```

6. Ejecuta las migraciones de la base de datos:

   ```bash
   php artisan migrate
   ```

7. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

¡Listo! Ahora puedes acceder a la aplicación en `http://localhost:8000`.

