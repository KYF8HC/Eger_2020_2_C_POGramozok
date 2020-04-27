DROP TABLE IF eXISTS users;
CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT UNIQUE,
    email varchar(200) NOT NULL UNIQUE,
    password text NOT NULL,
    name varchar(200) NOT Null,
    CONSTRAINT users_pk PRIMARY KEY(id)
    );
DROP TABLE IF EXISTS moovies;
CREATE TABLE moovies(
    id int not null AUTO_INCREMENT UNIQUE,
    name varchar(300) not null,
    description varchar(500) not null,
    rating tinyint,
    CONSTRAINT moovies_pk PRIMARY KEY(id)
    );
DROP TABLE IF EXISTS rooms;
CREATE TABLE rooms(
    id int not null AUTO_INCREMENT UNIQUE,
    slots int not null,
    CONSTRAINT room_pk PRIMARY KEY(id)
    );
    
DROP TABLE IF EXISTS projection;
CREATE TABLE projection(
    id int NOT null AUTO_INCREMENT UNIQUE,
	projection_date date not null,
    room_id int not null,
    moovie_id int not null,
    CONSTRAINT projection_pk PRIMARY KEY(id),
    CONSTRAINT projection_moovies_FK FOREIGN KEY(moovie_id) REFERENCES moovies(id),
    CONSTRAINT projection_rooms_FK FOREIGN KEY(room_id) REFERENCES rooms(id)
);