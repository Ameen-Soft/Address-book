CREATE DATABASE IF NOT EXISTS `Address-book` 
USE `Address-book`;

CREATE TABLE IF NOT EXISTS `contacts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `full_name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20),
    `email` VARCHAR(100),
    `address` VARCHAR(255),
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contacts` (`full_name`, `phone`, `email`, `address`, `notes`) VALUES
('Ahmed Ali', '777123456', 'ahmed@example.com', 'Sana\'a, Yemen', 'Friend from school'),
('Fatima Saleh', '777654321', 'fatima@example.com', 'Taiz, Yemen', 'Colleague at work');
