CREATE DATABASE IF NOT EXISTS cinema;
USE cinema;

CREATE TABLE IF NOT EXISTS cinemas(
        id_cinema INT NOT NULL auto_increment,
		name VARCHAR(50) NOT NULL,
		address VARCHAR(50) NOT NULL,
		capacity INT NOT NULL,
        imageUrl VARCHAR(200),
        is_active INT NOT NULL,
        PRIMARY KEY(id_cinema)
)ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS movies(
        id_movie INT NOT NULL auto_increment,
        title VARCHAR(50) NOT NULL,
        image VARCHAR(200)NOT NULL,
        description VARCHAR(3000) NOT NULL,
        poster VARCHAR(300) NOT NULL,
        is_active INT,
        PRIMARY KEY (id_movie)
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS genres(
  id_genre INT NOT NULL,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY(id_genre)
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS movieGenre(
  id_genre INT NOT NULL,
  id_movie INT NOT NULL,
  CONSTRAINT fk_movieGenreG foreign key (id_genre) references genres(id_genre),
  CONSTRAINT fk_movieGenreM foreign key (id_movie) references movies(id_movie),
  primary key (id_genre,id_movie)
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS rooms(
        id_room INT NOT NULL auto_increment,
        name VARCHAR(50) NOT NULL,
        capacity INT NOT NULL,
        price INT NOT NULL,
		is_active INT NOT NULL,
		id_cinema INT NOT NULL,
        PRIMARY KEY (id_room),
        CONSTRAINT fk_cineRooms foreign key (id_cinema) references cinemas(id_cinema)
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS shows(
		id_show INT NOT NULL auto_increment,
		startDate DATE NOT NULL,
		endDate DATE NOT NULL,
        duration INT NOT NULL,
        time TIME NOT NULL,
		id_cinema INT NOT NULL,
		id_room INT NOT NULL,
        id_movie INT NOT NULL,
        isActive INT NOT NULL,
        PRIMARY KEY (id_show),
        CONSTRAINT fk_cinemaShow foreign key (id_cinema) references cinemas(id_cinema),
        CONSTRAINT fk_roomShow foreign key (id_room) references rooms(id_room),
        CONSTRAINT fk_roomMovie foreign key (id_movie) references movies(id_movie)
)ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS users(
	 id_user INT NOT NULL auto_increment,
     email VARCHAR(50) NOT NULL,
	 pass VARCHAR(5) NOT NULL,
     primary key(id_user)
)ENGINE =INNODB;

CREATE TABLE IF NOT EXISTS tickets(
 id_ticket INT NOT NULL auto_increment,
 id_user INT NOT NULL unique,
 id_show INT NOT NULL unique,
 quantity INT NOT NULL,
 price INT NOT NULL,
 car_type VARCHAR(50) NOT NULL,
 card_number INT NOT NULL,
 primary key(id_ticket),
 foreign key (id_user) references users(id_user),
 foreign key (id_show) references shows(id_show)
)ENGINE =INNODB;

	
DROP procedure IF EXISTS `Cinemas_GetById`;

DELIMITER $$
CREATE PROCEDURE Cinemas_GetById (IN id_cinema INT)
BEGIN
	SELECT * FROM cinemas
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Add`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Add (IN name VARCHAR(50), IN address VARCHAR(50), IN capacity INT, IN price INT, IN imageUrl VARCHAR(200),IN is_active INT)
BEGIN
	INSERT INTO cinemas
        (cinemas.name, cinemas.address, cinemas.capacity, cinemas.price, cinemas.imageUrl,cinemas.is_active)
    VALUES
        (name,address,capacity,price,imageUrl,is_active);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_GetAll`;

DELIMITER $$
CREATE PROCEDURE Cinemas_GetAll()
BEGIN
	SELECT id_cinema,name,address,capacity,price,imageUrl
    FROM cinemas
	WHERE (cinemas.is_active = 1);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Delete`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Delete(IN id_cinema INT)
BEGIN
	UPDATE cinemas
    SET cinemas.is_active = 0
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Cinemas_Update`;

DELIMITER $$
CREATE PROCEDURE Cinemas_Update(IN id_cinema INT, IN name VARCHAR(50), IN address VARCHAR(50), IN capacity INT, IN price INT, IN imageUrl VARCHAR(200))
BEGIN
	UPDATE cinemas
    SET  cinemas.name= name, cinemas.address= address, cinemas.capacity= capacity, cinemas.price= price, cinemas.imageUrl= imageUrl
    WHERE (cinemas.id_cinema = id_cinema);
END$$
DELIMITER ;


#Procedure de rooms

DROP procedure IF EXISTS `Rooms_Add`;

DELIMITER $$
CREATE PROCEDURE Rooms_Add (IN name VARCHAR(50), IN capacity INT, IN price INT,IN is_active INT,IN id_cinema INT)
BEGIN
	INSERT INTO rooms
        (rooms.name, rooms.capacity, rooms.price, rooms.is_active, rooms.id_cinema)
    VALUES
        (name,capacity,price,is_active,id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Rooms_GetAll`;

DELIMITER $$
CREATE PROCEDURE Rooms_GetAll(IN id_cinema INT)
BEGIN
	SELECT* FROM rooms
    WHERE (rooms.is_active=1) AND (rooms.id_cinema=id_cinema);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Rooms_Delete`;

DELIMITER $$
CREATE PROCEDURE Rooms_Delete(IN id_room INT)
BEGIN
	UPDATE rooms
    SET rooms.is_active = 0
    WHERE (rooms.id_room = id_room);
END$$
DELIMITER ;

#procedure de movies

DROP procedure IF EXISTS `Movies_Add`;

DELIMITER $$
CREATE PROCEDURE Movies_Add (IN title VARCHAR(50), IN image VARCHAR(50), IN description VARCHAR(300))
BEGIN
	INSERT INTO movies
        (movies.title, movies.image, movies.description)
    VALUES
        (title,image,description);
END$$
DELIMITER ;

DROP procedure IF EXISTS `Movies_GetAll`;

DELIMITER $$
CREATE PROCEDURE Movies_GetAll()
BEGIN
	SELECT id_movie, title, image, description
    FROM movies;
END$$
DELIMITER ;

DROP procedure IF EXISTS `Movies_Delete`;

DELIMITER $$
CREATE PROCEDURE Movies_Delete(IN id_movie INT)
BEGIN
	DELETE 
    FROM movies
    WHERE (movies.id_movie = id_movie);
END$$
DELIMITER ;


INSERT INTO cinemas (id_cinema,imageUrl,name,capacity,address,price,is_active)
VALUES (1,"/cinema2020/Views/default/images/aldrey.png","Paseo Aldrey",0,"Sarmiento 2685",true),
	   (2,"/cinema2020/Views/default/images/paseo.png","Cine del paseo",0,"Diagonal Pueyrredón 3058",false),
	  (3,"/cinema2020/Views/default/images/losgallegos.png","Cinema Los Gallegos Shopping",0,"Rivadavia 3050",true);
	
