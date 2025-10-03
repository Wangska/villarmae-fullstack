-- NFT Collection Database Schema
-- This file contains the complete database structure for the NFT web application

-- Create database (uncomment if needed)
-- CREATE DATABASE IF NOT EXISTS `default` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `default`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- NFTs table
CREATE TABLE IF NOT EXISTS `nfts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `image_url` VARCHAR(500),
    `price` DECIMAL(10,2),
    `token_id` VARCHAR(100),
    `contract_address` VARCHAR(100),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create indexes for better performance
CREATE INDEX IF NOT EXISTS `idx_users_username` ON `users`(`username`);
CREATE INDEX IF NOT EXISTS `idx_users_email` ON `users`(`email`);
CREATE INDEX IF NOT EXISTS `idx_nfts_user_id` ON `nfts`(`user_id`);
CREATE INDEX IF NOT EXISTS `idx_nfts_created_at` ON `nfts`(`created_at`);

-- Insert sample data (optional - remove if not needed)
-- INSERT INTO `users` (`username`, `email`, `password`) VALUES 
-- ('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
-- ('demo', 'demo@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- INSERT INTO `nfts` (`user_id`, `name`, `description`, `image_url`, `price`, `token_id`, `contract_address`) VALUES 
-- (1, 'Sample NFT #1', 'This is a sample NFT for demonstration purposes.', 'https://via.placeholder.com/300x300/667eea/ffffff?text=NFT+1', 0.5, '1', '0x1234567890123456789012345678901234567890'),
-- (1, 'Sample NFT #2', 'Another sample NFT with different properties.', 'https://via.placeholder.com/300x300/764ba2/ffffff?text=NFT+2', 1.0, '2', '0x1234567890123456789012345678901234567890');
