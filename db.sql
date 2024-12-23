CREATE DATABASE final_login;

USE final_login;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    otp_code VARCHAR(6) NULL;
);
CREATE TABLE uploads (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 file_path VARCHAR(255) NOT NULL,
 uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (user_id) REFERENCES users(id)
);