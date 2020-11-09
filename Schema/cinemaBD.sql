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
     name VARCHAR(50) NOT NULL,
     email VARCHAR(50) NOT NULL,
  	 pass VARCHAR(5) NOT NULL,
     is_active INT NOT NULL,
     primary key(id_user)
)ENGINE =INNODB;

CREATE TABLE IF NOT EXISTS tickets(
 id_ticket INT NOT NULL auto_increment,
 id_user INT NOT NULL,
 id_show INT NOT NULL,
 quantity INT NOT NULL,
 price INT NOT NULL,
 card_type VARCHAR(50) NOT NULL,
 card_number INT NOT NULL,
 primary key(id_ticket),
 CONSTRAINT fk_ticketUser foreign key (id_user) references users(id_user),
 CONSTRAINT fk_ticketShow foreign key (id_show) references shows(id_show)
)ENGINE =INNODB;



INSERT INTO cinemas (id_cinema,name,address,capacity,imageUrl,is_active)
VALUES (1,"Paseo Aldrey","Sarmiento 2685",0,"/cinema2020/Views/default/images/aldrey.png",1),
	   (2,"Cine del paseo","Diagonal Pueyrredon 3058",0,"/cinema2020/Views/default/images/paseo.png",1),
	  (3,"Cinema Los Gallegos Shopping","Rivadavia 3050",0,"/cinema2020/Views/default/images/losgallegos.png",1);
      
   
INSERT INTO rooms (id_room,name,capacity,price,is_active,id_cinema)
VALUES (1,"SALA 1",150,200,1,1),
	   (2,"SALA 2",100,150,1,1),
       (3,"SALA A",120,100,1,2),
       (4,"SALA B",130,110,1,2),
       (5,"SALA I",150,180,1,3),
       (6,"SALA II",170,220,1,3);
      
INSERT INTO users (id_user,name,email,pass,is_active)
VALUES (1,"Administrador","admin@gmail.com",1234,1),
	   (2,"Ayelen","user@gmail.com",1234,1);
	
