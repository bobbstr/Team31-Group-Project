CREATE OR REPLACE USER 'db_user'@'localhost' IDENTIFIED BY 'password';

CREATE OR REPLACE DATABASE sugarRush;

GRANT SELECT,ALTER,CREATE,CREATE VIEW, DELETE, INDEX, INSERT, REFERENCES, SELECT, SHOW VIEW, TRIGGER, UPDATE on sugarRush.* to 'db_user'@'localhost';

USE sugarRush;

CREATE TABLE Products (
    SweetID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    SweetBrand varchar(255) NOT NULL,
    SweetName varchar(255) NOT NULL,
    SweetCategory varchar(255) NOT NULL,
    SweetImage varchar(255) NOT NULL,
    SweetWeight int NOT NULL,
    SweetPrice decimal(8, 2) NOT NULL,
    InStock bit NOT NULL
);

/*
SweetCategory will be used in product filtering.
--Integer values in 'SweetWeight' represent grams.
--Stock quantity may be implemented here. For now, a boolean '1' or '0' is used.
--InStock '1' = sufficient stock to order.
InStock '0' = insufficient stock to order.
*/

INSERT INTO Products (SweetBrand, SweetName, SweetCategory, SweetImage, SweetWeight, SweetPrice, InStock)
VALUES
('Haribo', 'Starmix', 'Chewy', 'images/Haribo-Starmix.avif',175, 1.25, 1),
('Maynards Bassetts', 'Wine Gums', 'Chewy', 'images/MaynardsBassetts-Wine-Gums.avif', 130, 1.35, 1),
('Swizzels', 'Squashies', 'Chewy', 'images/Swizzels-Squashies.avif', 140, 0.99, 1),
('Cadbury', 'Dairy Milk Buttons', 'Chocolate', 'images/Cadbury-Dairy-Milk-Buttons.avif', 119, 1.75, 1),
('Maynards Bassetts', 'Sherbet Lemons', 'Hard','images/Maynards-Bassets-Sherbet-Lemons.webp', 192, 1.52, 1);




