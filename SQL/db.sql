CREATE DATABASE app-dev;

CREATE TABLE users(
    id MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    password VARCHAR(100) NOT NULL
    registration_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_level TINYINT(1) UNSIGNED NOT NULL
);

CREATE TABLE categories(
    id MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    product_title VARCHAR(100) NOT NULL,
    product_image VARCHAR(100) NOT NULL,
    product_price VARCHAR(100) NOT NULL,
    product_description TEXT NOT NULL,    
    registration_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
);