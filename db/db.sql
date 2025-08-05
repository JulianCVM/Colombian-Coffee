DROP DATABASE IF EXISTS coffee;

CREATE DATABASE coffee CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE coffee;

CREATE TABLE imagenes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    contenido LONGBLOB NOT NULL
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
    descripcion_general TEXT NOT NULL,
    porte BIGINT UNSIGNED NOT NULL,
    tamanho_del_grano BIGINT UNSIGNED NOT NULL,
    altitud_optima_siembra DECIMAL(8, 2) NOT NULL,
    potencial_de_rendimiento BIGINT UNSIGNED NOT NULL,
    calidad_grano_altitud BIGINT UNSIGNED NOT NULL,
    resistencia BIGINT UNSIGNED NOT NULL,
    datos_agronomicos BIGINT UNSIGNED NOT NULL,
    historia BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (porte) REFERENCES porte (id),
    FOREIGN KEY (tamanho_del_grano) REFERENCES tamanho_grano (id),
    FOREIGN KEY (potencial_de_rendimiento) REFERENCES potencial_de_rendimiento (id),
    FOREIGN KEY (calidad_grano_altitud) REFERENCES calidad_altitud (id),
    FOREIGN KEY (resistencia) REFERENCES resistencias (id),
    FOREIGN KEY (datos_agronomicos) REFERENCES datos_agronomicos (id),
    FOREIGN KEY (historia) REFERENCES historia_linaje (id)
);

CREATE TABLE imagenes_variedad (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imagenes_id BIGINT UNSIGNED NOT NULL,
    variedad_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (imagenes_id) REFERENCES imagenes (id),
    FOREIGN KEY (variedad_id) REFERENCES variedad (id)
);

