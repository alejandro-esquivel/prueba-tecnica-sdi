# Prueba técnica de SDi

Este repositorio contiene la prueba técnica para la posición de Programador/a PHP en SDi. Digital group

El entorno utilizado en el desarrollo de la prueba técnica es el siguiente:
* **Sistema operativo**: Windows 11
* **Servicio HTTP**: Apache
* **Versión de PHP**: 8.3.17
* **Base de datos**: SQLite
* **Editor de código**: PHPStorm

El sevicio HTTP fue provisto por Laragon

## Instalación

Para instalar y configurar el proyecto, se ejecutarán los siguientes comandos:

* Clonamos el repositorio:
`git clone https://github.com/alejandro-esquivel/prueba-tecnica-sdi.git`
* Nos posicionamos dentro de la carpeta del proyecto: `cd prueba-tecnica-sdi`
* Instalamos las dependencias del proyecto: `composer install`
* Creamos un .env basándonos en el .env de ejemplo: `cp .env.example .env`
* Generamos una nueva key de Laravel: `php artisan key:generate`
* Migraremos la base de datos: `php artisan migrate`

Para que el proyecto funcione, ejecutaremos el siguiente comando `php artisan serve`


© Copyright Alejandro Esquivel Rodríguez 26/02/2024
