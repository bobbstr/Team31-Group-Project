CREATE DATABASE Products;

USE Products;

CREATE TABLE Sweets (
    SweetID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    SweetBrand varchar(255) NOT NULL,
    SweetName varchar(255) NOT NULL,
    SweetCategory varchar(255) NOT NULL,
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

INSERT INTO Sweets (SweetBrand, SweetName, SweetCategory, SweetWeight, SweetPrice, InStock)
VALUES
('Haribo', 'Starmix', 'Chewy',175, 1.25, 1),
('Maynards Bassetts', 'Wine Gums', 'Chewy', 130, 1.35, 1),
('Swizzels', 'Squashies', 'Chewy', 140, 0.99, 1),
('Cadbury', 'Dairy Milk Buttons', 'Chocolate', 119, 1.75, 1),
('Maynards Bassetts', 'Sherbet Lemons', 'Hard', 192, 1.52, 1)




