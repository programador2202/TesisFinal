-- Active: 1726418525214@@127.0.0.1@3306@sistema_ruta_del_sabor
CREATE DATABASE SISTEMA_RUTA_DEL_SABOR;

USE SISTEMA_RUTA_DEL_SABOR;
drop database SISTEMA_RUTA_DEL_SABOR;

CREATE TABLE CATEGORIA (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)  UNIQUE NOT NULL
) ENGINE=INNODB;

INSERT INTO CATEGORIA(nombre) VALUES
('Comida Oriental'),
('Hamburgueserias'),
('Pollerias'),
('Pescados y Mariscos'),
('Gourmet'),
('Comida Peruana'),
('Campestres'),
('Cafe y Pastelerias'),
('Carnes y Parrillas'),
('Pizza'),
('Huariques y otros');

SELECT * FROM CATEGORIA;


CREATE TABLE RESTAURANTES(
    idrestaurante INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT NOT NULL,
    nom_restaurante  VARCHAR(100) UNIQUE NOT NULL,
    img VARCHAR(255) DEFAULT NULL,
    descripcion TEXT NOT NULL,
    direccion VARCHAR(500) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    CONSTRAINT fk_categoria FOREIGN KEY (idcategoria) REFERENCES CATEGORIA(idcategoria)
) ENGINE=INNODB;

INSERT INTO RESTAURANTES (idcategoria, nom_restaurante, img, descripcion, direccion, telefono) VALUES
(4,'El Punto Marino','punto_marino.jpg','En El Punto Marino, nos enorgullecemos de ofrecer una experiencia gastronómica única en Chincha, nos especializamos en platos que capturan la esencia fresca y deliciosa de los productos marinos locales donde cada bocado está cuidadosamente elaborado para satisfacer hasta los paladares más exigentes.','Jr. Sebastián Barranca 551 Pueblo Nuevo, Chincha Alta, Perú','978085372'),
(1,'Mister Wok','mister_wok.jpg','En Mister Wok, no solo ofrecemos una experiencia culinaria excepcional, sino también un viaje a través de los sabores más tradicionales y deliciosos de la cocina china. Nos comprometemos a utilizar ingredientes frescos y de alta calidad en cada uno de nuestros platos.','Av. Óscar R. Benavides 598 - Plaza de Armas de Pueblo Nuevo','924817518'),
(6,'El Gran Combo','gran_combo.jpg','Somos el lugar ideal para disfrutar de una experiencia gastronómica que celebra las ricas tradiciones culinarias. Con un enfoque en la calidad y la frescura, nuestros productos están elaborados con ingredientes seleccionados para satisfacer a los paladares más exigentes.','Calle Grau N°427 - Chincha Alta - Perú','995420277'),
(2,'Daddy’s Trucks Burger','daddys_truck.jpg','Daddy’s Trucks Burger es un restaurante único en Chincha que se distingue por ofrecer una experiencia de comida rápida diferente. Inspirado en el estilo de los food trucks, este lugar va más allá de las hamburguesas tradicionales, brindando a los visitantes una opción deliciosa y auténtica en cada bocado.','Prolongación Lima, Urb Bancarios E4, Chincha Alta','934617457'),
(5,'Daito','daito.jpg','En Daito, nos enorgullecemos de ser un restaurante dedicado a presentar la exquisita cocina Nikkei, una emocionante mezcla de sabores que refleja la rica herencia cultural de Perú y Japón. La comida Nikkei es una hermosa fusión que nace de la unión de ingredientes frescos y técnicas culinarias que han evolucionado durante generaciones.','Av. Principal 388 - Carr. de Sunampe','940790534'),
(1,'Sacha Nikkei','sacha_nikkei.jpg','Sacha Nikkei es un restaurante de comida japonesa – peruana donde nos dedicamos a la preparación del sushi en sus varias presentaciones y sabores. También contamos con platos calientes como Sopas Ramen, Salteados y algunas entraditas.','Los Ángeles 153, Chincha Alta','924826030');

-- Consulta conjunta
SELECT r.idrestaurante, r.nom_restaurante, c.nombre AS categoria, r.direccion, r.telefono
FROM RESTAURANTES r
INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria;