ALTER TABLE densidad
DROP FOREIGN KEY densidad_ibfk_1,
DROP FOREIGN KEY densidad_ibfk_2,
ADD CONSTRAINT fk_densidad_porte FOREIGN KEY (porte) REFERENCES porte (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_densidad_tamanho FOREIGN KEY (tamanho_grano) REFERENCES tamanho_grano (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE potencial_de_rendimiento
DROP FOREIGN KEY potencial_de_rendimiento_ibfk_1,
ADD CONSTRAINT fk_potencial_condicion FOREIGN KEY (condicion) REFERENCES condiciones (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE calidad_grano
DROP FOREIGN KEY calidad_grano_ibfk_1,
DROP FOREIGN KEY calidad_grano_ibfk_2,
ADD CONSTRAINT fk_calidad_densidad FOREIGN KEY (densidad) REFERENCES densidad (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_calidad_origen FOREIGN KEY (origen) REFERENCES ubicacion (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE calidad_altitud
DROP FOREIGN KEY calidad_altitud_ibfk_1,
ADD CONSTRAINT fk_calidad_altitud_ubicacion FOREIGN KEY (ubicacion) REFERENCES ubicacion (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE resistencias
DROP FOREIGN KEY resistencias_ibfk_1,
DROP FOREIGN KEY resistencias_ibfk_2,
ADD CONSTRAINT fk_resistencia_calidad FOREIGN KEY (calidad_grano) REFERENCES calidad_grano (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_resistencia_enfermedad FOREIGN KEY (enfermedad) REFERENCES enfermedades (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE datos_agronomicos
DROP FOREIGN KEY datos_agronomicos_ibfk_1,
ADD CONSTRAINT fk_datos_agro_densidad FOREIGN KEY (densidad_de_siembra) REFERENCES densidad (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE variedad
DROP FOREIGN KEY variedad_ibfk_1,
DROP FOREIGN KEY variedad_ibfk_2,
DROP FOREIGN KEY variedad_ibfk_3,
DROP FOREIGN KEY variedad_ibfk_4,
DROP FOREIGN KEY variedad_ibfk_5,
DROP FOREIGN KEY variedad_ibfk_6,
DROP FOREIGN KEY variedad_ibfk_7,
ADD CONSTRAINT fk_variedad_porte FOREIGN KEY (porte) REFERENCES porte (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_tamanho FOREIGN KEY (tamanho_del_grano) REFERENCES tamanho_grano (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_potencial FOREIGN KEY (potencial_de_rendimiento) REFERENCES potencial_de_rendimiento (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_calidad_altitud FOREIGN KEY (calidad_grano_altitud) REFERENCES calidad_altitud (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_resistencia FOREIGN KEY (resistencia) REFERENCES resistencias (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_datos_agro FOREIGN KEY (datos_agronomicos) REFERENCES datos_agronomicos (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_variedad_historia FOREIGN KEY (historia) REFERENCES historia_linaje (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE imagenes_variedad
DROP FOREIGN KEY imagenes_variedad_ibfk_1,
DROP FOREIGN KEY imagenes_variedad_ibfk_2,
ADD CONSTRAINT fk_imgvar_img FOREIGN KEY (imagenes_id) REFERENCES imagenes (id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_imgvar_variedad FOREIGN KEY (variedad_id) REFERENCES variedad (id) ON DELETE CASCADE ON UPDATE CASCADE;

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
INSERT INTO
    resistencias (
        tipo,
        calidad_grano,
        enfermedad
    )
VALUES ('Susceptible', 1, 1), -- Antioquia, calidad alta, Roya
    ('Tolerante', 2, 2), -- Caldas, Antracnosis
    ('Resistente', 3, 1), -- Huila, Roya
    ('Resistente', 3, 3), -- Huila, Nematodos
    ('Tolerante', 4, 4), -- Tolima, Broca
    ('Susceptible', 5, 5), -- Nariño, Ojo de gallo
    ('Resistente', 6, 1), -- Quindío, Roya
    ('Tolerante', 6, 2);
-- Quindío, Antracnosis

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

INSERT INTO
    imagenes_variedad (imagenes_id, variedad_id)
VALUES (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5);

-- Más imágenes
INSERT INTO
    imagenes (nombre, contenido)
VALUES (
        'geisha.jpg',
        'ejemplo_geisha'
    ),
    (
        'pink_bourbon.jpg',
        'ejemplo_pink_bourbon'
    ),
    ('java.jpg', 'ejemplo_java'),
    ('mokka.jpg', 'ejemplo_mokka'),
    ('sl28.jpg', 'ejemplo_sl28'),
    ('sl34.jpg', 'ejemplo_sl34'),
    (
        'mundo_novo.jpg',
        'ejemplo_mundo_novo'
    ),
    (
        'catuai.jpg',
        'ejemplo_catuai'
    ),
    ('pacas.jpg', 'ejemplo_pacas'),
    (
        'villa_sarchi.jpg',
        'ejemplo_villa_sarchi'
    ),
    (
        'tekisic.jpg',
        'ejemplo_tekisic'
    ),
    (
        'catimor.jpg',
        'ejemplo_catimor'
    ),
    (
        'sarchimor.jpg',
        'ejemplo_sarchimor'
    ),
    (
        'ruiru_11.jpg',
        'ejemplo_ruiru11'
    ),
    (
        'bourbon_pointu.jpg',
        'ejemplo_bourbon_pointu'
    ),
    (
        'laurina.jpg',
        'ejemplo_laurina'
    ),
    (
        'ethiopian_heirloom.jpg',
        'ejemplo_ethiopian'
    ),
    (
        'pacamara.jpg',
        'ejemplo_pacamara'
    ),
    (
        'maracaturra.jpg',
        'ejemplo_maracaturra'
    ),
    (
        'castillo.jpg',
        'ejemplo_castillo'
    );

-- Más historia/linaje
INSERT INTO
    historia_linaje (obtenor, familia, grupo)
VALUES (
        'Finca Esmeralda Panamá',
        'Arábica',
        'Variedad Etíope'
    ),
    (
        'Mutación Natural',
        'Arábica',
        'Variedad Rosa'
    ),
    (
        'Cultivadores Javaneses',
        'Arábica',
        'Variedad Asiática'
    ),
    (
        'Región de Mokka Yemen',
        'Arábica',
        'Variedad Ancestral'
    ),
    (
        'Scott Agricultural Labs Kenia',
        'Arábica',
        'Selección Keniana'
    ),
    (
        'Scott Agricultural Labs Kenia',
        'Arábica',
        'Selección Keniana'
    ),
    (
        'Instituto Agronómico Campinas',
        'Arábica',
        'Híbrido Brasileño'
    ),
    (
        'Instituto Agronómico Campinas',
        'Arábica',
        'Híbrido Brasileño'
    ),
    (
        'Pacas El Salvador',
        'Arábica',
        'Mutación Salvadoreña'
    ),
    (
        'Costa Rica CATIE',
        'Arábica',
        'Variedad Costarricense'
    ),
    (
        'El Salvador Fundación Salvadoreña',
        'Arábica',
        'Híbrido Salvadoreño'
    ),
    (
        'Portugal CIFC',
        'Arábica',
        'Híbrido Resistente'
    ),
    (
        'Portugal CIFC',
        'Arábica',
        'Híbrido Resistente'
    ),
    (
        'Coffee Research Foundation Kenia',
        'Arábica',
        'Variedad Keniana'
    ),
    (
        'Isla Reunión Francia',
        'Arábica',
        'Variedad Francesa'
    ),
    (
        'Isla Reunión Francia',
        'Arábica',
        'Mutación Natural'
    ),
    (
        'Etiopía Ancestral',
        'Arábica',
        'Variedad Silvestre'
    ),
    (
        'El Salvador',
        'Arábica',
        'Híbrido Gigante'
    ),
    (
        'Brasil Maracatu',
        'Arábica',
        'Híbrido Brasileño'
    ),
    (
        'Cenicafé Colombia',
        'Arábica',
        'Variedad Colombiana'
    );

-- Más ubicaciones
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
        'Cauca',
        'Templado húmedo',
        'Volcánico andino',
        '1.600 - 2.100 msnm',
        '16 - 21 °C',
        'Cultivo bajo sombra especializada y procesamiento húmedo'
    ),
    (
        'Risaralda',
        'Templado húmedo',
        'Franco-arcilloso volcánico',
        '1.400 - 1.900 msnm',
        '18 - 22 °C',
        'Manejo sostenible y certificación orgánica'
    ),
    (
        'Valle del Cauca',
        'Templado seco',
        'Aluvial volcánico',
        '1.200 - 1.700 msnm',
        '19 - 24 °C',
        'Riego por goteo y fertilización de precisión'
    ),
    (
        'Santander',
        'Templado húmedo',
        'Franco-limoso',
        '1.300 - 1.800 msnm',
        '17 - 22 °C',
        'Terrazas y conservación de suelos'
    ),
    (
        'Norte de Santander',
        'Templado húmedo',
        'Arcilloso profundo',
        '1.200 - 1.900 msnm',
        '18 - 23 °C',
        'Sistemas agroforestales complejos'
    ),
    (
        'Boyacá',
        'Frío moderado',
        'Andisol orgánico',
        '1.800 - 2.200 msnm',
        '15 - 19 °C',
        'Cultivo en ladera con barreras vivas'
    ),
    (
        'Cundinamarca',
        'Templado húmedo',
        'Franco con buen drenaje',
        '1.400 - 1.900 msnm',
        '17 - 21 °C',
        'Renovación por zocas y siembra tecnificada'
    ),
    (
        'Meta',
        'Cálido húmedo',
        'Franco-arenoso',
        '800 - 1.400 msnm',
        '22 - 28 °C',
        'Adaptación a clima cálido con sombra densa'
    ),
    (
        'Caquetá',
        'Cálido húmedo',
        'Arcilloso tropical',
        '600 - 1.200 msnm',
        '24 - 30 °C',
        'Manejo de humedad y control de malezas'
    ),
    (
        'Putumayo',
        'Cálido húmedo',
        'Volcánico tropical',
        '800 - 1.600 msnm',
        '20 - 26 °C',
        'Cultivo sostenible en zonas de transición'
    ),
    (
        'Cesar',
        'Cálido seco',
        'Franco-arenoso',
        '200 - 1.000 msnm',
        '26 - 32 °C',
        'Riego intensivo y sombra protectora'
    ),
    (
        'La Guajira',
        'Cálido seco',
        'Arenoso-pedregoso',
        '100 - 800 msnm',
        '28 - 35 °C',
        'Cultivo experimental con alta tecnificación'
    );

-- Más condiciones
INSERT INTO
    condiciones (
        genetica,
        clima,
        suelo,
        practicas_cultivo,
        temperatura
    )
VALUES (
        'Variedad Etíope',
        'Templado húmedo',
        'Volcánico de altura',
        'Procesamiento especial y fermentación controlada',
        '16-20 °C'
    ),
    (
        'Mutación Rosa',
        'Templado húmedo',
        'Andisol rico',
        'Cultivo bajo sombra selectiva',
        '15-21 °C'
    ),
    (
        'Línea Asiática',
        'Templado húmedo',
        'Franco-volcánico',
        'Poda selectiva y manejo de copa',
        '17-22 °C'
    ),
    (
        'Variedad Ancestral',
        'Templado seco',
        'Calcáreo-volcánico',
        'Cultivo tradicional con mínima intervención',
        '18-24 °C'
    ),
    (
        'Selección Africana',
        'Templado húmedo',
        'Rojo volcánico',
        'Alta densidad y fertilización balanceada',
        '16-21 °C'
    ),
    (
        'Híbrido Tropical',
        'Cálido húmedo',
        'Franco-tropical',
        'Manejo intensivo de sombra y humedad',
        '22-28 °C'
    ),
    (
        'Variedad de Altura',
        'Frío moderado',
        'Orgánico montano',
        'Cultivo ecológico y biodiverso',
        '14-18 °C'
    ),
    (
        'Línea Resistente',
        'Variable',
        'Adaptable',
        'Manejo integrado de resistencias',
        '16-24 °C'
    ),
    (
        'Variedad Especial',
        'Templado húmedo',
        'Premium volcánico',
        'Procesamiento artesanal y cuidado extremo',
        '17-21 °C'
    ),
    (
        'Híbrido Productivo',
        'Templado húmedo',
        'Mejorado técnicamente',
        'Tecnificación completa y monitoreo',
        '18-22 °C'
    );

-- Más enfermedades
INSERT INTO
    enfermedades (
        nombre,
        efectos,
        gravedad,
        tratamiento
    )
VALUES (
        'Mancha de hierro (Cercospora coffeicola)',
        'Manchas necróticas en hojas, defoliación parcial',
        'Media',
        'Fungicidas cúpricos y manejo de humedad relativa'
    ),
    (
        'Derrite (Phoma costarricensis)',
        'Muerte descendente de ramas, pérdida de vigor',
        'Alta',
        'Poda sanitaria severa y aplicación de fungicidas sistémicos'
    ),
    (
        'Mal rosado (Corticium salmonicolor)',
        'Formación de costras rosadas en ramas, muerte de tejidos',
        'Media',
        'Eliminación de ramas afectadas y protección de heridas'
    ),
    (
        'Koleroga (Pellicularia koleroga)',
        'Formación de telaraña en hojas, defoliación',
        'Baja',
        'Regulación de sombra y aplicación de fungicidas preventivos'
    ),
    (
        'Chahuixtle (Hemileia coffeicola)',
        'Manchas amarillas en hojas, similar a roya pero menos agresiva',
        'Media',
        'Variedades tolerantes y fungicidas específicos'
    ),
    (
        'Antracnosis de frutos (Colletotrichum gloeosporioides)',
        'Pudrición de cerezas maduras, pérdida de calidad',
        'Alta',
        'Recolección oportuna y fungicidas post-cosecha'
    ),
    (
        'Muerte descendente (Botryodiplodia theobromae)',
        'Secamiento de ramas desde las puntas',
        'Media',
        'Mejoramiento de drenaje y poda de saneamiento'
    ),
    (
        'Volcamiento (Rhizoctonia solani)',
        'Pudrición de raíces en almácigos, muerte de plántulas',
        'Alta',
        'Desinfección de sustratos y fungicidas de suelo'
    ),
    (
        'Mancha mantecosa (Colletotrichum kahawae)',
        'Lesiones aceitosas en frutos verdes',
        'Alta',
        'Variedades resistentes y control químico preventivo'
    ),
    (
        'Fumagina (Capnodium spp.)',
        'Hollín negro en hojas, reducción de fotosíntesis',
        'Baja',
        'Control de insectos vectores y mejora de ventilación'
    );

-- Más densidades (usando solo IDs que existen: porte 1,2,3 y tamanho_grano 1,2,3,4,5)
INSERT INTO
    densidad (
        porte,
        tamanho_grano,
        valor_densidad
    )
VALUES (1, 1, 3500), -- Porte alto, grano pequeño
    (1, 2, 3700), -- Porte alto, grano mediano
    (1, 4, 3600), -- Porte alto, grano supremo
    (2, 1, 4500), -- Porte intermedio, grano pequeño
    (2, 3, 4700), -- Porte intermedio, grano grande
    (2, 4, 4600), -- Porte intermedio, grano supremo
    (3, 2, 5500), -- Porte bajo, grano mediano
    (3, 3, 5200), -- Porte bajo, grano grande
    (3, 5, 5900);
-- Porte bajo, grano excelso

-- Más potencial de rendimiento (usando solo IDs de condiciones que existen: 1,2,3,4,5)
INSERT INTO
    potencial_de_rendimiento (potencial, condicion)
VALUES ('Alto', 1),
    ('Excepcional', 2),
    ('Medio-Alto', 3),
    ('Alto', 4),
    ('Excepcional', 5),
    ('Medio', 1),
    ('Bajo', 2),
    ('Medio-Alto', 3),
    ('Alto', 4),
    ('Medio', 5);

-- Más calidad de grano (usando IDs que existen)
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
        'Especial',
        'Floral complejo y miel',
        'Notas de bergamota y chocolate blanco',
        1,
        '9.5%',
        'Claro',
        1
    ),
    (
        'Alta',
        'Frutal tropical y vainilla',
        'Acidez cítrica con final de caramelo',
        2,
        '10%',
        'Medio-Claro',
        2
    ),
    (
        'Premium',
        'Jazmín y frutos rojos',
        'Complejo, acidez málica brillante',
        3,
        '9%',
        'Claro',
        3
    ),
    (
        'Especial',
        'Chocolate negro y especias',
        'Cuerpo pleno, notas de canela',
        4,
        '10.5%',
        'Medio',
        4
    ),
    (
        'Alta',
        'Caramelo y frutos secos',
        'Balanceado, dulzor natural',
        5,
        '11%',
        'Medio',
        5
    ),
    (
        'Media',
        'Herbáceo y tierra húmeda',
        'Rústico, cuerpo medio',
        6,
        '12%',
        'Medio-Oscuro',
        6
    ),
    (
        'Especial',
        'Floral intenso y miel de acacia',
        'Acidez brillante, final prolongado',
        1,
        '9%',
        'Claro',
        1
    ),
    (
        'Alta',
        'Frutal y chocolate con leche',
        'Dulce, bien balanceado',
        2,
        '10%',
        'Medio',
        2
    ),
    (
        'Premium',
        'Cítrico y floral',
        'Acidez vibrante, notas complejas',
        3,
        '9.5%',
        'Medio-Claro',
        3
    );

-- Más calidad por altitud (usando IDs de ubicación que existen)
INSERT INTO
    calidad_altitud (ubicacion, calidad)
VALUES (
        1,
        'Especial, altitudes entre 1.600-2.100 msnm producen cafés únicos con notas complejas'
    ),
    (
        2,
        'Alta, altitudes entre 1.400-1.900 msnm dan excelente balance y cuerpo'
    ),
    (
        3,
        'Media-Alta, altitudes entre 1.200-1.700 msnm con buen desarrollo aromático'
    ),
    (
        4,
        'Alta, altitudes entre 1.300-1.800 msnm generan cafés con carácter regional'
    ),
    (
        5,
        'Alta, altitudes entre 1.200-1.900 msnm producen cafés balanceados'
    ),
    (
        6,
        'Alta, altitudes entre 1.800-2.200 msnm dan acidez brillante y complejidad'
    ),
    (
        1,
        'Media-Alta, altitudes entre 1.400-1.900 msnm con buen desarrollo'
    ),
    (
        2,
        'Especial para clima cálido, altitudes bajas requieren manejo especializado'
    ),
    (
        3,
        'Experimental, adaptación a condiciones tropicales húmedas'
    ),
    (
        4,
        'Media, cultivo en transición con potencial de mejora'
    ),
    (
        5,
        'Baja-Media, requiere tecnificación para mejorar calidad'
    ),
    (
        6,
        'Experimental, condiciones áridas requieren manejo intensivo'
    );

-- Más resistencias (usando IDs que van a existir después de los inserts anteriores)
INSERT INTO
    resistencias (
        tipo,
        calidad_grano,
        enfermedad
    )
VALUES ('Resistente', 7, 6),
    ('Tolerante', 8, 7),
    ('Resistente', 9, 8),
    ('Susceptible', 10, 9),
    ('Tolerante', 11, 10),
    ('Resistente', 12, 1),
    ('Tolerante', 13, 2),
    ('Resistente', 14, 3),
    ('Susceptible', 15, 4),
    ('Tolerante', 7, 5),
    ('Resistente', 8, 6),
    ('Susceptible', 9, 7),
    ('Tolerante', 10, 8),
    ('Resistente', 11, 9),
    ('Susceptible', 12, 10),
    ('Resistente', 13, 1),
    ('Tolerante', 14, 2),
    ('Susceptible', 15, 3);

-- Más datos agronómicos (usando IDs de densidad que van a existir)
INSERT INTO
    datos_agronomicos (
        tiempo_cosecha,
        maduracion,
        nutricion,
        densidad_de_siembra
    )
VALUES (
        'Cosecha única especializada',
        'Muy lenta',
        'Nutrición orgánica premium',
        7
    ),
    (
        '2 cosechas con procesamiento diferenciado',
        'Media-Lenta',
        'Fertilización orgánica certificada',
        8
    ),
    (
        'Cosecha escalonada por calidad',
        'Media',
        'Manejo nutricional balanceado',
        9
    ),
    (
        'Cosecha principal extendida',
        'Rápida-Media',
        'Fertilización química controlada',
        10
    ),
    (
        'Múltiples recolectas selectivas',
        'Lenta',
        'Nutrición especializada para altura',
        11
    ),
    (
        'Cosecha adaptada a clima cálido',
        'Rápida',
        'Fertilización adaptada a condiciones tropicales',
        12
    ),
    (
        'Cosecha continua todo el año',
        'Media',
        'Manejo nutricional intensivo',
        13
    ),
    (
        'Cosecha experimental',
        'Variable',
        'Nutrición de investigación',
        14
    ),
    (
        'Cosecha mecanizada parcial',
        'Media-Rápida',
        'Fertilización de precisión',
        15
    ),
    (
        'Cosecha única especializada',
        'Muy lenta',
        'Nutrición orgánica premium',
        7
    ),
    (
        '2 cosechas con procesamiento diferenciado',
        'Media-Lenta',
        'Fertilización orgánica certificada',
        8
    ),
    (
        'Cosecha escalonada por calidad',
        'Media',
        'Manejo nutricional balanceado',
        9
    ),
    (
        'Cosecha principal extendida',
        'Rápida-Media',
        'Fertilización química controlada',
        10
    ),
    (
        'Múltiples recolectas selectivas',
        'Lenta',
        'Nutrición especializada para altura',
        11
    ),
    (
        'Cosecha adaptada a clima cálido',
        'Rápida',
        'Fertilización adaptada a condiciones tropicales',
        12
    ),
    (
        'Cosecha continua todo el año',
        'Media',
        'Manejo nutricional intensivo',
        13
    ),
    (
        'Cosecha experimental',
        'Variable',
        'Nutrición de investigación',
        14
    ),
    (
        'Cosecha mecanizada parcial',
        'Media-Rápida',
        'Fertilización de precisión',
        15
    );

-- Más variedades (usando IDs que van a existir secuencialmente)
INSERT INTO
    variedad (
        nombre_comun,
        nombre_cientifico,
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
        'Geisha',
        'Coffea arabica var. geisha',
        'Variedad etíope de calidad excepcional, conocida por sus notas florales únicas y complejidad en taza.',
        1,
        3,
        1800.00,
        6,
        7,
        9,
        7,
        7
    ),
    (
        'Pink Bourbon',
        'Coffea arabica var. pink bourbon',
        'Mutación natural de Bourbon con cerezas rosadas, perfil de taza dulce y complejo.',
        1,
        4,
        1750.00,
        7,
        8,
        10,
        8,
        8
    ),
    (
        'Java',
        'Coffea arabica var. java',
        'Variedad asiática tradicional, adaptada a condiciones húmedas con buen cuerpo.',
        1,
        2,
        1600.00,
        8,
        9,
        11,
        9,
        9
    ),
    (
        'Mokka',
        'Coffea arabica var. mokka',
        'Variedad ancestral yemení, grano pequeño pero intenso sabor.',
        3,
        1,
        1900.00,
        9,
        10,
        12,
        10,
        10
    ),
    (
        'SL28',
        'Coffea arabica var. sl28',
        'Selección keniana conocida por su acidez brillante y notas frutales.',
        2,
        3,
        1700.00,
        10,
        11,
        13,
        11,
        11
    ),
    (
        'SL34',
        'Coffea arabica var. sl34',
        'Selección keniana hermana del SL28, excelente para alturas medias.',
        2,
        3,
        1650.00,
        11,
        12,
        14,
        12,
        12
    ),
    (
        'Mundo Novo',
        'Coffea arabica var. mundo novo',
        'Híbrido brasileño entre Typica y Bourbon, muy productivo.',
        1,
        4,
        1500.00,
        12,
        13,
        15,
        13,
        13
    ),
    (
        'Catuaí',
        'Coffea arabica var. catuai',
        'Híbrido brasileño compacto, excelente para cultivo intensivo.',
        3,
        2,
        1400.00,
        13,
        14,
        16,
        14,
        14
    ),
    (
        'Pacas',
        'Coffea arabica var. pacas',
        'Mutación salvadoreña de Bourbon, porte bajo y buena calidad.',
        3,
        3,
        1550.00,
        14,
        15,
        17,
        15,
        15
    ),
    (
        'Villa Sarchí',
        'Coffea arabica var. villa sarchi',
        'Variedad costarricense de porte bajo, adaptada a vientos fuertes.',
        3,
        2,
        1600.00,
        15,
        16,
        18,
        16,
        16
    ),
    (
        'Tekisic',
        'Coffea arabica var. tekisic',
        'Híbrido salvadoreño resistente a enfermedades y productivo.',
        2,
        3,
        1500.00,
        6,
        17,
        19,
        17,
        17
    ),
    (
        'Catimor',
        'Coffea arabica var. catimor',
        'Híbrido resistente a roya, combina Caturra con Híbrido de Timor.',
        2,
        2,
        1300.00,
        7,
        18,
        20,
        18,
        18
    ),
    (
        'Sarchimor',
        'Coffea arabica var. sarchimor',
        'Híbrido resistente derivado de Villa Sarchí e Híbrido de Timor.',
        2,
        3,
        1400.00,
        8,
        7,
        21,
        7,
        19
    ),
    (
        'Ruiru 11',
        'Coffea arabica var. ruiru 11',
        'Variedad keniana compacta, resistente a enfermedades principales.',
        3,
        2,
        1600.00,
        9,
        8,
        22,
        8,
        14
    ),
    (
        'Bourbon Pointu',
        'Coffea arabica var. bourbon pointu',
        'Mutación francesa de Bourbon, grano puntiagudo y bajo en cafeína.',
        2,
        1,
        1750.00,
        10,
        9,
        23,
        9,
        15
    ),
    (
        'Laurina',
        'Coffea arabica var. laurina',
        'Variedad francesa naturalmente baja en cafeína, porte compacto.',
        3,
        1,
        1800.00,
        11,
        10,
        24,
        10,
        16
    ),
    (
        'Ethiopian Heirloom',
        'Coffea arabica var. heirloom',
        'Variedades nativas etíopes, genética ancestral diversa.',
        2,
        2,
        1900.00,
        12,
        11,
        25,
        11,
        17
    ),
    (
        'Pacamara',
        'Coffea arabica var. pacamara',
        'Híbrido salvadoreño entre Pacas y Maragogipe, grano muy grande.',
        1,
        3,
        1650.00,
        13,
        12,
        26,
        12,
        18
    ),
    (
        'Maracaturra',
        'Coffea arabica var. maracaturra',
        'Híbrido brasileño entre Maragogipe y Caturra, equilibrio entre tamaño y productividad.',
        2,
        4,
        1550.00,
        14,
        13,
        1,
        13,
        19
    ),
    (
        'Castillo',
        'Coffea arabica var. castillo',
        'Variedad colombiana desarrollada por Cenicafé, resistente a roya y productiva.',
        2,
        4,
        1500.00,
        15,
        14,
        2,
        14,
        20
    );

-- Más relaciones imagen-variedad
INSERT INTO
    imagenes_variedad (imagenes_id, variedad_id)
VALUES (6, 6),
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10),
    (11, 11),
    (12, 12),
    (13, 13),
    (14, 14),
    (15, 15),
    (16, 16),
    (17, 17),
    (18, 18),
    (19, 19),
    (20, 20),
    (21, 21),
    (22, 22),
    (23, 23),
    (24, 24),
    (25, 25),
    (26, 26);
-- Relaciones adicionales (una variedad puede tener múltiples imágenes)
INSERT INTO
    imagenes_variedad (imagenes_id, variedad_id)
VALUES (1, 7),
    (2, 8),
    (3, 9),
    (4, 10),
    (5, 11),
    (6, 12),
    (7, 13),
    (8, 14),
    (9, 15),
    (10, 16),
    (11, 17),
    (12, 18),
    (13, 19),
    (14, 20),
    (15, 21),
    (16, 22),
    (17, 23),
    (18, 24),
    (19, 25),
    (20, 26);

SELECT * FROM imagenes;

SELECT * FROM variedad;

SELECT * FROM datos_agronomicos;