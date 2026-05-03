-- En phpMyAdmin/importar

-- Crear la base de datos 

CREATE DATABASE IF NOT EXISTS excursiones_db;
USE excursiones_db;

-- Tabla de usuarios (clientes)

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de excursiones

CREATE TABLE IF NOT EXISTS excursiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    fecha DATE NOT NULL,
    duracion_horas INT NOT NULL,
    precio DECIMAL(8,2) NOT NULL
   
);

-- Tabla de reservas (relación entre usuarios y excursiones)

CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    excursion_id INT NOT NULL,
    cantidad INT NOT NULL,
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'confirmada') DEFAULT 'pendiente',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (excursion_id) REFERENCES excursiones(id) ON DELETE CASCADE
);

-- Tabla de administradores

CREATE TABLE IF NOT EXISTS administrador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserción de datos 

-- Administrador (contraseña: admin123 en texto plano

INSERT INTO administrador (nombre, email, password)
VALUES ('Admin Principal', 'admin@excursiones.com', '$2y$10$tnwzuPzlIhQHSps.vzZGD.yuCkEZ6J4VhSmFqgzPu8xHl.I09tlny');

-- Usuario prueba (contraseña: usuario123 en texto plano

INSERT INTO usuarios (nombre, apellidos, email, password, telefono)
VALUES ('Usuario Principal', 'Usuario Principal', 'usuario@excursiones.com', '$2y$10$hHyxBFn073X/z7wVeQOwxuPyAbEUYaqixoJD6HIWsio5rzHe0vCyK','1111111111');

-- Excursiones

INSERT INTO excursiones (titulo, descripcion, fecha, duracion_horas, precio)
VALUES 
(
"La Graciosa",
"Elige que día quieres venir con nosotros a la isla La Graciosa. Excursión de día completo. Te recogemos en tu hotel en uno de nuestros cómodos autocares para llevarte a la población de Órzola. Donde cogeremos un ferry dirección a la Graciosa. Durante 25 minutos disfrutaras de las vistas panorámicas de la zona norte de Lanzarote. En primer lugar, veremos el Museo de Caleta de Sebo, el mar y la tierra se juntan para contarnos la historia de la isla. Después de nuestro almuerzo típico canario, es el momento de coger las bicicletas y dirigirnos a la Montaña Amarilla. Amarillos, ocres, marrones y rojizos contrastan con el azul turquesa y verdoso de las aguas cristalinas que la rodean y con los de la pequeña cala de arena dorada. En este alejado lugar podremos realizar snorkel. Regresaremos al muelle para dejar las bicicletas y coger el velero. Durante la travesía en el velero disfrutaremos de bebida frías y un picnic con productos canarios. Disfrutaremos del paisaje de la isla y de algunas playas rubias.",
"2025-06-02", 9, 89.00
);
INSERT INTO excursiones (titulo, descripcion, fecha, duracion_horas, precio)
VALUES 
(
"Timanfaya",
"¿Ya has elegido el día que te vienes de excursión al Parque Natural de Timanfaya con nosotros? Una magnifica excursión guiada por un paisaje lunar. Te recogeremos en tu hotel y nos pondremos en marcha hasta llegar al Centro de Visitantes e Interpretación de Mancha Blanca. En el Centro de Visitantes veremos las salas de Exposiciones Permanente, de simulación y de proyecciones, miradores y una pasarela elevada que permite realizar un recorrido sobre coladas de lavas. Después nos dirigimos a las Montañas del fuego y en su restaurante disfrutaremos de un almuerzo mientras disfrutamos de una vista privilegiada. Y antes de la ruta de los Volcanes disfrutaremos de una demostración geotérmica. Durante 1 hora realizaremos la ruta guiada de los Volcanes. Te dejaremos en tu hotel, esperando que hayas tenido una experiencia única.",
"2025-06-03", 6, 65.00
);
INSERT INTO excursiones (titulo, descripcion, fecha, duracion_horas, precio)
VALUES 
(
"Tour Cultural Cesar Manrique",
"¿Qué visitaremos en este tour cultural de Cesar Manrique? El Monumento al Campesino, el Valle de las Mil Palmeras, Mirador del Rio, Jameos del agua, Cueva de los Verdes y el Jardín de Cactus. En esta fascinante excursión a parte de recorrer la isla, disfrutar de sus vistas y de una comida canaria en los Jameos del Agua. Sentiremos el amor que el artista tenía por Lanzarote siempre plasmado en cada una de sus creaciones. El Monumento al Campesino situado en San Bartolomé, es la obra de Cesar Manrique con la que homenajea a los Campesinos de la isla. El Valle de las Mil Palmeras, palmeral del archipiélago canario en él se encuentra la casa museo de Cesar Manrique. El Mirador del Rio espectacular vista panorámica de Lanzarote, el archipiélago chinijo y La Graciosa. Jameos del agua situado en el interior de un tubo volcánico, expresión artista de Cesar Manrique mezclando naturaleza con arte. La cueva de los Verdes es una gruta con una longitud aproximada de 8 km, compuesta de túneles, recovecos, lagunas y bóvedas. Y el Jardín de Cactus última gran obra de Cesar Manrique, con más de 4500 de cactus.", "2025-06-05",
10, 150.00
);
INSERT INTO excursiones (titulo, descripcion, fecha, duracion_horas, precio)
VALUES 
(
"Museo Tanit", 
"20 años viajando en el tiempo con esta premisa comenzaremos nuestra excursión al Museo Etnográfico de Tanit. Con el entusiasmo de conservar el patrimonio histórico-cultural de la isla de Lanzarote se construyó el Museo Etnológico Tanit. Fundado por Remy Quintana Reyes y su esposo es un regalo que se le hace a isla cargado de historia, humanidad y elegancia. En este paseo por el Museo podremos descubrir una casona del siglo XVIII y su bodega. Tras visitar el museo degustaremos un menú típico canario en el pueblo de San Bartolomé.", "2025-06-07",
4, 50.00
);
