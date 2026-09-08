-- Run this inside your EXISTING database in phpMyAdmin (Laragon).
-- Open phpMyAdmin -> select your database -> SQL tab -> paste this -> Go.
-- It only creates the "products" table required by Laboratory Exercise No. 5.

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

-- Optional sample data so the list page isn't empty on first run.
INSERT INTO products (product_name, description, price, quantity) VALUES
    ('Wireless Mouse', 'Ergonomic 2.4GHz wireless mouse', 349.00, 120),
    ('Mechanical Keyboard', 'Hot-swappable mechanical keyboard, blue switches', 1899.00, 45),
    ('USB-C Hub', '7-in-1 USB-C hub with HDMI and card reader', 899.50, 60);
