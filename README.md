<p align="center"><a href="https://vidadigital.com.ar/" target="_blank"><img src="https://raw.githubusercontent.com/MarkeZito3/Vida-Digital-Challenge/master/favicon.png" width="400" alt="Vida Digital Logo"></a></p>


## Challenge 🤩:

Vida Digital presenta un reto en donde se debe realizar una Aplicación en Laravel la cual
cumpla con los siguientes requerimientos:
- Migración en Base de Datos MySql de las siguientes entidades: Empresa, Sucursal,
Empleado con sus respectivas relaciones.
- CRUD’s (Empresas, Sucursales, Empleados).
- Bootstrap

## Aplicación

>Versión: v0.1.0-alpha 🚀
>
>Author: Pereyra Marcos

Esta aplicación es un gestor de empleados para empresas, su funcionalidad es que las empresas se registran, agreguen de dónde son y dónde están sus sucursales y a los empleados de las ellas. 

Las funcionalidades son un tanto limitadas teniendo en cuenta que una aplicación creada en tan solo 5 días. La misma cuenta con responsive para celulares y el estilo fue enteramente **Bootstrap**, nada de css propio. 

😥 Por el momento se encuentran deshabilitadas las siguientes opciones:
- **Editar** para **Empleados** 
- **Roles** para los **Usuarios** 
- **Managers** (es decir que varios usuarios podrán manejar varias empresas, no solamente el que las creó)

## Instalación:
1. Clonar el repositorio

        git clone https://github.com/MarkeZito3/Vida-Digital-Challenge.git

2. Instalar todas las dependencias

    - Instalación de **composer** (esto puede tardar un tiempo):

            composer install

    - Instalación del **package.json**:

            npm install

3. Crear el archivo .env

    Este archivo es necesario para realizar las conexiones con la base de datos.

    Para crearlo basta con renombrar el archivo `.env.example` como `.env`.

    Una vez dentro, realizar la conexión a gusto.

4. Generar una clave

        php artisan key:generate

5. Migrar y sembrar la base de datos

        php artisan migrate

6. Ejecutar los servidores locales de php y node

    Correr el servidor del CRUD:

        php artisan serve

    En una consola aparte ejecutar:

        npm run dev

7. Vincular Storage

    Se debe hacer esta [**Vinculación Simbólica**](https://laravel.com/docs/9.x/filesystem#the-public-disk) para poder compartir fácilmente a discos públicos

        php artisan storage:link

Y todo listo! 😁 

Solo faltaría entrar en `http://localhost:8000/` o `http://127.0.0.1:8000/` y disfrutar de la aplicación! 🥰.

>                                               
> Todo tipo de feedback es bien recibido 
>                                                               
> Pereyra Marcos
> 
> mail: markkes3.mp@gmail.com
