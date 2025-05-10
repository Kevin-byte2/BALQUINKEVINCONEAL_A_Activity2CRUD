CREATE DATABASE IF NOT EXISTS activity2crud;
USE activity2crud;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    password TEXT
);

-- Optional: Add default admin user (username: admin, password: admin123)
INSERT INTO users (first_name, last_name, username, password)
VALUES ('Admin', 'User', 'admin', 'admin123');