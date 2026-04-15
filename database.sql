-- Fichier database.sql révisé : Seulement 2 tableaux

CREATE DATABASE IF NOT EXISTS projet2a32_sport CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projet2a32_sport;

CREATE TABLE IF NOT EXISTS activites_sportives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    categorie VARCHAR(100) NOT NULL
);

-- Le tableau exercices contient maintenant la clé étrangère (activite_id) = La jointure est ici
CREATE TABLE IF NOT EXISTS exercices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    url_video VARCHAR(255),
    difficulte VARCHAR(50),
    activite_id INT,
    FOREIGN KEY (activite_id) REFERENCES activites_sportives(id) ON DELETE CASCADE
);

-- Insertion de données de test
INSERT INTO activites_sportives (nom, description, categorie) VALUES
('HIIT', 'Entrainement fractionné de haute intensité', 'Perte de poids'),
('Musculation', 'Travail aux poids libres', 'Être musclé'),
('Force Athlétique', 'Méthodologie pour augmenter la force absolue', 'Force');

-- Insertion des exercices directement reliés à leur activité via activite_id
INSERT INTO exercices (nom, description, url_video, difficulte, activite_id) VALUES
('Burpees', 'Mouvement complet pour le cardio', 'https://www.youtube.com/results?search_query=burpees', 'Moyen', 1),
('Squat', 'Renforcement des jambes', 'https://www.youtube.com/results?search_query=squat', 'Difficile', 2),
('Traction', 'Renforcement du dos', 'https://www.youtube.com/results?search_query=traction', 'Difficile', 2);
