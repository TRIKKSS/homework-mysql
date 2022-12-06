CREATE DATABASE IF NOT EXISTS mediatheque;
USE mediatheque;

CREATE TABLE IF NOT EXISTS users(id_users INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_users), nom VARCHAR(100), prenom VARCHAR(100), email VARCHAR(100), password VARCHAR(128) /*size of sha512 hash*/, addresse VARCHAR(100), tel VARCHAR(100), admin BOOLEAN);
CREATE TABLE IF NOT EXISTS categorie(id_categorie INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_categorie), nom_categorie VARCHAR(100));
CREATE TABLE IF NOT EXISTS realisateur(id_realisateur INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_realisateur), nom_realisateur VARCHAR(100), prenom_realisateur VARCHAR(100), nationalite_realisateur VARCHAR(100), annee_naissance INT);
CREATE TABLE IF NOT EXISTS film(id_film INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_film), nom_film VARCHAR(100), annee_film INT, description VARCHAR(4096), id_realisateur INT, FOREIGN KEY(id_realisateur) REFERENCES realisateur(id_realisateur), id_categorie INT, FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie));
CREATE TABLE IF NOT EXISTS emprunt(id_emprunt INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id_emprunt), id_film INT, FOREIGN KEY(id_film) REFERENCES film(id_film), id_users INT, FOREIGN KEY(id_users) REFERENCES users(id_users), date_emprunt DATE, date_retour DATE);

-- insert an administrator account

INSERT INTO users(nom, prenom, email, password, addresse, tel, admin)
VALUES("Sylvain", "Durif", "sylvain.durif@cat.com", "12e92ecc3d2ef29462c93bbab18f5b50513c5492d9fe205d23d9a97d6976fd2109cac9ef903981bc50136e59cfdf762047e19154308b085abfa66663529c4a33", "30 rue de la flemme 1337 hackerland", "13 37 13 37 13", True);


-- INSERT CATEGORIES

INSERT INTO categorie(nom_categorie) VALUES("action");
INSERT INTO categorie(nom_categorie) VALUES("aventure");
INSERT INTO categorie(nom_categorie) VALUES("romantique");
INSERT INTO categorie(nom_categorie) VALUES("famille");
INSERT INTO categorie(nom_categorie) VALUES("comedie");
INSERT INTO categorie(nom_categorie) VALUES("anime");
INSERT INTO categorie(nom_categorie) VALUES("drame");
INSERT INTO categorie(nom_categorie) VALUES("horreur");
INSERT INTO categorie(nom_categorie) VALUES("enfant");
INSERT INTO categorie(nom_categorie) VALUES("policier");



-- INSERT REALISATEUR

INSERT INTO realisateur(nom_realisateur, prenom_realisateur, nationalite_realisateur, annee_naissance)
VALUES("FEE", "Brian", "American", 1975);

-- INSERT FILM 

INSERT INTO film(nom_film, annee_film, description, id_realisateur, id_categorie)
VALUES("cars 3", 2017, "Cars 3 is a 2017 American computer-animated sports comedy-adventure film produced by Pixar Animation Studios and released by Walt Disney Pictures.", (select id_realisateur from realisateur where prenom_realisateur="Brian" and nom_realisateur="FEE"), (select id_categorie from categorie where nom_categorie="comedie") );



-- INSERT REALISATEUR

INSERT INTO realisateur(nom_realisateur, prenom_realisateur, nationalite_realisateur, annee_naissance)
VALUES("WAN", "James", "Australian", 1977);

-- INSERT FILM 

INSERT INTO film(nom_film, annee_film, description, id_realisateur, id_categorie)
VALUES("Fast and Furious 7", 2015, "Furious 7 (also called Fast and Furious 7) is a 2015 American action film directed by James Wan and written by Chris Morgan. It is the sequel to Fast & Furious 6, and serves as the seventh installment in the Fast & Furious franchise.", (select id_realisateur from realisateur where prenom_realisateur="James" and nom_realisateur="WAN"), (select id_categorie from categorie where nom_categorie="action") );
