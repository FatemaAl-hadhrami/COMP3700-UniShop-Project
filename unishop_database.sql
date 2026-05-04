-- =====================================================
-- UniShop Database — Full Setup Script
-- =====================================================

-- Create and select the database
CREATE DATABASE IF NOT EXISTS unishop;
USE unishop;

-- =====================================================
-- TABLE 1: products
-- Corresponds to the Product JavaScript object
-- =====================================================
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id       INT(6)       NOT NULL AUTO_INCREMENT,
    name     VARCHAR(100) NOT NULL,
    price    DECIMAL(8,3) NOT NULL,
    category VARCHAR(50)  NOT NULL,
    stock    INT(5)       NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

INSERT INTO products (name, price, category, stock) VALUES
('Ballpoint Pens (pack)',              0.650, 'Academic', 200),
('Single Notebook (140 pages)',        0.800, 'Academic', 150),
('Pack of 4 Notebooks (200 pages)',    1.200, 'Academic',  80),
('fx-9911ES PLUS Calculator',          4.000, 'Academic',  45),
('fx-82ES PLUS Calculator',            2.150, 'Academic',  60),
('Web Computing Study Notes',          0.300, 'Academic', 300),
('Gray Backpack',                      1.000, 'Academic',  35),
('Black Laptop Bag (15.6")',           1.000, 'Academic',  28),
('Brown Tote Bag',                     0.900, 'Academic',  50),
('Lab Coat (White)',                  15.000, 'Medical',   40),
('Safety Goggles',                     2.500, 'Medical',   90),
('Latex Gloves (box of 100)',          3.200, 'Medical',   75),
('Stethoscope',                       18.000, 'Medical',   20),
('Surgical Mask (box of 50)',          2.000, 'Medical',  120),
('Medical Scrubs (Set)',              12.500, 'Medical',   30),
('Disposable Syringe (pack of 10)',    1.800, 'Medical',   55);

-- =====================================================
-- TABLE 2: orders
-- Corresponds to the Order JavaScript object
-- =====================================================
DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
    id               INT(6)       NOT NULL AUTO_INCREMENT,
    order_number     VARCHAR(20)  NOT NULL UNIQUE,
    customer_name    VARCHAR(100) NOT NULL,
    email            VARCHAR(100) NOT NULL,
    order_date       DATE         NOT NULL,
    status           VARCHAR(30)  NOT NULL DEFAULT 'Confirmed',
    total_amount     DECIMAL(8,3) NOT NULL,
    delivery_address VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO orders (order_number, customer_name, email, order_date, status, total_amount, delivery_address) VALUES
('USQ-20260019', 'Ahmed Al-Rashdi',   'ahmed@squ.edu.om',   '2026-03-18', 'Out for Delivery', 24.900, 'Sultan Qaboos University, Muscat'),
('USQ-20260020', 'Fatima Al-Balushi', 'fatima@squ.edu.om',  '2026-03-20', 'Confirmed',         8.650, 'College of Science, SQU'),
('USQ-20260021', 'Mohammed Al-Zaabi', 'mohammed@squ.edu.om','2026-03-22', 'Shipped',           33.200, 'College of Medicine, SQU'),
('USQ-20260022', 'Laila Al-Harthi',   'laila@squ.edu.om',   '2026-03-25', 'Delivered',         15.750, 'Student Housing, SQU'),
('USQ-20260023', 'Khalid Al-Farsi',   'khalid@squ.edu.om',  '2026-03-28', 'Confirmed',         22.400, 'College of Engineering, SQU');

-- =====================================================
-- TABLE 3: wishlist
-- Corresponds to the WishlistItem JavaScript object
-- =====================================================
DROP TABLE IF EXISTS wishlist;

CREATE TABLE wishlist (
    id        INT(6)       NOT NULL AUTO_INCREMENT,
    item_name VARCHAR(100) NOT NULL,
    price     DECIMAL(8,3) NOT NULL,
    category  VARCHAR(50)  NOT NULL,
    PRIMARY KEY (id)
);



-- =====================================================
-- TABLE 4: bills  (INSERT target for calculator page)
-- =====================================================
DROP TABLE IF EXISTS bills;

