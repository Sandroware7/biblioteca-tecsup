# 📚 Sistema de Biblioteca Tecsup

Sistema de gestión bibliotecaria desarrollado en **Laravel 11**. Permite a los estudiantes reservar libros y a los administradores gestionar el inventario, los préstamos y las devoluciones.

## 🚀 Características Principales

### 🎓 Perfil Estudiante
* **Catálogo en Vivo:** Visualización de libros con indicador de stock y disponibilidad (Verde/Rojo).
* **Solicitud de Préstamos:** Interfaz sencilla para reservar libros disponibles.
* **Dashboard Personal:** Visualización del historial de préstamos y estado actual.

### 👮‍♂️ Perfil Administrador
* **Gestión Total (CRUD):** Crear, editar y eliminar libros del sistema.
* **Gestión de Préstamos:** Panel exclusivo para ver quién tiene cada libro.
* **Control de Devoluciones:** Funcionalidad para registrar el retorno de libros (restaura el stock automáticamente).
* **Seguridad:** Rutas protegidas mediante Middleware personalizado (`IsAdmin`) para evitar accesos no autorizados.

---

## 🛠️ Requisitos e Instalación

Sigue estos pasos para desplegar el proyecto en tu máquina local:

1. **Clonar el repositorio**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd biblioteca-tecsup

2. **Instalar dependencias de PHP y Node**
    ```bash
    composer install
    npm install && npm run build
3. **Configurar entorno**

- Renombrar el archivo de configuración:
   ```bash
  cp .env.example .envd
   
- Renombrar el archivo de configuración:
    ```bash
    php artisan key:generate
  
- Asegúrate de que la base de datos (SQLite) esté configurada en el archivo .env.

4. **Base de Datos y Datos de Prueba Ejecuta este comando para crear las tablas y cargar los usuarios por defecto y 250 libros de prueba:**
    ```bash
    php artisan migrate:fresh --seed
   
5. **Iniciar Servidor**
    ```bash
    php artisan serve
   
## 🔑 Credenciales de Acceso

El sistema viene pre-cargado con usuarios de prueba (generados por el Seeder), pero también permite el registro manual con roles dinámicos.

### 👤 Usuarios por Defecto

| Rol           | Correo                 | Contraseña |
|---------------|------------------------|------------|
| Administrador | admin@tecsup.edu.pe    | password   |
| Estudiante    | alumno@tecsup.edu.pe   | password   |

### 📝 Registro de Nuevos Usuarios

El formulario de registro (/register) cuenta con un sistema de roles:

1. **Para ser Estudiante: Deja el campo "Código de Empleado" vacío.**

2. **Para ser Administrador: Ingresa la clave maestra TECSUP2025 en el campo "Código de Empleado".**

### 💻 Tecnologías Utilizadas

- Backend: Laravel 11 (PHP 8.2+)

- Frontend: Blade, Tailwind CSS, Alpine.js

- Base de Datos: SQLite

- Autenticación: Laravel Breeze
