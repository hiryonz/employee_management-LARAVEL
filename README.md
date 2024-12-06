# Administracion de empleados utilizando laravel

## Descripción

Esta aplicación permite la gestión integral de empleados y sus actividades, ofreciendo las siguientes funcionalidades:

- **Administración de empleados:** Registra, actualiza y elimina información de empleados.
- **Control de asistencias:** Lleva un registro de las entradas y salidas de cada empleado.
- **Cálculo de salarios y descuentos:** Calcula automáticamente los salarios, aplicando descuentos en función de las ausencias.
- **Visualización de datos:** Genera gráficos que representan los datos de asistencias, salarios y otros indicadores clave.
- **Gestión de tareas:** Crea tareas y asígnalas a los empleados para un seguimiento eficiente.


![home](https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/home.png)
<br>

---

<br>

## Tabla de Contenido

1. [Descripción](#descripción)
2. [Tecnologías utilizadas](#tecnologías-utilizadas)
3. [Instalación](#instalación)
4. [Uso](#uso)
5. [Imagenes del Sistema](#imagenes-del-sistema)
6. [Contribuciones](#contribuciones)
7. [Licencia](#licencia)
8. [Contacto](#contacto)


## Características

### Gestión de empleados y tareas
- **Agregar, eliminar y actualizar empleados.**
- **Gestión de tareas:** Asigna tareas específicas a cada empleado.
- **Permisos diferenciados:**
  - Los empleados solo pueden ver su propia información y no tienen acceso para agregar o eliminar datos.
  - Los administradores pueden gestionar todos los datos, incluyendo empleados y tareas.

### Autenticación y seguridad
- **Sistema de login**: Autenticación segura para empleados y administradores.
- **Cambio de contraseña**: Permite a los usuarios actualizar su contraseña.
- **Foto de perfil:** Personalización con imágenes de perfil.

### Visualización de datos
- **Gráficas dinámicas:**
  - Muestra las entradas y salidas de empleados.
  - Visualiza tareas pendientes de cada empleado.
- **Calendario interactivo:** Implementado con FullCalendar para visualizar tareas y eventos.

### Funcionalidad con Python
- **Escaneo de códigos QR:** Permite registrar las entradas y salidas de los empleados.
- **Cálculo automático de descuentos:** Mediante triggers en la base de datos, se calculan descuentos por ausencias automáticamente.

### Tecnologías utilizadas
- **Backend:** Laravel, Python
- **Frontend:** Bootstrap, Font Awesome, Chart.js, FullCalendar
- **Base de datos:** MySQL
- **Servidor local:** XAMPP (Apache, MySQL)
- **IDE:** Visual Studio Code

<br>

---

<br>

## Tecnologías utilizadas

### Backend
- **Laravel**: Framework PHP para la creación del backend de la aplicación.  
  - Versión utilizada: Laravel Installer 5.9.0
- **PHP**: Lenguaje utilizado para el desarrollo del backend.  
  - Versión utilizada: PHP 8.2.12
- **Python**: Usado para el escaneo de códigos QR y la inserción de entradas y salidas en la base de datos.

### Frontend
- **Bootstrap**: Para el diseño responsivo y los estilos de la aplicación.  
  - Versión utilizada: Bootstrap 5.x
- **Font Awesome**: Conjunto de iconos para mejorar la interfaz de usuario.  
  - Versión utilizada: Font Awesome 6.x
- **Chart.js**: Librería para generar gráficos dinámicos.  
  - Versión utilizada: Chart.js 4.x
- **FullCalendar**: Calendario interactivo para la gestión de tareas.  
  - Versión utilizada: FullCalendar 6.x

### Base de datos
- **MySQL**: Sistema de gestión de bases de datos para almacenar empleados, tareas, entradas y salidas.  
  - Versión utilizada: MySQL 8.0.x

### Servidor local
- **XAMPP**: Entorno local que incluye Apache y MySQL.  
  - Versión utilizada: XAMPP 8.2.x

### Otros
- **Apache**: Servidor web usado para ejecutar la aplicación.  
  - Versión utilizada: Apache 2.4.x
- **Imagick**: Extensión utilizada para el manejo de imágenes.  
  - Versión utilizada: Imagick 1809
- **Visual Studio Code**: Entorno de desarrollo integrado (IDE) usado para desarrollar la aplicación.  
  - Versión utilizada: Visual Studio Code 1.8x


---

<br>

## Instalación
**Imagick** es una extensión de PHP que permite trabajar con imágenes utilizando la biblioteca de gráficos ImageMagick. Para instalar y configurar esta extensión, sigue los pasos a continuación.

---

### 1. Requisitos previos
Antes de instalar Imagick, asegúrate de tener:
- Un servidor con PHP instalado.
- Acceso al terminal o línea de comandos.

### 2. Guías oficiales

Consulta las instrucciones completas en las fuentes oficiales:

- **Documentación de Imagick en PECL**: [https://pecl.php.net/package/imagick](https://pecl.php.net/package/imagick)
- **Página oficial de ImageMagick**: [https://imagemagick.org](https://imagemagick.org)
- **Guía para instalar PHP Imagick en Windows**: [https://mlocati.github.io/articles/php-windows-imagick.html](https://mlocati.github.io/articles/php-windows-imagick.html)

---

Sigue estos pasos para instalar y configurar la aplicación:

1. Clona este repositorio:
   ```bash
   https://github.com/hiryonz/employee_management-LARAVEL.git

2. Navega al directorio del proyecto:
   ```bash
   cd tu_proyecto
3. Navega al directorio del laravel (php):
   ```bash
   cd php

4. Instala las dependencias de PHP con Composer:
   ```bash
   composer install


5. Copia el archivo .env.example como .env:
   ```bash
   cp .env.example .env

6. Configura tus variables de entorno en el archivo .env:
- Define el nombre de la base de datos, usuario, contraseña, etc.

7. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate

8. Configura la base de datos:
- Asegúrate de que MySQL esté ejecutándose.
- Crea una base de datos nueva para la aplicación.
- Ejecuta las migraciones para crear las tablas necesarias:
  ```bash
  php artisan migrate

9. ejecute el sigueinte codigo sql en mysql
    
   - trigger de entrada
    ```bash 
    DELIMITER $$
    CREATE TRIGGER `trigger_entrada_salida` AFTER INSERT ON `entrada_salida` FOR EACH ROW BEGIN
        DECLARE hora_entrada_esperada TIME;
        DECLARE hora_entrada TIME;
        DECLARE horas_faltas DECIMAL(5, 2) DEFAULT 12;
        DECLARE salario_h DECIMAL(10, 2) DEFAULT 12;
        DECLARE descuento DECIMAL(10, 2) DEFAULT 12;
    
        -- Obtener la hora de entrada esperada del turno del empleado
        SELECT t.entrada INTO hora_entrada_esperada
        FROM turno t
        WHERE t.id = (SELECT e.id_turno FROM employee e WHERE e.cedula = NEW.cedula)
        LIMIT 1;
    
        -- Asignar la hora de entrada del nuevo registro
        SET hora_entrada = NEW.hora_entrada;
        
        -- Calcular las horas de faltas si la entrada es tardía
        IF hora_entrada > hora_entrada_esperada THEN
            SELECT 
                HOUR(TIMEDIFF(hora_entrada, hora_entrada_esperada)) + 
                MINUTE(TIMEDIFF(hora_entrada, hora_entrada_esperada)) / 60.0 
            INTO horas_faltas;
        ELSE
            SET horas_faltas = 0;
        END IF;
        
        -- Obtener el salario por hora del empleado
        SELECT salario_h INTO salario_h 
        FROM planillas 
        WHERE cedula = NEW.cedula
        LIMIT 1;
    
        -- Calcular el descuento en base a las horas faltas
        SET descuento = horas_faltas * salario_h;
    
        -- Insertar los datos en la tabla descuentosfaltas
        INSERT INTO descuentosfaltas (cedula, fecha, horas_faltas, descuentos_faltas, created_at, updated_at)
        VALUES (NEW.cedula, NEW.fecha, horas_faltas, descuento, NOW(), NOW());
    END
    $$
    DELIMITER ;
    ```
    - trigger de salida
    ```bash
    DELIMITER $$
    CREATE TRIGGER `update_entrada_salida` AFTER UPDATE ON `entrada_salida` FOR EACH ROW BEGIN
        DECLARE hora_salida_esperada TIME;
        DECLARE extra DECIMAL(5, 2) DEFAULT 0;
        DECLARE hora_salida TIME;
        DECLARE horas_faltas DECIMAL(5, 2) DEFAULT 0;
        DECLARE salario_h DECIMAL(10, 2) DEFAULT 0;
        DECLARE descuento DECIMAL(10, 2) DEFAULT 0;
        DECLARE horas_faltas_existentes DECIMAL(5, 2) DEFAULT 0;
        DECLARE descuento_existente DECIMAL(10, 2) DEFAULT 0;

        -- Obtener la hora de salida esperada del turno del empleado
        SELECT t.salida INTO hora_salida_esperada
        FROM turno t
        WHERE t.id = (SELECT e.id_turno FROM employee e WHERE e.cedula = NEW.cedula)
        LIMIT 1;
    
        -- Asignar la hora de salida del nuevo registro
        SET hora_salida = NEW.hora_salida;
        
        -- Calcular las horas faltas si la salida es tardía
        IF hora_salida < hora_salida_esperada THEN
            SELECT 
                HOUR(TIMEDIFF(hora_salida, hora_salida_esperada)) + 
                MINUTE(TIMEDIFF(hora_salida, hora_salida_esperada)) / 60.0 
            INTO horas_faltas;
        ELSE
            SET horas_faltas = 0;
        END IF;
        
        -- Calcular el tiempo extra si la salida es más tarde de lo esperado
        IF hora_salida > hora_salida_esperada THEN
            SELECT 
                HOUR(TIMEDIFF(hora_salida, hora_salida_esperada)) + 
                MINUTE(TIMEDIFF(hora_salida, hora_salida_esperada)) / 60.0 
            INTO extra;
        ELSE
            SET extra = 0;
        END IF;
    
        -- Obtener el salario por hora del empleado
        SELECT salario_h INTO salario_h 
        FROM planillas 
        WHERE cedula = NEW.cedula
        LIMIT 1;
    
        -- Calcular el descuento en base a las horas faltas
        SET descuento = horas_faltas * salario_h;
    
        -- Obtener las horas faltas y los descuentos actuales de la tabla descuentosfaltas
        SELECT horas_faltas, descuentos_faltas 
        INTO horas_faltas_existentes, descuento_existente
        FROM descuentosfaltas
        WHERE cedula = NEW.cedula AND fecha = NEW.fecha
        LIMIT 1;
    
        -- Si existen horas faltas y descuentos previos, sumarlos con los nuevos valores
        SET horas_faltas = horas_faltas_existentes + horas_faltas;
        SET descuento = descuento_existente + descuento;
    
        -- Actualizar los valores en la tabla descuentosfaltas
        UPDATE descuentosfaltas
        SET horas_faltas = horas_faltas, descuentos_faltas = descuento, updated_at = NOW()
        WHERE cedula = NEW.cedula AND fecha = NEW.fecha;
    END
    $$
    DELIMITER ;
    ```

    
9. Inicia el servidor local
    ```bash
    php artisan serve


---

## de

<br>

## Uso

1. **Inicia sesión**  
   - Accede a la página principal de inicio de sesión ingresando tus credenciales.
>  [!IMPORTANT]
> - USER = admin
> - PASSWORD = admin   
   - Si eres un administrador, tendrás acceso completo para gestionar empleados, tareas, y visualizar estadísticas.

2. **Gestión de empleados**  
   - Los administradores pueden agregar, editar o eliminar empleados desde el panel de control.  
   - Los empleados pueden actualizar su perfil y ver solo sus datos.

3. **Gestión de tareas**  
   - Crea nuevas tareas desde el panel de administrador.  
   - Asigna tareas a empleados específicos y establece fechas límite.  
   - Los empleados pueden ver sus tareas asignadas en el calendario interactivo.

4. **Registro de entradas y salidas**
   1. abre el archivo python
   2. ejecuta el archivo scanQR.py
   3. escanea el codigo qr gereado en el perfil del empleado
   > [!NOTE]
   > si desea cerrar el escaner presion la tecla s
   - Escanea el código QR desde la aplicación en Python para registrar entradas y salidas.  
   - Estos datos se reflejarán automáticamente en la base de datos y las estadísticas.

6. **Visualización de datos**  
   - Consulta gráficos interactivos para analizar:
     - Entradas y salidas de empleados.
     - Tareas pendientes.
     - Asistencias y ausencias.
   - Usa el calendario para ver las tareas y eventos de cada empleado.

7. **Cambio de contraseña y configuración**  
   - Los usuarios pueden actualizar sus contraseñas desde la configuración de su perfil.  
   - Los administradores pueden gestionar permisos y configuraciones globales de la aplicación.

> [!WARNING]
> una vez instalado y configrado, crea un usuario nuevo con permisos admin y elimine el empleado por predeterminado

---

https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/home.png
## Imagenes del Sistema
![agregar empleado](https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/agregar.png)

![perfil](https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/perfil.png)

![tarea](https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/tarea.png)

![calendario](https://github.com/hiryonz/employee_management-LARAVEL/blob/13ef3d35ac4976ada08e7b7fdfe99bb130461d13/img_readme/calendario.png)

---

## Contribuciones
¡Las contribuciones son bienvenidas! Sigue estos pasos para contribuir:

1. Haz fork del proyecto.
2. Crea una rama para tu funcionalidad
   ``` bash
   git checkout -b feature/nueva-funcionalidad
3. Haz el commit
   ``` bash
   git commit -m "Agrega una nueva funcionalidad"
4. Haz push a la rama:
   ``` bash
   git push origin feature/nueva-funcionalidad
5. Crea un Pull Request.



## Licencia
este proyecto fue desarrollado por Javier Chong.


## Contacto

Si tienes preguntas, sugerencias o necesitas ayuda, no dudes en ponerte en contacto:

- **Nombre:** [Javier Chong]
- **Email:** [hiryonz024@gmail.com](mailto:hiryonz024@gmail.com)
- **GitHub:** [@hiryonz](https://github.com/hiryonz)
- **LinkedIn**: [linkedin.com/javier-chong](https://www.linkedin.com/in/javier-chong-98a73b277/)

¡Espero tus comentarios!




