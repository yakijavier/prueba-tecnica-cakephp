# Prueba Técnica - CakePHP

Este proyecto es una aplicación de gestión de usuarios desarrollada en **CakePHP 5.x** con **PHP 8.2.x**. Incluye autenticación, autorización basada en roles (admin/user), API RESTful y una interfaz web estilizada con **Tabler**.

---

## Estructura del Proyecto

prueba-tecnica-cakephp/
├── src/
│ ├── Controller/ # Controladores principales
│ ├── Model/ # Entidades y tablas
│ ├── Middleware/ # Middlewares personalizados
│ └── Application.php # Configuración de la app
├── config/
│ ├── app.php # Configuración general
│ └── routes.php # Rutas web y API
├── templates/
│ ├── Profiles/ # Vistas específicas de perfiles
│ └── Users/ # Vistas específicas de usuarios (incluido el login)
├── webroot/
│ ├── css/tabler.min.css # CSS de Tabler
│ └── js/tabler.min.js # JS de Tabler

---

## Decisiones Técnicas

- **Framework**: CakePHP 5.x
- **Base de datos**: MySQL
- **ORM**: Uso del ORM de CakePHP para seguridad y facilidad.
- **Autenticación**: Plugin `cakephp/authentication`.
- **Autorización**: Control manual basado en el rol (`Profiles.role`) del usuario.
- **Estilo**: Tabler UI integrado desde archivos compilados.
- **API REST**: Rutas con prefijo `/api`, incluye login y CRUD con control de acceso.
- **Middleware personalizado**:
  - `FriendlyBodyParserMiddleware`: para mostrar errores más claros en la API.
  - `ApiErrorMiddleware`: para interceptar errores comunes en endpoints API.
- **Errores amigables en la web**: Se personalizó `error400.php`, `error500.php` y otros templates para UX más amigable.
- **Producción vs Desarrollo**: El entorno se controla vía `.env` o directamente en `config/app.php`.

---

## Estructura de la Base de Datos

### Tabla: `users`

| Campo       | Tipo       | Descripción                      |
|-------------|------------|----------------------------------|
| id          | int (PK)   | ID del usuario                   |
| email       | varchar    | Email único                      |
| password    | varchar    | Contraseña (hasheada)            |
| name        | varchar    | Nombre del usuario               |
| phone       | varchar    | Teléfono de contacto             |
| profile_id  | int (FK)   | Relación con `profiles.id`       |

### Tabla: `profiles`

| Campo     | Tipo       | Descripción                        |
|-----------|------------|------------------------------------|
| id        | int (PK)   | ID del perfil                      |
| role      | varchar    | Rol del usuario                    |

---

## Cómo ejecutar el proyecto

## Requisitos

- **XAMPP** (incluye PHP, Apache y MySQL)
- **Composer** (para gestionar dependencias de PHP)
- Navegador web
- **Postman** o **Insomnia** (para probar la API)

### Pasos

1. **Clonar el proyecto**

```
git clone https://github.com/yakijavier/prueba-tecnica-cakephp.git
cd prueba-tecnica-cakephp
```

2. **Instalar dependencias con Composer**

```
composer install
```

3. **Crear base de datos y las tablas**

```sql
CREATE DATABASE prueba_tecnica DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE prueba_tecnica;

CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    phone VARCHAR(20),
    profile_id INT,
    FOREIGN KEY (profile_id) REFERENCES profiles(id)
);
```

4. **Agregar datos de prueba**

```sql
INSERT INTO profiles (role) VALUES ('admin'), ('user');

INSERT INTO users (email, password, name, phone, profile_id)
VALUES ('admin@example.com', '$2y$10$Yvg89kJVWgVUP5YlFY/EeOFvjoveJL1.u.WMK3xtHYQZPCRAqSlKe', 'Admin User', '123456789', 1);
```

5. **Configurar conexión**

En `config/app_local.php`:

```php
'debug' => false,

'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'prueba_tecnica',
        'driver' => \Cake\Database\Driver\Mysql::class,
        'encoding' => 'utf8mb4',
        'timezone' => 'UTC',
    ],
],
```

6. **Levantar el servidor**

```
bin/cake server
```

Accedé a: http://localhost:8765

## Acceso

Email: admin@example.com
Password: admin

## API

### Obtener usuarios

```bash
curl -X GET http://localhost:8765/api/users \
  -u admin@example.com:admin \
  -H "Accept: application/json"
```

### Modificar usuarios

```bash
curl -X PUT http://localhost:8765/api/users/ID_DEL_USUARIO \
  -u admin@example.com:admin \
  -H "Accept: application/json"
```

Formato del body:

```json
{
  "email": "admin@example.com",
  "password": "admin",
  "name": "Admin User",
  "phone": "123456781",
  "profile_id": 1
}
```

### Eliminar usuarios

```bash
curl -X DELETE http://localhost:8765/api/users/ID_DEL_USUARIO \
  -u admin@example.com:admin \
  -H "Accept: application/json"
```
