-- Création de la base de données
CREATE DATABASE IF NOT EXISTS alibabouche CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Utilisation de la base
USE alibabouche;

-- Création de la table 'produits'
CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie VARCHAR(30) NOT NULL,
    image VARCHAR(255),
    prix DECIMAL(10,2) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    caracteristique TEXT,
    note DECIMAL(2,1) UNSIGNED
);