SELECT 
    r.idrestaurante,
    r.nom_restaurante,
    r.img,
    r.descripcion,
    r.direccion,
    r.telefono,
    c.nombre AS categoria
FROM RESTAURANTES r
INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
WHERE r.idcategoria = 2;




 

CREATE TABLE PLATOS(
    idplatos INT AUTO_INCREMENT PRIMARY KEY,
    imagen VARCHAR(255),
    nom_platos  VARCHAR(100) UNIQUE NOT NULL,
    descripcion VARCHAR(500) NOT NULL,
    precio DECIMAL(7,2) NOT NULL,
    idrestaurante INT NOT NULL,
    CONSTRAINT fk_restaurante FOREIGN KEY (idrestaurante) REFERENCES RESTAURANTES(idrestaurante)
)ENGINE=INNODB;

INSERT INTO PLATOS (imagen, nom_platos, descripcion, precio, idrestaurante) VALUES
('img/platos/ceviche_mixto.jpg', 'Ceviche Mixto', 'Clásico ceviche con pescado y mariscos frescos, servido con camote y choclo.', 28.00, 1),
('img/platos/arroz_mariscos.jpg', 'Arroz con Mariscos', 'Arroz sazonado con una mezcla de mariscos al estilo norteño.', 32.00, 1),
('img/platos/chancho_tamarindo.jpg', 'Chancho en Salsa Tamarindo', 'Carne de cerdo crocante bañada en salsa de tamarindo, estilo oriental.', 29.90, 2),
('img/platos/tallarines_saltados.jpg', 'Tallarines Saltados', 'Fideos salteados con verduras, pollo y salsa oriental.', 25.00, 2),
('img/platos/aji_de_gallina.jpg', 'Ají de Gallina', 'Tradicional plato peruano a base de gallina deshilachada y crema de ají.', 24.50, 3),
('img/platos/lomo_saltado.jpg', 'Lomo Saltado', 'Trozos de carne salteados con cebolla, tomate y papas fritas.', 26.00, 3);


SELECT 
    p.idplatos,
    p.imagen,
    p.nom_platos,
    p.descripcion,
    p.precio,
    p.idrestaurante,
    r.nom_restaurante,
    r.direccion,
    r.telefono
FROM PLATOS p
JOIN RESTAURANTES r ON p.idrestaurante = r.idrestaurante
WHERE p.idrestaurante = 1;

CREATE TABLE RESTAURANTE_CALIFICACION (
  idcalificacion INT AUTO_INCREMENT PRIMARY KEY,
  idrestaurantes INT NOT NULL,
  calificacion DECIMAL(2,1) NOT NULL,
  comentario VARCHAR(500) NOT NULL,
  fecha DATE NOT NULL,
  CONSTRAINT fk_restaurante_calif FOREIGN KEY (idrestaurantes) REFERENCES RESTAURANTES(idrestaurante)
) ENGINE=INNODB;

INSERT INTO RESTAURANTE_CALIFICACION (idrestaurantes, calificacion, comentario, fecha) VALUES
(1, 4.5, 'Excelente atención y el ceviche muy fresco. ¡Recomendado!', '2025-09-01'),
(2, 3.8, 'Buena comida oriental, pero el servicio fue un poco lento.', '2025-09-02'),
(3, 5.0, 'El mejor lomo saltado que he probado en Chincha. Volveré pronto.', '2025-09');


SELECT 
    r.idrestaurante,
    r.nom_restaurante,
    r.direccion,
    r.telefono,
    AVG(rc.calificacion) AS promedio_calificacion
FROM RESTAURANTES r
LEFT JOIN RESTAURANTE_CALIFICACION rc ON r.idrestaurante = rc.idrestaurantes
GROUP BY r.idrestaurante, r.nom_restaurante, r.direccion, r.telefono;


SELECT 
    r.*,
    AVG(rc.calificacion) AS promedio_calificacion
FROM RESTAURANTES r
LEFT JOIN RESTAURANTE_CALIFICACION rc ON r.idrestaurante = rc.idrestaurantes
GROUP BY r.idrestaurante;