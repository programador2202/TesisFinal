CREATE DATABASE SISTEMA_RUTA_DEL_SABOR;

USE SISTEMA_RUTA_DEL_SABOR;
---drop database SISTEMA_RUTA_DEL_SABOR;----

CREATE TABLE CATEGORIA (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
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

SELECT*FROM CATEGORIA;



CREATE TABLE RESTAURANTES(
    idrestaurante INT AUTO_INCREMENT PRIMARY KEY,
    nom_restaurante VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    direccion VARCHAR(500) NOT NULL,
    telefono VARCHAR(13) NOT NULL
) ENGINE=INNODB;

INSERT INTO RESTAURANTES (nom_restaurante,descripcion,direccion,telefono) VALUES
('El Punto Marino','En El Punto Marino, nos enorgullecemos de ofrecer una experiencia gastronómica única en Chincha, nos especializamos en platos que capturan la esencia fresca y deliciosa de los productos marinos locales donde cada bocado está cuidadosamente elaborado para satisfacer hasta los paladares más exigentes.','Jr. Sebastián Barranca 551 Pueblo Nuevo, Chincha Alta, Peru','978 085 372'),
('Mister Wok','En Mister Wok, no solo ofrecemos una experiencia culinaria excepcional, sino también un viaje a través de los sabores más tradicionales y deliciosos de la cocina china. Nos comprometemos a utilizar ingredientes frescos y de alta calidad en cada uno de nuestros platos.','Av. Óscar R. Benavides 598 - Plaza de Armas de Pueblo Nuevo','924 817 518'),
('El Gran Combo','Somos el lugar ideal para disfrutar de una experiencia gastronómica que celebra las ricas tradiciones culinarias. Con un enfoque en la calidad y la frescura, nuestros productos están elaborados con ingredientes seleccionados para satisfacer a los paladares más exigentes.','Calle Grau N°427 - Chincha Alta - Perú','995 420 277'),
('Daddy’s Trucks Burger','Daddy’s Trucks Burger es un restaurante único en Chincha que se distingue por ofrecer una experiencia de comida rápida diferente. Inspirado en el estilo de los food trucks, este lugar va más allá de las hamburguesas tradicionales, brindando a los visitantes una opción deliciosa y auténtica en cada bocado.','Prolongación Lima, Urb Bancarios E4, Chincha Alta','S934 617 457'),
('Daito','En Daito, nos enorgullecemos de ser un restaurante dedicado a presentar la exquisita cocina Nikkei, una emocionante mezcla de sabores que refleja la rica herencia cultural de Perú y Japón. La comida Nikkei es una hermosa fusión que nace de la unión de ingredientes frescos y técnicas culinarias que han evolucionado durante generaciones.','Av. Principal 388 - Carr. de Sunampe','940 790 534'),
('Sacha nikkei','Sacha nikkei es un restaurante de comida japonesa – peruana donde nos dedicamos a la preparación del sushi en sus varias presentaciones y sabores. También contamos con platos calientes como Sopas Ramen, Salteados y algunas entraditas.','Los Ángeles 153, Chincha Alta','924 826 030');
SELECT*FROM RESTAURANTES;


 

CREATE TABLE PLATOS(
    idplatos INT AUTO_INCREMENT PRIMARY KEY,
    imagen VARCHAR(255),
    nom_platos VARCHAR(100) NOT NULL,
    descripcion VARCHAR(500) NOT NULL,
    precio DECIMAL(7,2) NOT NULL,
    idcategoria INT NOT NULL,
    idrestaurante INT NOT NULL,
    CONSTRAINT fk_categoria FOREIGN KEY (idcategoria) REFERENCES CATEGORIA(idcategoria),
    CONSTRAINT fk_restaurante FOREIGN KEY (idrestaurante) REFERENCES RESTAURANTES(idrestaurante)
)ENGINE=INNODB;

INSERT INTO PLATOS (imagen, nom_platos, descripcion, precio, idcategoria, idrestaurante) VALUES
('img/platos/ceviche_mixto.jpg', 'Ceviche Mixto', 'Clásico ceviche con pescado y mariscos frescos, servido con camote y choclo.', 28.00, 4, 1),
('img/platos/arroz_mariscos.jpg', 'Arroz con Mariscos', 'Arroz sazonado con una mezcla de mariscos al estilo norteño.', 32.00, 4, 1),
('img/platos/chancho_tamarindo.jpg', 'Chancho en Salsa Tamarindo', 'Carne de cerdo crocante bañada en salsa de tamarindo, estilo oriental.', 29.90, 1, 2),
('img/platos/tallarines_saltados.jpg', 'Tallarines Saltados', 'Fideos salteados con verduras, pollo y salsa oriental.', 25.00, 1, 2),
('img/platos/aji_de_gallina.jpg', 'Ají de Gallina', 'Tradicional plato peruano a base de gallina deshilachada y crema de ají.', 24.50, 6, 3),
('img/platos/lomo_saltado.jpg', 'Lomo Saltado', 'Trozos de carne salteados con cebolla, tomate y papas fritas.', 26.00, 6, 3);

SELECT*FROM PLATOS;





