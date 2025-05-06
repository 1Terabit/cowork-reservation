
# Sistema de Reservas de Coworking Test
Este proyecto es una aplicación web desarrollada en Laravel para gestionar reservas de espacios en un coworking. La aplicación permite a los usuarios registrarse, iniciar sesión y reservar salas, mientras que los administradores pueden gestionar las salas y supervisar las reservaciones.

## 📋 Requisitos Técnicos
- PHP 8.1 (obligatorio)
- MySQL 8.1
- Composer
- Node.js y NPM (para los assets)

## ✨ Características Principales

### 👥 Roles de Usuario
- **Administrador**:
  - Gestión de salas (crear, editar, eliminar)
  - Cambio de estado de reservaciones
  - Visualización de reservaciones por sala
  - Exportación a Excel de reservaciones

- **Cliente**:
  - Registro e inicio de sesión
  - Reserva de salas disponibles
  - Listado de reservaciones propias
  - Cancelación de reservas pendientes

### 🛠️ Funcionalidades
- Reservas de salas con duración de una hora
- Verificación automática de disponibilidad de salas
- Gestión de estados de reservas (Pendiente, Aceptada, Rechazada)
- Exportación de reservaciones a Excel
- Interfaz responsiva con Bootstrap 5
- Diseño moderno y amigable

## 🚀 Instalación
Sigue estos pasos para instalar y configurar la aplicación:

### 1. Clonar el repositorio
### 2. Instalar dependencias de PHP
### 3. Configurar el archivo .env
### 4. Configurar la base de datos
Edita el archivo `.env` con tus credenciales de MySQL:

### 5. Ejecutar migraciones y seeders
### 6. Iniciar el servidor de desarrollo
La aplicación estará disponible en: [http://localhost:8000](http://localhost:8000)

## 🔑 Acceso al Sistema
Después de ejecutar los seeders, podrás acceder con las siguientes credenciales:

### Administrador:
- Email: admin@example.com
- Contraseña: password

### Cliente:
- Puedes registrar un nuevo usuario desde la página de registro
- O usar: cliente@example.com / password

## 📁 Estructura del Proyecto
- `app/Models`: Contiene los modelos de datos (User, Room, Reservation)
- `app/Http/Controllers`: Controladores para gestionar las peticiones
- `resources/views`: Vistas Blade para la interfaz de usuario
- `routes`: Definición de rutas de la aplicación
- `database/migrations`: Migraciones para crear las tablas en la base de datos
- `database/seeders`: Seeders para poblar la base de datos con datos iniciales

## 📱 Uso de la Aplicación

### Para Clientes
1. Registrarse o iniciar sesión
2. Ver las salas disponibles en la página principal
3. Seleccionar una sala para reservar haciendo clic en el botón "Reservar"
4. Elegir fecha y hora para la reserva en el formulario
5. Confirmar la reserva haciendo clic en "Crear Reservación"
6. Ver el listado de reservas propias en "Mis Reservas"
7. Cancelar reservas pendientes si es necesario

### Para Administradores
1. Iniciar sesión como administrador
2. Acceder al panel de administración
3. Gestionar salas (crear, editar, eliminar)
4. Ver todas las reservaciones en la sección "Reservaciones"
5. Filtrar reservaciones por sala usando el selector
6. Cambiar el estado de las reservaciones (Pendiente, Aceptada, Rechazada)
7. Exportar reservaciones a Excel haciendo clic en "Exportar a Excel"

## 📊 Dashboard de Administrador
El dashboard muestra información relevante:
- Total de salas disponibles
- Total de reservaciones realizadas
- Reservaciones pendientes de aprobación

## 🔧 Solución de Problemas Comunes

### La aplicación no inicia
- Verifica que todas las dependencias estén instaladas
- Asegúrate de que la base de datos esté configurada correctamente
- Comprueba los permisos de los directorios de almacenamiento

### Error en las migraciones
- Verifica la conexión a la base de datos
- Asegúrate de que la base de datos exista
- Ejecuta `php artisan migrate:fresh --seed` para reiniciar las migraciones
