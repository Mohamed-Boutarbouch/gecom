DROP DATABASE IF EXISTS gecom;

CREATE DATABASE gecom;
USE gecom;

-- Drop tables if they exist
DROP TABLE IF EXISTS `reglement`;
DROP TABLE IF EXISTS `caissier`;
DROP TABLE IF EXISTS `client`;
DROP TABLE IF EXISTS `detail_bl`;
DROP TABLE IF EXISTS `article`;
DROP TABLE IF EXISTS `famille`;
DROP TABLE IF EXISTS `mode_reglement`;
DROP TABLE IF EXISTS `BonLivraison`;

-- Create tables
CREATE TABLE `famille` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `famille` VARCHAR(255)
);

CREATE TABLE `article` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `designation` VARCHAR(255),
    `prix_ht` DOUBLE(8, 2),
    `tva` DOUBLE(8, 2),
    `stock` INT,
    `famille_id` INT,
    FOREIGN KEY (`famille_id`) REFERENCES `famille`(`id`) ON DELETE CASCADE
);

CREATE TABLE `client` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255),
    `prenom` VARCHAR(255),
    `adresse` VARCHAR(255),
    `ville` VARCHAR(255)
);

CREATE TABLE `caissier` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255),
    `prenom` VARCHAR(255),
    `poste` VARCHAR(255),
    `admin` TINYINT(1)
);

CREATE TABLE `BonLivraison` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `date` DATE,
    `regle` TINYINT(1),
    `client_id` INT,
    `caissier_id` INT,
    FOREIGN KEY (`client_id`) REFERENCES `client`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`caissier_id`) REFERENCES `caissier`(`id`) ON DELETE CASCADE
);

CREATE TABLE `mode_reglement` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `mode` VARCHAR(255)
);

CREATE TABLE `reglement` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `date` DATE,
    `montant` DOUBLE(8, 2),
    `bl_id` INT,
    `mode_id` INT,
    FOREIGN KEY (`bl_id`) REFERENCES `BonLivraison`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`mode_id`) REFERENCES `mode_reglement`(`id`) ON DELETE CASCADE
);

CREATE TABLE `detail_bl` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `article_id` INT,
    `bl_id` INT,
    `qte` INT DEFAULT 1,
    FOREIGN KEY (`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`bl_id`) REFERENCES `BonLivraison`(`id`) ON DELETE CASCADE
);


-- Inserting data into article and BonLivraison tables
INSERT INTO famille (famille) VALUES ('Electronics'), ('Clothing');

INSERT INTO article (designation, prix_ht, tva, stock, famille_id)
VALUES ('Laptop', 1000.00, 0.20, 50, 1), ('T-Shirt', 20.00, 0.10, 100, 2);

INSERT INTO client (nom, prenom, adresse, ville)
VALUES ('John', 'Doe', '123 Main St', 'Cityville');

INSERT INTO caissier (nom, prenom, poste, admin)
VALUES ('Alice', 'Smith', 'Cashier', 1);

INSERT INTO BonLivraison (date, regle, client_id, caissier_id)
VALUES ('2023-01-01', 1, 1, 1);

INSERT INTO mode_reglement (mode) VALUES ('Cash');

INSERT INTO reglement (date, montant, bl_id, mode_id)
VALUES ('2023-01-01', 1000.00, 1, 1);

-- Inserting data into detail_bl table
INSERT INTO detail_bl (article_id, bl_id, qte)
VALUES
    (1, 1, 2),
    (2, 1, 5);
