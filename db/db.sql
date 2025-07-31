DROP DATABASE IF EXISTS coffee;

CREATE DATABASE coffee CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE coffee;

CREATE TABLE imagenes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    contenido BLOB NOT NULL
);

CREATE TABLE historia_linaje (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    obtenor VARCHAR(255) NOT NULL,
    familia VARCHAR(255) NOT NULL,
    grupo VARCHAR(255) NOT NULL
);

CREATE TABLE ubicacion (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    departamento VARCHAR(255) NOT NULL,
    clima VARCHAR(255) NOT NULL,
    suelo VARCHAR(255) NOT NULL,
    altitud VARCHAR(255) NOT NULL,
    temperatura VARCHAR(255) NOT NULL,
    practica_cultivo VARCHAR(255) NOT NULL
);

CREATE TABLE tamanho_grano (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tamanho VARCHAR(255) NOT NULL
);

CREATE TABLE porte (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    porte VARCHAR(255) NOT NULL,
    manejo_cultivo VARCHAR(255) NOT NULL
);

CREATE TABLE condiciones (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    genetica VARCHAR(255) NOT NULL,
    clima VARCHAR(255) NOT NULL,
    suelo VARCHAR(255) NOT NULL,
    practicas_cultivo VARCHAR(255) NOT NULL,
    temperatura VARCHAR(255) NOT NULL
);

CREATE TABLE enfermedades (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    efectos VARCHAR(255) NOT NULL,
    gravedad VARCHAR(255) NOT NULL,
    tratamiento VARCHAR(255) NOT NULL
);

CREATE TABLE densidad (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    porte BIGINT UNSIGNED NOT NULL,
    tamanho_grano BIGINT UNSIGNED NOT NULL,
    valor_densidad INT NOT NULL,
    FOREIGN KEY (porte) REFERENCES porte (id),
    FOREIGN KEY (tamanho_grano) REFERENCES tamanho_grano (id)
);

CREATE TABLE potencial_de_rendimiento (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    potencial VARCHAR(255) NOT NULL,
    condicion BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (condicion) REFERENCES condiciones (id)
);

CREATE TABLE calidad_grano (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    calidad VARCHAR(255) NOT NULL,
    aroma VARCHAR(255) NOT NULL,
    sabor VARCHAR(255) NOT NULL,
    densidad BIGINT UNSIGNED NOT NULL,
    humedad VARCHAR(255) NOT NULL,
    tueste VARCHAR(255) NOT NULL,
    origen BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (densidad) REFERENCES densidad (id),
    FOREIGN KEY (origen) REFERENCES ubicacion (id)
);

CREATE TABLE calidad_altitud (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ubicacion BIGINT UNSIGNED NOT NULL,
    calidad VARCHAR(255) NOT NULL,
    FOREIGN KEY (ubicacion) REFERENCES ubicacion (id)
);

CREATE TABLE resistencias (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255) NOT NULL,
    calidad_grano BIGINT UNSIGNED NOT NULL,
    enfermedad BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (calidad_grano) REFERENCES calidad_grano (id),
    FOREIGN KEY (enfermedad) REFERENCES enfermedades (id)
);

CREATE TABLE datos_agronomicos (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tiempo_cosecha VARCHAR(255) NOT NULL,
    maduracion VARCHAR(255) NOT NULL,
    nutricion VARCHAR(255) NOT NULL,
    densidad_de_siembra BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (densidad_de_siembra) REFERENCES densidad (id)
);

