# Información Capstone

**Grupo nro 14**

**Integrantes:**
- **Maria Bahamondes** - Scrum Master
- **Agustín Rodriguez** - Desarrollador FullStack
- **Carlos Cortez** - Desarrollador Backend - Product Owner

---

# Proyecto HealthPet

Este proyecto es una aplicación web para la gestión del **Hospital Veterinario San Agustin de Melipilla**. Incluye funcionalidades para la administración de inventarios, ventas, pedidos, y más. Está desarrollado utilizando **Laravel** y **Blade** para el backend y frontend respectivamente.

## Estructura del Proyecto

La estructura principal del proyecto es la siguiente:

```
veterinaria/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
├── public/
│   ├── css/
│   ├── js/
├── resources/
│   ├── views/
│   │   ├── inventario/
│   │   ├── web/
│   │   ├── emails/
│   │   ├── ventas/
├── routes/
├── tests/
├── .env
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
└── README.md
```

## Instalación

1. **Clona el repositorio:**
    ```sh
    git clone https://github.com/CaCortez384/HealthPet-S.A.git
    cd veterinaria
    ```

2. **Instala las dependencias de PHP con Composer:**
    ```sh
    composer install
    ```

3. **Instala las dependencias de JavaScript con npm:**
    ```sh
    npm install
    ```

4. **Copia el archivo de entorno y configura las variables necesarias:**
    ```sh
    cp .env.example .env
    ```

5. **Genera la clave de la aplicación:**
    ```sh
    php artisan key:generate
    ```

6. **Ejecuta las migraciones para crear las tablas en la base de datos:**
    ```sh
    php artisan migrate
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta:
```sh
php artisan serve
```

Luego, abre tu navegador y visita [http://localhost:8000](http://localhost:8000).

## Funcionalidades

### Inventario
- Crear, editar y eliminar productos.
- Vista previa de imágenes de productos.

### Ventas
- Crear y editar ventas.
- Validación de RUT de clientes.
- Cálculo de totales y descuentos.

### Pedidos
- Gestión de pedidos de clientes.
- Estado de pedidos y pagos.

### Web
- Página principal con información sobre los servicios de la veterinaria.
- Sección de contacto y tienda de productos para mascotas.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT.

---

Desarrollado por **Alchemy Software**. © 2024 **Hospital Veterinario San Agustin**. Todos los derechos reservados.

![Logo de Alchemy Software](https://i.imgur.com/selOHQO.png)