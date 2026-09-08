CREATE DATABASE IF NOT EXISTS crudlava_auth
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE crudlava_auth;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'moderator', 'user') NOT NULL DEFAULT 'user',
    is_active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY username_unique (username),
    UNIQUE KEY email_unique (email),
    KEY role_idx (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS refresh_tokens (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    token TEXT NOT NULL,
    expires_at DATETIME NOT NULL,
    jti TEXT NOT NULL,
    PRIMARY KEY (id),
    KEY user_id_idx (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY product_name_idx (product_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (product_name, description, price, quantity) VALUES
    ('Wireless Mouse', 'Ergonomic 2.4GHz wireless mouse', 349.00, 120),
    ('Mechanical Keyboard', 'Hot-swappable mechanical keyboard, blue switches', 1899.00, 45),
    ('USB-C Hub', '7-in-1 USB-C hub with HDMI and card reader', 899.50, 60);

-- Demo password for every account: Admin@123
-- The hash was generated with PHP password_hash(..., PASSWORD_DEFAULT).

INSERT INTO users
    (firstname, lastname, username, email, password, role, is_active)
VALUES
    ('Ana', 'Santos', 'adminlava', 'ana.santos@example.com', '$2y$10$uoQKx94kNSz/xRHMDr4ygOh04h5.CyK32LtmyP4ZZ6Y80wnEOL3oC', 'admin', 1),
    ('Ben', 'Cruz', 'bencruz', 'ben.cruz@example.com', '$2y$10$uoQKx94kNSz/xRHMDr4ygOh04h5.CyK32LtmyP4ZZ6Y80wnEOL3oC', 'moderator', 1),
    ('Carla', 'Reyes', 'carlareyes', 'carla.reyes@example.com', '$2y$10$uoQKx94kNSz/xRHMDr4ygOh04h5.CyK32LtmyP4ZZ6Y80wnEOL3oC', 'user', 1),
    ('Diego', 'Garcia', 'diegogarcia', 'diego.garcia@example.com', '$2y$10$uoQKx94kNSz/xRHMDr4ygOh04h5.CyK32LtmyP4ZZ6Y80wnEOL3oC', 'user', 1),
    ('Elena', 'Mendoza', 'elenamendoza', 'elena.mendoza@example.com', '$2y$10$uoQKx94kNSz/xRHMDr4ygOh04h5.CyK32LtmyP4ZZ6Y80wnEOL3oC', 'user', 1);