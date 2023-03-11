CREATE DATABASE game_database;

USE game_database;

CREATE TABLE users (
                       id INT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL,
                       password VARCHAR(50) NOT NULL,
                       email VARCHAR(100) NOT NULL
);

CREATE TABLE high_scores (
                             id INT PRIMARY KEY,
                             user_id INT,
                             game_name VARCHAR(50) NOT NULL,
                             score INT NOT NULL,
                             date_played DATE NOT NULL,
                             FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE game_data (
                           id INT PRIMARY KEY,
                           user_id INT,
                           game_name VARCHAR(50) NOT NULL,
                           data TEXT NOT NULL,
                           FOREIGN KEY (user_id) REFERENCES users(id)
);