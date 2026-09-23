
CREATE DATABASE IF NOT EXISTS vite_et_gourmand
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE vite_et_gourmand;

CREATE TABLE theme
(
    theme_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50)
);

CREATE TABLE regime
(
    regime_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50)
);
CREATE TABLE menus
(
    menu_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(100) NOT NULL,
    nombre_personne_minimum INT NOT NULL,
    prix_par_personne DECIMAL(6,2) NOT NULL,
    regime_id INT NOT NULL,
    theme_id INT NOT NULL,
    description VARCHAR(100) NOT NULL,
    quantite_restante INT NOT NULL,
    conditions_menu VARCHAR(100),
    FOREIGN KEY (regime_id)
      REFERENCES regime(regime_id),
    FOREIGN KEY (theme_id)
      REFERENCES theme(theme_id)
);
CREATE TABLE statut_avis
(
    statut_avis_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE avis
(
    avis_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    note INT NOT NULL,
    commentaire VARCHAR(255),
    statut_avis_id INT NOT NULL,
    FOREIGN KEY (statut_avis_id)
      REFERENCES statut_avis(statut_avis_id)
);
CREATE TABLE allergene
(
allergene_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
libelle VARCHAR (50)
);

Create TABLE plat_categorie
(
    plat_categorie_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE plat
(
plat_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
titre varchar(50) NOT NULL,
photo VARCHAR(50) NOT NULL,
plat_categorie_id INT NOT NULL,
FOREIGN KEY (plat_categorie_id)
REFERENCES plat_categorie(plat_categorie_id)
);

CREATE TABLE rel_plat_allergene
(
rel_plat_allergene_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
plat_id INT NOT NULL,
allergene_id INT NOT NULL,

FOREIGN KEY (plat_id)
REFERENCES plat(plat_id),
FOREIGN KEY (allergene_id)
REFERENCES allergene(allergene_id)
);

CREATE TABLE jours 
(
    jours_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(10) NOT NULL
);

CREATE Table horaire 
(
    horaire_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    jours_id INT NOT NULL,
    horaire_ouverture VARCHAR(10),
    horaire_fermeture VARCHAR(10),
    Foreign Key (jours_id) 
    REFERENCES jours(jours_id)
);

Create Table roles
(
 roles_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 libelle VARCHAR(50)
);

create table utilisateur
(
    utilisateur_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    telephone VARCHAR(50) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    pays VARCHAR(50) NOT NULL,
    addresse_postale VARCHAR(100),
    roles_id INT NOT NULL,
    code_postal VARCHAR(5) NOT NULL,
    Foreign Key (roles_id) 
    REFERENCES roles(roles_id)
);