CREATE TABLE variedad (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_comun VARCHAR(255) NOT NULL,
    nombre_cientifico VARCHAR(255) NOT NULL,
    imagen BIGINT UNSIGNED NOT NULL,
    descripcion_general TEXT NOT NULL,
    porte BIGINT UNSIGNED NOT NULL,
    tamanho_del_grano BIGINT UNSIGNED NOT NULL,
    altitud_optima_siembra DECIMAL(8, 2) NOT NULL,
    potencial_de_rendimiento BIGINT UNSIGNED NOT NULL,
    calidad_grano_altitud BIGINT UNSIGNED NOT NULL,
    resistencia BIGINT UNSIGNED NOT NULL,
    datos_agronomicos BIGINT UNSIGNED NOT NULL,
    historia BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (imagen) REFERENCES imagenes (id),
    FOREIGN KEY (porte) REFERENCES porte (id),
    FOREIGN KEY (tamanho_del_grano) REFERENCES tamanho_grano (id),
    FOREIGN KEY (potencial_de_rendimiento) REFERENCES potencial_de_rendimiento (id),
    FOREIGN KEY (calidad_grano_altitud) REFERENCES calidad_altitud (id),
    FOREIGN KEY (resistencia) REFERENCES resistencias (id),
    FOREIGN KEY (datos_agronomicos) REFERENCES datos_agronomicos (id),
    FOREIGN KEY (historia) REFERENCES historia_linaje (id)
);

SELECT 'Base de datos con forma de pulpo' as mensaje;

-- FALTA IMPLEMENTAR LAS IMAGENES
INSERT INTO
    imagenes (nombre, contenido)
VALUES ('tipica.jpg', 'example'),
    ('borbon.jpg', 'example'),
    ('caturra.jpg', 'example'),
    (
        'variedad_colombia.jpg',
        'example'
    ),
    ('maragogipe.jpg', 'example'),
    ('tabi.jpg', 'example');

INSERT INTO
    historia_linaje (obtenor, familia, grupo)
VALUES (
        'Misioneros Jesuitas',
        'Arábica',
        'Variedad Antigua'
    ),
    (
        'Federación Nacional de Cafeteros',
        'Arábica',
        'Variedad Mejorada'
    ),
    (
        'Investigación Cenicafé',
        'Arábica',
        'Híbrido Resistente'
    ),
    (
        'Productores Tradicionales',
        'Arábica',
        'Variedad Antigua'
    ),
    (
        'Investigación Cenicafé',
        'Arábica',
        'Híbrido Mejorado'
    ),
    (
        'Investigación Internacional',
        'Arábica',
        'Híbrido Experimental'
    );

INSERT INTO
    ubicacion (
        departamento,
        clima,
        suelo,
        altitud,
        temperatura,
        practica_cultivo
    )
VALUES (
        'Antioquia',
        'Templado húmedo',
        'Volcánico fértil',
        '1.300 - 1.800 msnm',
        '18 - 22 °C',
        'Sombra parcial y fertilización orgánica'
    ),
    (
        'Caldas',
        'Templado húmedo',
        'Franco-arenoso',
        '1.200 - 1.900 msnm',
        '17 - 21 °C',
        'Siembra en curvas de nivel'
    ),
    (
        'Huila',
        'Templado seco',
        'Franco-arcilloso',
        '1.200 - 2.000 msnm',
        '17 - 23 °C',
        'Riego controlado y podas técnicas'
    ),
    (
        'Tolima',
        'Templado húmedo',
        'Volcánico profundo',
        '1.300 - 1.900 msnm',
        '18 - 22 °C',
        'Manejo de sombra y control fitosanitario'
    ),
    (
        'Nariño',
        'Frío moderado',
        'Volcánico con alto contenido de materia orgánica',
        '1.800 - 2.300 msnm',
        '16 - 20 °C',
        'Siembra asociada con leguminosas'
    ),
    (
        'Quindío',
        'Templado húmedo',
        'Franco-limoso',
        '1.200 - 1.800 msnm',
        '18 - 22 °C',
        'Renovación periódica de cafetales'
    );

INSERT INTO
    tamanho_grano (tamanho)
VALUES ('Pequeño'),
    ('Mediano'),
    ('Grande'),
    ('Supremo'),
    ('Excelso');

INSERT INTO
    porte (porte, manejo_cultivo)
VALUES (
        'Alto',
        'Requiere mayor espaciamiento y podas periódicas para controlar la altura'
    ),
    (
        'Intermedio',
        'Manejo balanceado de podas y fertilización, densidad de siembra media'
    ),
    (
        'Bajo',
        'Permite mayor densidad de siembra, fácil recolección y menor necesidad de poda'
    );

INSERT INTO
    condiciones (
        genetica,
        clima,
        suelo,
        practicas_cultivo,
        temperatura
    )
