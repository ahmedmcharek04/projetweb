<?php
require_once 'config.php';
require_once 'models/Database.php';
try {
    $db = Database::getInstance()->getConnection();

    // 1. Table for Calendar (Emploi du temps)
    $sql1 = "CREATE TABLE IF NOT EXISTS seances_programmees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT DEFAULT 1,
        activite_id INT,
        jour_semaine VARCHAR(20),
        heure_debut TIME,
        statut VARCHAR(50) DEFAULT 'En attente',
        FOREIGN KEY (activite_id) REFERENCES activites_sportives(id) ON DELETE CASCADE
    )";
    $db->exec($sql1);

    // 2. Table for Performance Tracking
    $sql2 = "CREATE TABLE IF NOT EXISTS historique_performances (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT DEFAULT 1,
        exercice_id INT,
        date_seance DATETIME,
        duree_minutes INT,
        progression VARCHAR(100),
        FOREIGN KEY (exercice_id) REFERENCES exercices(id) ON DELETE CASCADE
    )";
    $db->exec($sql2);

    echo "Tables created successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
