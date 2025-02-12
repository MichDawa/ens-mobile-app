CREATE DATABASE IF NOT EXISTS ens_mobile_app;
USE ens_mobile_app;

-- Dumping structure for table ens_mobile_app.user_login
CREATE TABLE IF NOT EXISTS `user_login` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_username` (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;