VALUES (
        'Arábica tradicional',
        'Templado húmedo',
        'Andisoles volcánicos',
        'Sombra parcial, fertilización orgánica',
        '18-22 °C'
    ),
    (
        'Arábica mejorada',
        'Templado seco',
        'Franco-arcilloso',
        'Podas de renovación y control fitosanitario',
        '17-23 °C'
    ),
    (
        'Híbrido resistente',
        'Templado húmedo',
        'Volcánico profundo',
        'Manejo integrado de plagas y densidad media',
        '17-22 °C'
    ),
    (
        'Arábica de altura',
        'Frío moderado',
        'Andisoles ricos en materia orgánica',
        'Siembra asociada con árboles de sombra',
        '16-20 °C'
    ),
    (
        'Híbrido experimental',
        'Templado húmedo',
        'Franco-limoso',
        'Alta densidad y fertilización balanceada',
        '18-22 °C'
    );

INSERT INTO
    enfermedades (
        nombre,
        efectos,
        gravedad,
        tratamiento
    )
VALUES (
        'Roya del café (Hemileia vastatrix)',
        'Defoliación prematura, disminución de fotosíntesis y reducción de la producción',
        'Alta',
        'Uso de variedades resistentes, fungicidas preventivos y manejo de sombra'
    ),
    (
        'Antracnosis (Colletotrichum spp.)',
        'Manchas en hojas y frutos, caída prematura de cerezas',
        'Media',
        'Poda sanitaria, control de humedad y fungicidas selectivos'
    ),
    (
        'Nematodos (Meloidogyne spp.)',
        'Daños en raíces, debilitamiento general de la planta, menor absorción de nutrientes',
        'Alta',
        'Uso de portainjertos resistentes, rotación de cultivos y nematicidas biológicos'
    ),
    (
        'Broca del café (Hypothenemus hampei)',
        'Perforación de granos, pérdida de calidad y peso',
        'Alta',
        'Recolección oportuna, control biológico con Beauveria bassiana y trampas'
    ),
    (
        'Ojo de gallo (Mycena citricolor)',
        'Manchas circulares en hojas y caída prematura',
        'Media',
        'Manejo de sombra y aplicación de fungicidas específicos'
    );

-- CUANTAS PLANTAS SE PUEDEN SEMBRRAR POR HECTAREA
-- SE DA UN EJEMPLO DE NOMBRES PARA TENER UNA IDEA
INSERT INTO
    densidad (
        porte,
        tamanho_grano,
        valor_densidad
    )
VALUES (1, 3, 4000), -- Porte alto, grano grande: menor densidad de siembra
    (1, 5, 3800), -- Porte alto, grano excelso
    (2, 2, 5000), -- Porte intermedio, grano mediano: densidad media
    (2, 5, 4800), -- Porte intermedio, grano excelso
    (3, 1, 6000), -- Porte bajo, grano pequeño: alta densidad
    (3, 4, 5800);
-- Porte bajo, grano supremo

-- NIVEL DE PRODUCTIVIDAD QUE PUEDE ALCANZAR UNA VARIEDAD DE CAFE, CONSIDERANDO LAS CONDICIONES
INSERT INTO
    potencial_de_rendimiento (potencial, condicion)
VALUES ('Bajo', 1), -- Arábica tradicional
    ('Medio', 2), -- Arábica mejorada
    ('Alto', 3), -- Híbrido resistente
    ('Medio-Alto', 4), -- Arábica de altura
    ('Excepcional', 5);
-- Híbrido experimental

INSERT INTO
    calidad_grano (
        calidad,
        aroma,
        sabor,
        densidad,
        humedad,
        tueste,
        origen
    )
