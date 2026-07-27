# Blog

Blog con panel de administración construido en PHP a medida sobre componentes de Laravel (Eloquent) y otras librerías, no sobre el framework Laravel completo.

## Características

- Listado público de entradas del blog con paginación (3 entradas por página).
- Vista de detalle de cada entrada.
- Panel de administración protegido por login (sesión + `password_verify`) para crear, editar y borrar entradas y usuarios.
- Validación de formularios (título/contenido obligatorios, email válido) con `siriusphp/validation`.
- Registro de eventos (login/logout) en fichero de log mediante Monolog (`app/Log.php`, `logs/aplicacion.log`).
- Enrutado ligero con Phroute, separando rutas públicas de las del panel `/admin` mediante un filtro de acceso.

## Tecnologías

- PHP
- `illuminate/database` (Eloquent ORM, sin el resto del framework Laravel)
- `phroute/phroute` (enrutador)
- `twig/twig` (motor de plantillas)
- `vlucas/phpdotenv` (variables de entorno)
- `siriusphp/validation` (validación de formularios)
- `monolog/monolog` (logging)
- MySQL (base de datos)

## Instalación / Cómo ejecutarlo

1. Instala las dependencias con Composer:
   ```
   composer install
   ```
2. Copia `.env.example` a `.env` y rellena los datos de conexión a MySQL (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).
3. Crea en esa base de datos las tablas `blog_entradas` (con `titulo`, `contenido`, `imagen`) y de usuarios (con `email` y `password` hasheada).
4. Sirve la carpeta `public/` con Apache (usa el `.htaccess` incluido) o con el servidor embebido de PHP:
   ```
   php -S localhost:8000 -t public
   ```
5. Accede a `/acceso/login` para entrar al panel de administración en `/admin`.

## Licencia

Sin archivo de licencia en el repositorio.
