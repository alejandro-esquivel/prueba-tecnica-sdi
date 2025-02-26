# Prueba técnica de SDi

Este repositorio contiene la prueba técnica para la posición de Programador/a PHP en SDi. Digital group

El entorno utilizado en el desarrollo de la prueba técnica es el siguiente:

* **Sistema operativo**: Ubuntu (con WSL2 en Windows 11)
* **Servicio HTTP**: Proporcionado por Laravel Sail
* **Versión de PHP**: 8.3.17
* **Base de datos**: MySQL
* **Editor de código**: PHPStorm

Se utilizó Laravel Sail como entorno dockerizado.


<!--  El servicio HTTP fue provisto por Laragon -->

## Instalación

Para instalar y configurar el proyecto, se ejecutarán los siguientes comandos:

* Clonamos el repositorio:
  `git clone https://github.com/alejandro-esquivel/prueba-tecnica-sdi.git`
* Nos posicionamos dentro de la carpeta del proyecto: `cd prueba-tecnica-sdi`
* Instalamos las dependencias del proyecto: `composer install`
* Creamos un .env basándonos en el .env de ejemplo: `cp .env.example .env`
* Generamos una nueva key de Laravel: `php artisan key:generate`
* Inicializaremos Sail: `./vendor/bin/sail up`
* Entraremos al contenedor de Sail: `./vendor/bin/sail shell`
* Migraremos la base de datos: `php artisan migrate`

Una vez migrados los datos, podremos acceder a la documentación del proyecto mediante [http://127.0.0.1:80/docs/api](http://127.0.0.1:80/docs/api)


© Alejandro Esquivel Rodríguez 26/02/2025
