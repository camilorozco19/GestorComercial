# GestorComercial

Sistema web de gestión comercial desarrollado como proyecto académico. Permite administrar información de productos, categorías y clientes, gestionar la persistencia de datos mediante Supabase y consultar indicadores empresariales a través de un dashboard integrado con Looker Studio.

## Integrantes

- **Camilo Orozco Gutierrez**
- **Chelsyn Valentina Velez**

## Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| Laravel 13 | Desarrollo del backend y aplicación web |
| PHP 8.4 | Lenguaje de programación |
| PostgreSQL 17 | Sistema de gestión de base de datos |
| Supabase | Servicio de base de datos en la nube |
| HTML5 | Estructura de las vistas |
| CSS3 | Diseño e interfaz |
| JavaScript | Recursos del frontend |
| Looker Studio | Visualización y análisis de datos |
| Git | Control de versiones |
| GitHub | Repositorio del proyecto |

## Funcionalidades

- Consulta de indicadores generales del negocio.
- Registro, consulta, edición y eliminación de productos.
- Administración de categorías.
- Administración de clientes.
- Persistencia de información en Supabase.
- Visualización de ventas e inventario.
- Dashboard interactivo integrado mediante iframe.
- Filtros dinámicos por periodo y estado de las ventas.

## Arquitectura de la base de datos

El sistema utiliza PostgreSQL alojado en Supabase.

La base de datos está compuesta por nueve tablas:

1. `usuarios`
2. `categorias`
3. `productos`
4. `clientes`
5. `proveedores`
6. `ventas`
7. `detalle_ventas`
8. `pagos`
9. `auditoria`

Las tablas están relacionadas mediante claves primarias y foráneas para mantener la integridad de la información.

### Archivos de base de datos

- **schema.sql:** contiene las instrucciones SQL para crear la estructura de las tablas y sus relaciones.
- **seed.sql:** contiene los datos de prueba utilizados en el proyecto.
- **Diagrama DER:** representa las entidades y relaciones de la base de datos.

## Dashboard de análisis

El proyecto integra un informe de Looker Studio mediante un iframe dentro del panel principal de Laravel.

El dashboard permite consultar:

- Valor total de ventas.
- Cantidad de ventas.
- Ventas pendientes.
- Distribución de ventas por estado.
- Comportamiento de las ventas en el tiempo.
- Promedio por venta.
- Cantidad y valor de productos en inventario.
- Productos con stock bajo.
- Productos agrupados por categoría.

Incluye controles dinámicos para filtrar la información por fechas y estado de venta.

## Requisitos del sistema

- PHP 8.2 o superior.
- Composer.
- Node.js y npm.
- Extensión PHP `pdo_pgsql`.
- Proyecto y credenciales de conexión de Supabase.
- Git.

## Instalación y ejecución

### 1. Clonar el repositorio

```bash
git clone https://github.com/camilorozco19/GestorComercial.git
```

### 2. Ingresar al proyecto

```bash
cd GestorComercial
```

### 3. Instalar dependencias de PHP

```bash
composer install
```

### 4. Instalar dependencias del frontend

```bash
npm install
```

### 5. Configurar las variables de entorno

Crear el archivo `.env` a partir del archivo de ejemplo:

```bash
cp .env.example .env
```

En Windows PowerShell también se puede utilizar:

```powershell
Copy-Item .env.example .env
```

### 6. Generar la clave de Laravel

```bash
php artisan key:generate
```

### 7. Configurar la conexión con Supabase

Editar el archivo `.env` y configurar los siguientes parámetros con las credenciales privadas del proyecto:

```env
DB_CONNECTION=pgsql
DB_HOST=HOST_DE_SUPABASE
DB_PORT=PUERTO_DE_SUPABASE
DB_DATABASE=postgres
DB_USERNAME=USUARIO_DE_SUPABASE
DB_PASSWORD=CONTRASEÑA_DE_SUPABASE
DB_SSLMODE=require
```

Las credenciales deben obtenerse desde la configuración de conexión de Supabase. No deben compartirse públicamente.

### 8. Limpiar la configuración de Laravel

```bash
php artisan config:clear
```

### 9. Ejecutar la aplicación

En una terminal:

```bash
npm run dev
```

En otra terminal:

```bash
php artisan serve
```

### 10. Abrir el sistema

Ingresar desde el navegador a:

```text
http://127.0.0.1:8000
```

## Consideraciones importantes

- La base de datos utilizada se encuentra alojada en Supabase.
- El archivo `.env` contiene información privada y no debe subirse al repositorio.
- Los archivos `schema.sql` y `seed.sql` sirven como referencia para preparar la base de datos.
- No es necesario ejecutar nuevamente la creación de tablas si estas ya existen en Supabase.
- El dashboard de Looker Studio requiere los permisos de visualización correspondientes.

## Repositorio

GitHub: https://github.com/camilorozco19/GestorComercial

## Licencia

Proyecto académico desarrollado con fines educativos.