VALUES (
        'Alta',
        'Floral y dulce',
        'Balanceado con acidez media',
        2,
        '11%',
        'Medio',
        1
    ), -- Antioquia
    (
        'Alta',
        'Chocolate y nuez',
        'Cuerpo medio y dulce',
        4,
        '11%',
        'Medio',
        2
    ), -- Caldas
    (
        'Especial',
        'Frutal y floral',
        'Acidez brillante, final prolongado',
        5,
        '10.5%',
        'Medio-Claro',
        3
    ), -- Huila
    (
        'Media',
        'Cítrico suave',
        'Ligero y balanceado',
        3,
        '11%',
        'Medio',
        4
    ), -- Tolima
    (
        'Especial',
        'Floral intenso',
        'Acidez alta y brillante',
        6,
        '10%',
        'Claro',
        5
    ), -- Nariño
    (
        'Alta',
        'Caramelo y panela',
        'Cuerpo cremoso y dulce',
        1,
        '11%',
        'Medio-Oscuro',
        6
    );
-- Quindío

-- MIENTRAS MÁS ALTA LA ALTITUD, GENERALMENTE MEJOR ES LA CALIDAD EN TAZA.
INSERT INTO
    calidad_altitud (ubicacion, calidad)
VALUES (
        1,
        'Alta, altitudes entre 1.400-1.800 msnm producen cafés balanceados'
    ), -- Antioquia
    (
        2,
        'Alta, altitudes entre 1.300-1.700 msnm aportan cuerpo y dulzor'
    ), -- Caldas
    (
        3,
        'Especial, altitudes entre 1.500-2.000 msnm dan acidez brillante'
    ), -- Huila
    (
        4,
        'Alta, altitudes entre 1.400-1.900 msnm generan notas cítricas'
    ), -- Tolima
    (
        5,
        'Especial, altitudes superiores a 1.800 msnm dan cafés complejos'
    ), -- Nariño
    (
        6,
        'Alta, altitudes entre 1.300-1.800 msnm con buen balance aromático'
    );
-- Quindío

-- RESISTENCIA DE UNA VARIEDAD A UNA ENFERMEDAD ESPECÍFICA
-- 30 registros en total (6 calidades_grano × 5 enfermedades)
INSERT INTO
    resistencias (
        tipo,
        calidad_grano,
        enfermedad
    )
VALUES ('Susceptible', 1, 1), -- Antioquia // -- Enfermedad 1: Roya del café
    ('Tolerante', 2, 1), -- Caldas
    ('Resistente', 3, 1), -- Huila
    ('Tolerante', 4, 1), -- Tolima
    ('Resistente', 5, 1), -- Nariño
    ('Resistente', 6, 1), -- Quindío
    ('Tolerante', 1, 2), -- Antioquia // -- Enfermedad 2: Antracnosis
    ('Resistente', 2, 2), -- Caldas
    ('Susceptible', 3, 2), -- Huila
    ('Tolerante', 4, 2), -- Tolima
    ('Resistente', 5, 2), -- Nariño
    ('Tolerante', 6, 2), -- Quindío
    ('Susceptible', 1, 3), -- Antioquia  // -- Enfermedad 3: Nematodos
    ('Tolerante', 2, 3), -- Caldas
    ('Resistente', 3, 3), -- Huila
    ('Susceptible', 4, 3), -- Tolima
    ('Tolerante', 5, 3), -- Nariño
    ('Resistente', 6, 3), -- Quindío
    ('Tolerante', 1, 4), -- Antioquia // -- Enfermedad 4: Broca
    ('Resistente', 2, 4), -- Caldas
    ('Tolerante', 3, 4), -- Huila
    ('Resistente', 4, 4), -- Tolima
    ('Susceptible', 5, 4), -- Nariño
    ('Tolerante', 6, 4), -- Quindío
    ('Susceptible', 1, 5), -- Antioquia // -- Enfermedad 5: Ojo de gallo
    ('Tolerante', 2, 5), -- Caldas
    ('Resistente', 3, 5), -- Huila
    ('Tolerante', 4, 5), -- Tolima
    ('Resistente', 5, 5), -- Nariño
    ('Susceptible', 6, 5);
-- Quindío

-- CONTIENE INFORMACIÓN GENERAL SOBRE EL MANEJO AGRONÓMICO DE CADA VARIEDAD O GRUPO DE CAFÉ
INSERT INTO
    datos_agronomicos (
        tiempo_cosecha,
        maduracion,
        nutricion,
        densidad_de_siembra
    )
