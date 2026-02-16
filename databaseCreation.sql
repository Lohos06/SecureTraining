CREATE DATABASE projetSecutrite;
USE projetSecutrite;

CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content text,
    slug VARCHAR(255)
);

DROP DATABASE projetSecutrite;