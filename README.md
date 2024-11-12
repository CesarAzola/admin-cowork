# Proyecto de Gestión de Reservas para Cowork

Este es un proyecto de una aplicación web desarrollada con Laravel y Blade para gestionar la reserva de espacios en un cowork. La aplicación permite a los usuarios realizar reservas en diferentes salas, y a los administradores gestionar las salas y supervisar las reservas. 

## Características

- Autenticación de usuarios (clientes y administradores).
- Los clientes pueden registrarse, iniciar sesión y hacer reservas en las salas disponibles.
- Los administradores pueden gestionar las salas (crear, editar, eliminar) y supervisar las reservas.
- Sistema de gestión de reservas con estados como "Pendiente", "Aceptada" y "Rechazada".
- Visualización de disponibilidad de salas en tiempo real.
- Carga de imágenes para cada sala.
- Diseño responsivo utilizando Bootstrap.

## Tecnologías utilizadas

- PHP 8.1+
- Laravel 10
- Blade para plantillas
- Bootstrap 5 para diseño responsivo
- MySQL para almacenamiento de datos
- Almacenamiento de imágenes en el sistema de archivos de Laravel

## Requisitos previos

Antes de comenzar, asegúrate de tener los siguientes requisitos instalados en tu sistema:

- [PHP 8.1+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [MySQL](https://dev.mysql.com/downloads/)

## Instalación

Sigue estos pasos para configurar el proyecto localmente:

1. Clona el repositorio:
```bash
git clone https://github.com/CesarAzola/admin-cowork.git
cd admin-cowork
```
2. Instala las dependencias:
```bash 
composer install
```
```bash 
npm install
```
Copia el archivo .env.example a .env y configura tus variables de entorno, incluyendo la conexión a la base de datos y el almacenamiento de archivos:
cp .env.example .env

3. Genera la clave de la aplicación:
```bash 
php artisan key:generate
```
4. Configura la base de datos en el archivo .env y luego ejecuta las migraciones para crear las tablas necesarias:

```bash
php artisan migrate
```
5. Si deseas añadir datos de prueba, puedes ejecutar los seeders:
```bash
php artisan db:seed
```
6. Crea un enlace simbólico para el almacenamiento de imágenes en la carpeta pública:
```bash
php artisan storage:link
```
7. Inicia el servidor de desarrollo:
```bash
php artisan serve
```
```bash
npm run dev
```