VALUES (
        '2 cosechas principales al año',
        'Lenta',
        'Fertilización orgánica y abonos verdes',
        1
    ), -- Porte alto
    (
        '2 cosechas y mitaca',
        'Media',
        'Fertilización química balanceada',
        2
    ), -- Porte alto, excelso
    (
        'Cosecha continua con picos',
        'Media',
        'Manejo integrado de nutrientes',
        3
    ), -- Porte intermedio
    (
        'Cosecha principal y recolectas adicionales',
        'Rápida',
        'Fertilización orgánica',
        4
    ), -- Porte intermedio, excelso
    (
        '2 cosechas al año con picos definidos',
        'Lenta',
        'Fertilización intensiva',
        5
    ), -- Porte bajo
    (
        'Cosecha escalonada',
        'Media',
        'Abonos orgánicos y minerales',
        6
    );
-- Porte bajo, supremo

-- IMPORTANTE !!!!!!!!
-- VARIEDAD DE CAFÉ CON TODA SU INFORMACIÓN
--
INSERT INTO
    variedad (
        nombre_comun,
        nombre_cientifico,
        imagen,
        descripcion_general,
        porte,
        tamanho_del_grano,
        altitud_optima_siembra,
        potencial_de_rendimiento,
        calidad_grano_altitud,
        resistencia,
        datos_agronomicos,
        historia
    )
VALUES (
        'Típica',
        'Coffea arabica var. typica',
        1,
        'Una de las primeras variedades cultivadas en Colombia, apreciada por su taza suave y aromática.',
        1,
        5,
        1700.00,
        1,
        1,
        1,
        1,
        1
    ),
    (
        'Borbón',
        'Coffea arabica var. bourbon',
        2,
        'Variedad antigua conocida por su dulzor y balance, requiere buen manejo por su susceptibilidad a enfermedades.',
        1,
        4,
        1600.00,
        2,
        2,
        2,
        2,
        2
    ),
    (
        'Caturra',
        'Coffea arabica var. caturra',
        3,
        'Mutación natural de Borbón, porte bajo e ideal para mayor densidad de siembra.',
        3,
        2,
        1500.00,
        3,
        3,
        3,
        3,
        3
    ),
    (
        'Variedad Colombia',
        'Coffea arabica var. colombia',
        4,
        'Desarrollada por Cenicafé, combina alta productividad con resistencia a la roya.',
        2,
        5,
        1700.00,
        3,
        4,
        4,
        4,
        4
    ),
    (
        'Maragogipe',
        'Coffea arabica var. maragogipe',
        5,
        'Conocida como el grano gigante, tiene porte alto y baja densidad de siembra.',
        1,
        3,
        1400.00,
        1,
        5,
        5,
        5,
        5
    ),
    (
        'Tabi',
        'Coffea arabica var. tabi',
        6,
        'Híbrido de Borbón, Típica y Híbrido de Timor; combina calidad de taza con resistencia.',
        2,
        4,
        1700.00,
        5,
        6,
        6,
        6,
        6
    );

-- TABLA USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user') DEFAULT 'user',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- password: 123456
INSERT INTO
    usuarios (nombre, email, password, rol)
VALUES (
        'Admin',
        'admin@coffee.com',
        '$2y$10$J82v8QU4gMn7oOykYhjceOBV9UZ6q1d6MTN0aM5XvXkjxNq1EYB7a',
        'admin'
    ),
    (
        'Usuario',
        'user@coffee.com',
        '$2y$10$J82v8QU4gMn7oOykYhjceOBV9UZ6q1d6MTN0aM5XvXkjxNq1EYB7a',
        'user'
    );

-- insert de testeo para admin
-- echo password_hash('admin123', PASSWORD_BCRYPT);
-- comando para generar la contraseña hasheada
INSERT INTO
    usuarios (nombre, email, password, rol)
VALUES (
        'Admin de prueba',
        'admin@example.com',
        '$2y$10$yHmXbbKPLGhSyXZyAhDbNO6VYYeUeCOtQK7nMY7EqZkxUWr6VvKv2', -- contraseña: admin123
        'admin'
    );