CREATE TABLE bills (
    id              INT(6)       NOT NULL AUTO_INCREMENT,
    subtotal        DECIMAL(8,3) NOT NULL,
    discount_pct    DECIMAL(5,2) NOT NULL DEFAULT 0,
    discount_amount DECIMAL(8,3) NOT NULL DEFAULT 0,
    delivery_fee    DECIMAL(8,3) NOT NULL,
    vat             DECIMAL(8,3) NOT NULL,
    total           DECIMAL(8,3) NOT NULL,
    age             INT(3),
    delivery_option VARCHAR(50),
    created_at      TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO bills (subtotal, discount_pct, discount_amount, delivery_fee, vat, total, age, delivery_option) VALUES
(23.000, 10.00, 2.300, 1.500, 1.035, 23.235, 22, 'Standard Delivery'),
(15.000,  0.00, 0.000, 0.000, 0.750, 15.750, 30, 'Campus Pickup'),
( 8.650, 15.00, 1.298, 3.000, 0.368,  9.720, 63, 'Express Delivery'),
(33.200, 10.00, 3.320, 1.500, 1.494, 32.874, 21, 'Standard Delivery'),
( 4.000,  5.00, 0.200, 1.500, 0.190,  5.490, 24, 'Standard Delivery');

-- =====================================================
-- TABLE 5: messages  (INSERT target for contact us page)
-- =====================================================
DROP TABLE IF EXISTS messages;

CREATE TABLE messages(
    id              INT(6)        NOT NULL AUTO_INCREMENT, 
    email           VARCHAR(100)  NOT NULL,
    user            VARCHAR(100)  NOT NULL,
    phone           VARCHAR(8)    NOT NULL,
    request         VARCHAR(200)  NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO messages (email, user, phone, request) VALUES
('reem@squ.edu.om', 'Reem al-Hinai', 98765432, 'I would like a refund'),
('ahmed@squ.edu.om', 'Ahmed al-Balushi', 01010101, 'How many locations do you deliver to?'),
('malak@squ.edu.om', 'Malak al-Amri', 12345678, 'I want to change the delivery time'),
('abdelrahman@squ.edu.om', 'Abdelrahman al Harthi', 12341234, 'Thank you for the swift delivery.'),
('khadija@squ.edu.om', 'Khadija al-Hashmi', 33334444, 'I missed the delivery time. Can I pick it up from somewhere else?');

-- =====================================================
-- TABLE 6: responses  (INSERT target for questionnaire page)
-- =====================================================
DROP TABLE IF EXISTS responses;

CREATE TABLE responses(
    id                  INT(6)          NOT NULL AUTO_INCREMENT,
    email               VARCHAR(100)    NOT NULL,
    name                VARCHAR(100)    NOT NULL,
    job                 VARCHAR(20)     NOT NULL,
    gender              VARCHAR(20)     NOT NULL,
    age_group           VARCHAR(10)     NOT NULL,
    sources             VARCHAR(200),
    layout_rating       VARCHAR(10)     NOT NULL,
    navigation_rating   VARCHAR(10)     NOT NULL,
    design_rating       VARCHAR(10)     NOT NULL,
    product_rating      VARCHAR(10)     NOT NULL,
    delivery_rating     VARCHAR(10)     NOT NULL,
    services_rating     VARCHAR(10)     NOT NULL,
    comment             VARCHAR(255),
    PRIMARY KEY (id)
);

INSERT INTO responses(email, name, job, gender, age_group, sources, layout_rating, navigation_rating, design_rating, product_rating, delivery_rating, services_rating, comment) VALUES
('reem@squ.edu.om', 'Reem Al Hinai', 'Student', 'Female', '18-25', 'Friends & Family, Social Media', 'Very Good', 'Good', 'Very Good', 'Good', 'Very Good', 'Very Good', 'Great website!'),
('ahmed@squ.edu.om', 'Ahmed Al Balushi', 'Student', 'Male', '18-25', '', 'Good', 'Good', 'Good', 'Neutral', 'Good', 'Good', 'Good but can improve navigation'),
('malak@squ.edu.om', 'Malak Al Amri', 'Academic Staff', 'Female', '25-40', 'Advertisement', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Excellent experience'),
('abdelrahman@squ.edu.om', 'Abdelrahman Al Harthi', 'Student', 'Male', '18-25', 'Friends & Family', 'Neutral', 'Neutral', 'Good', 'Neutral', 'Neutral', 'Neutral', 'Average service'),
('khadija@squ.edu.om', 'Khadija Al Hashmi', 'Academic Staff', 'Female', '25-40', 'Event', 'Good', 'Very Good', 'Good', 'Good', 'Very Good', 'Good', 'Very satisfied overall');

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    college VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (fullname, username, phone, password, college)
VALUES 
('Ali Ahmed', 'ali1', '96891234567', '123456', 'Engineering'),
('Sara Ali', 'sara2', '96899887766', 'abc123', 'Science'),
('Omar Khalid', 'omar3', '96891122334', 'pass123', 'Medicine'),
('Noor Salem', 'noor4', '96890011223', '123abc', 'Engineering'),
('Huda Nasser', 'huda5', '96895566778', 'huda123', 'Science');
-- =====================================================
-- Verify all tables
-- =====================================================
SELECT 'products' AS tbl, COUNT(*) AS total FROM products
UNION ALL
SELECT 'orders',   COUNT(*) FROM orders
UNION ALL
SELECT 'wishlist', COUNT(*) FROM wishlist
UNION ALL
SELECT 'bills',    COUNT(*) FROM bills
UNION ALL
SELECT 'messages',  COUNT(*) FROM messages
UNION ALL
SELECT 'responses', COUNT(*) FROM responses;
UNION ALL
SELECT 'users',    COUNT(*) FROM users;
