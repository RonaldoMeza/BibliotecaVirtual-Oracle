# 📚 Biblioteca Virtual - Laravel + Oracle

Este proyecto implementa un sistema de gestión de biblioteca con autenticación de usuarios, roles (Bibliotecario y Usuario), gestión de libros, préstamos, autores y categorías. Incluye procedimientos PL/SQL ejecutados desde Laravel.

---

## 🚀 Tecnologías

- ⚙️ Laravel 12
- 🐘 Oracle Database (conexión vía Yajra OCI8)
- 💻 PL/SQL (procedimientos y paquetes)
- 🎨 Blade + TailwindCSS
- 🧩 Autenticación manual con roles
- 🔁 Artisan Migrations + Seeders

---

## 📦 Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js y NPM
- Oracle Database 21c o superior
- Extensión `pdo_oci8` (recomendado: usar [Yajra OCI8](https://github.com/yajra/pdo-via-oci8))
- Laravel CLI

---

## 🔧 Instalación

1. **Clona el repositorio**

        git clone https://github.com/RonaldoMeza/BibliotecaVirtual-Oracle.git
        cd BibliotecaVirtual-Oracle
   
2. **Instala dependencias PHP y JS**

       composer install
       npm install && npm run build

3. **Configura el entorno .env**

Copia el archivo de ejemplo y configura tu conexión a Oracle:

    cp .env.example .env
    php artisan key:generate


En el .env:

    DB_CONNECTION=oracle
    DB_HOST=localhost
    DB_PORT=1521
    DB_DATABASE=xe
    DB_USERNAME=USER03
    DB_PASSWORD=tecsup

4. **Configura el proveedor Yajra (si aplica)**

    Asegúrate de tener en tu config/database.php la conexión a Oracle definida como:

        'oracle' => [
            'driver'         => 'oracle',
            'tns'            => '',
            'host'           => env('DB_HOST', 'localhost'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'xe'),
            'username'       => env('DB_USERNAME', 'USER03'),
            'password'       => env('DB_PASSWORD', ''),
            'charset'        => 'AL32UTF8',
            'prefix'         => '',
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        ],

5. **Ejecuta migraciones y seeders (Asegurate de tener creado la base de datos user03 configurado en los pasos anteriores)**

        php artisan migrate --database=oracle --seed

    Esto creará las tablas necesarias y llenará:

    Roles: BIBLIOTECARIO, USUARIO

    Usuarios de prueba (admin y usuario)

    Categorías, autores, libros de ejemplo

6. **Corre el servidor**

        php artisan serve

    Accede desde: http://localhost:8000


👥 Cuentas de Prueba
Rol	  Email	  Contraseña
Bibliotecario	admin@gmail.com  admin123
Usuario	usuario@gmail.com  usuario123


⚠️ Notas Especiales

- Este proyecto hace uso de paquetes PL/SQL (pkg_usuario, pkg_prestamo) que deben estar creados previamente en Oracle después de migrar.
- Asegúrate que el usuario de Oracle tenga privilegios sobre el tablespace USERS.

        CREATE OR REPLACE PACKAGE pkg_prestamo AS
        PROCEDURE sp_crear_prestamo(
            p_user     IN NUMBER,
            p_libro    IN NUMBER,
            p_new_id   OUT NUMBER
        );

        PROCEDURE sp_devolver_libro(
            p_prestamo IN NUMBER
        );

        PROCEDURE sp_historial_usuario(
            p_user   IN NUMBER,
            p_cur    OUT SYS_REFCURSOR
        );
        END pkg_prestamo;
        /

        CREATE OR REPLACE PACKAGE BODY pkg_prestamo AS

        PROCEDURE sp_crear_prestamo(
            p_user     IN NUMBER,
            p_libro    IN NUMBER,
            p_new_id   OUT NUMBER
        ) IS
        BEGIN
            INSERT INTO prestamos (
            id_prestamo, user_id, libro_id, fecha_prestamo, estado
            ) VALUES (
            PRESTAMOS_ID_PRESTAMO_SEQ.NEXTVAL,
            p_user,
            p_libro,
            SYSDATE,
            'PRESTADO'
            )
            RETURNING id_prestamo INTO p_new_id;

            COMMIT;
        EXCEPTION
            WHEN OTHERS THEN
            p_new_id := -1;
            ROLLBACK;
        END sp_crear_prestamo;

        PROCEDURE sp_devolver_libro(
            p_prestamo IN NUMBER
        ) IS
        BEGIN
            UPDATE prestamos
            SET fecha_devolucion = SYSDATE,
                estado           = 'DEVUELTO'
            WHERE id_prestamo = p_prestamo;

            COMMIT;
        END sp_devolver_libro;

        PROCEDURE sp_historial_usuario(
            p_user   IN NUMBER,
            p_cur    OUT SYS_REFCURSOR
        ) IS
        BEGIN
            OPEN p_cur FOR
            SELECT p.id_prestamo,
                    l.titulo,
                    p.fecha_prestamo,
                    p.fecha_devolucion,
                    p.estado
                FROM prestamos p
                JOIN libros l 
                ON l.id_libro = p.libro_id
            WHERE p.user_id = p_user
            ORDER BY p.fecha_prestamo DESC;
        END sp_historial_usuario;

        END pkg_prestamo;
        /


📝 Autor
Desarrollado por Ronaldo Meza Pastrana – Perú 🇵🇪
Repositorio GitHub

✅ Estado del Proyecto
📌 Proyecto funcional, completo para entrega académica.
✔️ Roles, autenticación, PL/SQL, CRUDs y estilos diferenciados para usuario y bibliotecario.

