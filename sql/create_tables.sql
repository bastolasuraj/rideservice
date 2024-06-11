CREATE DATABASE if not exists sbastola_itil;

USE sbastola_itil;

CREATE TABLE if not exists users
(
    user_id  INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50)  NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists cities
(
    city_id INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE if not exists riders
(
    rider_id    INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL UNIQUE,
    referrer_id INT,
    FOREIGN KEY (referrer_id) REFERENCES riders (rider_id)
);

CREATE TABLE if not exists rides
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    rider_id  INT,
    ride_type ENUM ('ow', 'bw'),
    ride_from INT,
    date      DATE,
    FOREIGN KEY (rider_id) REFERENCES riders (rider_id),
    FOREIGN KEY (ride_from) REFERENCES cities (city_id)
);
