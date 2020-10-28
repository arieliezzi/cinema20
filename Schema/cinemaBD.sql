CREATE DATABASE IF NOT EXISTS cinema;
USE cinema;

CREATE TABLE IF NOT EXISTS cinemas(
        id_cinema INT NOT NULL auto_increment,
		name VARCHAR(50) NOT NULL,
		address VARCHAR(50) NOT NULL,
		capacity INT NOT NULL,
		price INT NOT NULL,
        imageUrl VARCHAR(200) NOT NULL,
        PRIMARY KEY(id_cinema)
)ENGINE = INNODB;

DROP procedure IF EXISTS `Cinemas_GetById`;

DELIMITER $$
CREATE PROCEDURE Cinemas_GetById (IN id_cinema INT)
BEGIN
	SELECT cinemas.id_cinema, cinemas.name, cinemas.address, cinemas.capacity, cinemas.price, cinemas.imageUrl
    FROM cinemas
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Add`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Add (IN name VARCHAR(50), IN address VARCHAR(50), IN capacity INT, IN price INT, IN imageUrl VARCHAR(200))
BEGIN
	INSERT INTO cinemas
        (cinemas.name, cinemas.address, cinemas.capacity, cinemas.price, cinemas.imageUrl)
    VALUES
        (name,address,capacity,price,imageUrl);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_GetAll`;

DELIMITER $$
CREATE PROCEDURE Cinemas_GetAll()
BEGIN
	SELECT id_cinema,name,address,capacity,price,imageUrl
    FROM cinemas;
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Delete`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Delete(IN id_cinema INT)
BEGIN
	DELETE 
    FROM cinemas
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Update`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Update(IN id_cinema INT, IN name VARCHAR(50), IN address VARCHAR(50), IN capacity INT, IN price INT, IN imageUrl VARCHAR(200))
BEGIN
	UPDATE cinemas
    SET cinemas.name= name, cinemas.address= address, cinemas.capacity= capacity, cinemas.price= price, cinemas.imageUrl= imageUrl
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;

INSERT INTO cinemas (id_cinema,imageUrl,name,capacity,address,price)
VALUES (1,"/cinema2020/Views/default/images/aldrey.png","Paseo Aldrey",300,"Sarmiento 2685",250),
	   (2,"/cinema2020/Views/default/images/paseo.png","Cine del paseo",200,"Diagonal Pueyrredón 3058",200),
	   (3,"/cinema2020/Views/default/images/losgallegos.png","Cinema Los Gallegos Shopping",250,"Rivadavia 3050",220);
	
