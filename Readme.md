# HealthPet S.A. — Sistema Integral de Gestión Veterinaria y E-Commerce

HealthPet S.A. es una plataforma web enterprise de gestión hospitalaria clínica, punto de venta (POS) y comercio electrónico B2C orientada a centros de salud veterinaria. La solución resuelve la fragmentación operativa sustituyendo registros manuales e islas de información por una arquitectura unificada que automatiza el control de inventario multicanal, la facturación física y digital, la conciliación de cuentas por cobrar (gestión de deudas), el agendamiento automatizado de citas médicas y el procesamiento de pagos en línea a través de pasarelas bancarias. El sistema garantiza la trazabilidad financiera, la consistencia de stock en tiempo real y la reducción de tiempos muertos operacionales en clínicas de alta demanda.

---

## Arquitectura y Stack Tecnológico

El sistema adopta el patrón arquitectónico Model-View-Controller (MVC) provisto por el ecosistema Laravel, complementado con componentes reactivos livianos en el cliente para maximizar la velocidad de respuesta sin sobrecargar el servidor.

| Tecnología | Categoría | Rol Arquitectónico |
| :--- | :--- | :--- |
| **PHP 8.2+ / Laravel 11.9** | Backend Core | Motor principal de la aplicación. Gestiona la lógica de negocio, enrutamiento seguro, autenticación, control de acceso basado en roles (RBAC) y abstracción de datos mediante Eloquent ORM. |
| **Transbank Webpay SDK 2.0** | Pasarela de Pagos | Módulo de integración financiera que procesa transacciones electrónicas (tarjetas de débito y crédito) bajo protocolo seguro en el flujo de checkout. |
| **Barryvdh / Laravel-DomPDF** | Motor de Documentos | Generación dinámica de comprobantes de venta, recibos fiscales y reportes PDF en el servidor a partir de plantillas estructuradas. |
| **Blade & Alpine.js** | Capa de Presentación | Renderizado del lado del servidor (SSR) mediante Blade, potenciado con Alpine.js para la reactividad en el cliente (carrito lateral, modales, búsqueda dinámica y validación de stock). |
| **TailwindCSS 3 / PostCSS** | Framework UI/UX | Sistema de diseño utilitario para la construcción de interfaces responsivas y de alta densidad de información tanto para el backoffice operativo como para el storefront B2C. |
| **Vite 5** | Bundler & Build Tool | Empaquetado y optimización de recursos estáticos, procesamiento de estilos CSS y scripts JavaScript en tiempo de compilación y desarrollo. |
| **MySQL / PostgreSQL** | Base de Datos Relacional | Almacenamiento persistente transaccional que garantiza integridad referencial (ACID) en ventas, histórico de inventario, movimientos de deudas y usuarios. |

---

## Guía de Despliegue a Prueba de Fallos (Entorno Local)

Siga estrictamente la siguiente secuencia de comandos para instanciar el entorno de desarrollo y la base de datos desde cero.

### Requisitos Previos
- **PHP** >= 8.2 (con extensiones `pdo`, `mbstring`, `openssl`, `curl`, `gd`, `xml` habilitadas)
- **Composer** >= 2.5
- **Node.js** >= 18.0 & **npm** >= 9.0
- **MySQL** / **MariaDB** >= 8.0 (o **SQLite**)

### 1. Clonar el Repositorio
```bash
git clone https://github.com/CaCortez384/HealthPet-S.A.git
cd HealthPet-S.A
```

### 2. Configurar Variables de Entorno
Cree el archivo de configuración `.env` a partir de la plantilla estandarizada:
```bash
cp .env.example .env
```
*Edite `.env` con las credenciales de su servidor de base de datos local:*
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthpet_db
DB_USERNAME=root
DB_PASSWORD=su_contraseña
```

### 3. Instalar Dependencias del Proyecto
Ejecute la instalación de dependencias del backend y frontend:
```bash
composer install
npm install
```

### 4. Inicializar Claves y Almacenamiento
Genera la clave de encriptación de la aplicación y crea el enlace simbólico para la gestión de archivos multimedia (imágenes de productos):
```bash
php artisan key:generate
php artisan storage:link
```

### 5. Migrar e Inicializar la Base de Datos
Ejecute las migraciones de esquema e inserte los datos semilla iniciales (roles, categorías y configuraciones):
```bash
php artisan migrate --seed
```

### 6. Compilar Recursos Estáticos y Levantar Servidores
En una terminal, compile los activos del frontend:
```bash
npm run dev
```

En una segunda terminal, inicie el servidor de desarrollo de Laravel:
```bash
php artisan serve
```
Acceda a la aplicación mediante su navegador en `http://localhost:8000`.

---

## Estructura del Repositorio

```
HealthPet-S.A/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Lógica de controladores (Inventario, Ventas, Deudas, Webpay, Carrito, Citas)
│   │   └── Middleware/         # Middleware de control de acceso por roles (admin, editor) y autenticación
│   └── Models/                 # Modelos Eloquent ORM (Producto, Venta, DetalleVenta, Deuda, Pago, Pedido, Cita)
├── bootstrap/                  # Configuración de arranque de la aplicación y registro de servicios
├── config/                     # Archivos de configuración global (base de datos, servicios, correo, sesiones)
├── database/
│   ├── factories/              # Generadores de datos ficticios para pruebas unitarias y de integración
│   ├── migrations/             # Definición de esquemas y tablas de la base de datos relacional
│   └── seeders/                # Poblamiento inicial de datos indispensables (roles, catálogos)
├── public/                     # Punto de entrada web público (index.php), activos compilados y enlace de almacenamiento
├── resources/
│   ├── css/                    # Hojas de estilo TailwindCSS primarias
│   ├── js/                     # Scripts de cliente y configuración de Alpine.js / Axios
│   └── views/                  # Plantillas Blade estructuradas por módulos:
│       ├── inventario/         # Vistas de gestión de stock, productos y categorías
│       ├── ventas/             # Interfaz de Punto de Venta (POS) y emisión de recibos PDF
│       ├── deudas/             # Módulo de seguimiento de cuentas por cobrar y abonos
│       ├── pedidos/            # Administración de órdenes de compra online
│       ├── web/                # Storefront B2C, catálogo de productos y servicios
│       └── emails/             # Plantillas de correo electrónico transaccionales
├── routes/
│   ├── web.php                 # Definición de rutas HTTP principales, middleware y endpoints de la API interna
│   └── auth.php                # Rutas de autenticación y gestión de sesiones
├── storage/                    # Logs del sistema, descargas de PDF temporales y archivos multimedia subidos
├── tests/                      # Suite de pruebas automatizadas (PHPUnit)
├── composer.json               # Configuración de dependencias PHP y scripts del proyecto
├── package.json                # Configuración de dependencias JavaScript y scripts de compilación Vite
├── tailwind.config.js          # Configuración del sistema de diseño TailwindCSS
└── vite.config.js              # Configuración de compilación e integración Vite-Laravel
```

---

## Derechos y Autoría

Desarrollado como Proyecto Capstone por **Alchemy Software** © 2024. Todos los derechos reservados.