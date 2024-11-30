CREATE OR REPLACE USER 'db_user'@'localhost' IDENTIFIED BY 'password';

CREATE OR REPLACE DATABASE sugarrush;

GRANT SELECT, ALTER, CREATE,CREATE VIEW, DELETE, INDEX, INSERT, REFERENCES, SELECT, SHOW VIEW, TRIGGER, UPDATE, DROP on sugarrush.* to 'db_user'@'localhost';

USE sugarrush;

CREATE TABLE products (
    ProductID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ProductBrand varchar(255) NOT NULL,
    ProductName varchar(255) NOT NULL,
    ProductCategory varchar(255) NOT NULL,
    ProductImage varchar(255) NOT NULL,
    ProductWeight int NOT NULL,
    ProductPrice decimal(8, 2) NOT NULL,
    InStock bit NOT NULL
);

/*
SweetCategory will be used in product filtering.
--Integer values in 'SweetWeight' represent grams, or milliliters when the product is a drink.
--Stock quantity may be implemented here. For now, a boolean '1' or '0' is used.
--InStock '1' = sufficient stock to order.
InStock '0' = insufficient stock to order.
*/

INSERT INTO products (ProductBrand, ProductName, ProductCategory, ProductImage, ProductWeight, ProductPrice, InStock)
VALUES
('Haribo', 'Starmix', 'Sweets', 'images/Sweets/Haribo-Starmix.avif',175, 1.25, 1),
('Maynards Bassetts', 'Wine Gums', 'Sweets', 'images/Sweets/Maynards-Bassetts-Wine-Gums.avif', 130, 1.35, 1),
('Swizzels', 'Squashies', 'Sweets', 'images/Sweets/Swizzels-Squashies.avif', 140, 0.99, 1),
('Cadbury', 'Dairy Milk Buttons', 'Chocolate', 'images/Chocolate/Cadbury-Dairy-Milk-Buttons.avif', 119, 1.75, 1),
('Maynards Bassetts', 'Sherbet Lemons', 'Sweets','images/Sweets/Maynards-Bassetts-Sherbet-Lemons.webp', 192, 1.52, 1),
('Galaxy', 'Galaxy Cookies', 'Biscuits', 'images/Biscuits/Galaxy-Cookies.avif', 180, 1.35, 1),
('Oreo''s', 'Oreo Vanilla', 'Biscuits', 'images/Biscuits/Oreos.avif', 154, 0.90, 1),
('Cadbury', 'Dairy Milk', 'Chocolate', 'images/Chocolate/Dairy-Milk.avif', 180, 2.50, 1),
('Hersheys', 'Hershey''s Cookies N Creme', 'Chocolate', 'images/Chocolate/Hersheys-Cookies-N-Creme.webp', 90, 1.25, 1),
('Kinder', 'Kinder Bueno', 'Chocolate', 'images/Chocolate/Kinder-Bueno.avif', 43, 2.39, 1),
('Lindt', 'Lindt Chocolate', 'Chcolate', 'images/Chocolate/Lindt-Chocolate.avif', 100, 3.00, 1),
('Malteasers', 'Malteasers', 'Chocolate', 'images/Chocolate/Maltesers.avif', 214, 4.00, 1),
('Monster', 'Monster Energy', 'Drinks', 'images/Drinks/Monster.avif', 500, 1.90, 1),
('Red Bull', 'Red Bull Energy Drink', 'Drinks', 'images/Drinks/Red-Bull.avif', 355, 2.00, 1),
('Jacob''s', 'Mini Cheddars', 'Savoury', 'images/Savoury/Mini-Cheddars.avif', 138, 1.75, 1),
('Pringles', 'Pringles Original', 'Savoury', 'images/Savoury/Pringles.avif', 40, 1, 1),
('Kellog''s', 'Gooey Marshmallow Squares', 'Biscuits', 'images/Biscuits/Squares.avif', 144, 2.25, 1),
('Walkers', 'Ready Salted Walkers', 'Savoury', 'images/Savoury/Walkers.avif', 150, 2.00, 1),
('Rowntrees', 'Fruit Pastilles', 'Sweets', 'images/Sweets/Fruit-Pastilles.avif', 143, 1.50, 1),
('Skittles', 'Fruit Skittles', 'Sweets', 'images/Sweets/Skittles.avif', 143, 1.50, 1),
('Skittles', 'Sour Skittles', 'Sweets', 'images/Sweets/Sour-Skittles.avif', 143, 1.50, 1),
('Maynards Bassetts', 'Liquorice Allsorts', 'Sweets', 'images/Sweets/Maynards-Liqourice-Allsorts.avif', 350, 2.75, 1),
('McVitie''s', 'Jaffa Cakes', 'Biscuits', 'images/Biscuits/Jaffa-Cakes.avif', 220, 2.00, 1),
('Lotus', 'Lotus Biscoff', 'Biscuits', 'images/Biscuits/Lotus-Biscoff.avif', 220, 3.00, 1),
('McVitie''s', 'McVitie''s Digestives', 'Biscuits', 'images/Biscuits/Mcvities-Digestives.avif', 400, 3.00, 1),
('McVitie''s', 'McVitie''s Rich Tea Biscuits', 'Biscuits', 'images/Biscuits/Mcvities-Rich-Tea.avif', 400, 3.00, 1),
('Cadbury', 'Cadbury Boost', 'Chocolate', 'images/Chocolate/Cadbury-Boost.avif', 180, 2.25, 1),
('Cadbury', 'Flake', 'Chocolate', 'images/Chocolate/Cadbury-Flake.avif', 180, 2.25, 1),
('KitKat', 'KitKat Chunky', 'Chocolate', 'images/Chocolate/KitKat-Chunky.avif', 110, 2.25, 1),
('Nestle', 'Nestle After Eight', 'Chocolate', 'images/Chocolate/Nestle-After-Eight.avif', 200, 2.80, 1),
('Terry''s', 'Terry''s Chcolate Orange', 'Chcolate', 'images/Chocolate/Terrys-Chocolate-Orange.avif', 300, 1.80, 1),
('Robinsons', 'Fruit Shoot Apple and Blackcurrent', 'Drinks', 'images/Drinks/Fruit-Shoot-Apple-Blackcurrent.avif', 400, 1.80, 1),
('Tango', 'Tango Orange', 'Drinks', 'images/Drinks/Tango-Orange.avif', 400, 1.80, 1),
('Dairylea', 'Dairylea Dunkers', 'Savoury', 'images/Savoury/Dairylea-Dunkers.avif', 200, 1.20, 1),
('Doritos', 'Doritos Chilli Heatwave','Savoury', 'images/Savoury/Doritos-Chilli-Heatwave.avif', 200, 1.50, 1),
('Haribo', 'Haribo Supermix', 'Sweets', 'images/Sweets/Haribo-Supermix.avif', 180, 1.50, 1),
('Haribo', 'Haribo Tangfastics', 'Sweets', 'images/Sweets/Haribo-Tangfastics.avif', 180, 1.50, 1),
('Nerds', 'Nerds Gummy Clusters', 'Sweets', 'images/Sweets/Nerds-Gummy-Clusters.avif', 200, 1.70, 1),
('Rowntrees', 'Rowntrees Randoms', 'Sweets', 'images/Sweets/Rowntrees-Randoms.avif', 300, 1.70, 1),
('Sugar Rush', 'Sour Sweets Mix 1kg', 'Mix', 'images/Mix/Sour-Mix.jpg', 1000, 9.00, 1),
('Sugar Rush', 'Hard Sweets Mix 1kg', 'Mix', 'images/Mix/Hard-Sweets.jpg', 1000, 9.00, 1),
('Sugar Rush', 'Liquorice Sweets Mix 1kg', 'Mix', 'images/Mix/Liquorice-Mix.png', 1000, 9.00, 1);


CREATE TABLE product_descriptions (
    DescriptionID int NOT NULL PRIMARY KEY,
    DescriptionContent varchar(255),
    CONSTRAINT fk_product_association
        FOREIGN KEY (DescriptionID)
        REFERENCES products (ProductID)
        ON DELETE CASCADE
);

INSERT INTO product_descriptions (DESCRIPTIONID, DESCRIPTIONCONTENT)
VALUES
(1, "Test Description");

/* CREATION OF USER ACCOUNTS TABLE */

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 01:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

/*
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugarrush`
--

-- --------------------------------------------------------

--
-- Table structure for table `userid`
--

CREATE TABLE userid (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(30) NOT NULL,
    lastname varchar(30) NOT NULL,
    email varchar(75) NOT NULL,
    password varchar(75) NOT NULL,
    admin tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userid`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



