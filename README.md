# Cowork Friendly

![Laravel](https://img.shields.io/badge/Laravel-10.x-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.3.x-orange.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

##### --- Technical test ---

**CoworkFriendly** es una aplicación web desarrollada con Laravel que permite a los usuarios reservar salas para horarios específicos. El sistema incluye control de acceso basado en roles, permitiendo a los administradores gestionar salas y reservas, mientras que los clientes pueden crear y visualizar sus propias reservas.

## Características

- **Autenticación de Usuarios:** Registro y inicio de sesión seguro.
- **Control de Acceso por Roles:** Roles de **Administrador** y **Cliente**.
    - **Administrador:**
        - Gestionar salas (crear, editar, eliminar).
        - Ver, editar y eliminar todas las reservas.
    - **Cliente:**
        - Crear nuevas reservas.
        - Ver sus propias reservas.
- **Validación de Reservas:** Evita reservas superpuestas para la misma sala.
- **Diseño Responsivo**

## Tecnologías Utilizadas

- **Framework:** [Laravel 10](https://laravel.com/docs/10.x)
- **Lenguaje:** PHP 8.3
- **Base de Datos:** MySQL
- **Frontend:** Blade, Bootstrap 5, AdminLTE 3
- **Autenticación:** Laravel UI
- **Control de Versiones:** Git

## Instalación

1. **Clonar el Repositorio:**

     ```bash
     git clone git@github.com:adc91/laravel-cowork-friendly.git
     cd laravel-cowork-friendly
     ```

2. **Copiar el Archivo .env:**

     ```bash
     cp .env.example .env
     ```

3. **Generar la Clave de la Aplicación:**

     ```bash
     php artisan key:generate
     ```

4. **Configurar Variables de Entorno:**

     Abre el archivo `.env` y establece las credenciales de la base de datos y otras configuraciones necesarias.

     ```env
    APP_NAME=CoworkFriendly
    APP_KEY=base64:GENERATED_KEY

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_name
    DB_USERNAME=db_user
    DB_PASSWORD=db_password
     ```

5. **Configuración de la Base de Datos:**

     - **Crear la Base de Datos:**

         Crea una nueva base de datos en MySQL para la aplicación.

     - **Ejecutar Migraciones:**

         ```bash
         php artisan migrate
         ```

     - **Sembrar la Base de Datos:**

         Llena la base de datos con un usuario administrador.

         ```bash
         php artisan db:seed --class=AdminUserSeeder
         ```

         Credenciales de Administrador por Defecto:

         - Email: admin@coworkfriendly.com
         - Contraseña: admin12345

6. **Ejecutar la Aplicación:**
     - **Instalar dependencias:**
         ```bash
         npm run install
         ```

     - **Compilar Activos Frontend:**

         ```bash
         npm run dev
         ```

         Para producción:

         ```bash
         npm run build
         ```

     - **Iniciar el Servidor de Desarrollo:**

         ```bash
         php artisan serve
         ```

7. **Acceder a la Aplicación:**

     Abre tu navegador y navega a [http://localhost:8000](http://localhost:8000).

## Uso

### Roles de Usuario

- **Administrador:**
    - Gestionar Salas: Crear, editar y eliminar salas.
    - Gestionar Reservas: Ver todas las reservas, actualizar su estado y eliminar reservas.

- **Cliente:**
    - Crear Reservas: Reservar una sala para una fecha y hora específica.
    - Ver Reservas: Visualizar y gestionar sus propias reservas.

### Flujo de Trabajo de Reservas

1. **Crear una Reserva:**
     - Selecciona una sala de la lista disponible.
     - Elige una fecha y hora para la reserva.

2. **Validación:**
     - El sistema verifica que no existan reservas superpuestas para evitar doble reserva. Si hay un conflicto, se muestra un mensaje de error.

3. **Aprobación por el Administrador:**
     - Los administradores pueden ver todas las reservas y actualizar su estado a Aceptada o Rechazada.
