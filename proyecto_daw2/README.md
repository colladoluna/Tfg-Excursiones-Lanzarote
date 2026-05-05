# Tfg-Excursiones-Lanzarote

Aplicación web para la venta de excursiones en Lanzarote. Permite a los usuarios hacer reservas y a los administradores gestionar el sistema.

## Tecnologías usadas

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- AJAX
- JSON
- XAMPP

## Funcionalidades

**Usuario**
- Registro e inicio de sesión
- Ver excursiones disponibles
- Hacer, pagar y eliminar reservas
- Ver historial de compras

**Administrador**
- Inicio de sesión por panel separado
- Gestionar excursiones (añadir, editar, eliminar)
- Ver reservas y ventas
- Gestionar usuarios

## Instalación

1. Instala XAMPP desde https://www.apachefriends.org

2. Copia la carpeta del proyecto dentro de:
C:\xampp\htdocs\


3. Abre XAMPP y arranca **Apache** y **MySQL**

4. Abre el navegador y entra en **phpMyAdmin**:
http://localhost/phpmyadmin


5. Crea una base de datos nueva llamada `excursiones_lanzarote`

6. Importa el archivo `Basededatos.sql` que está dentro del proyecto:
   - Haz clic en la base de datos que acabas de crear
   - Ve a la pestaña **Importar**
   - Selecciona el archivo `Basededatos.sql`
   - Dale a **Continuar**

7. Abre la aplicación en el navegador.

8. Usuarios de la base de datos:

   admin@excursiones.com password admin123
   
   usuario@excursiones.com password usuario123


