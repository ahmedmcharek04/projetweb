<?php
// models/Exercice.php
require_once 'Database.php';

class Exercice {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        // Optionnel : faire un LEFT JOIN pour obtenir le nom de l'activité
        $stmt = $this->db->query("
            SELECT e.*, a.nom AS activite_nom 
            FROM exercices e 
            LEFT JOIN activites_sportives a ON e.activite_id = a.id 
            ORDER BY e.nom ASC
        ");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM exercices WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($nom, $description, $url_video, $difficulte, $activite_id) {
        $stmt = $this->db->prepare("INSERT INTO exercices (nom, description, url_video, difficulte, activite_id) VALUES (:nom, :description, :url_video, :difficulte, :activite_id)");
        return $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'url_video' => $url_video,
            'difficulte' => $difficulte,
            'activite_id' => $activite_id ?: null
        ]);
    }

    public function update($id, $nom, $description, $url_video, $difficulte, $activite_id) {
        $stmt = $this->db->prepare("UPDATE exercices SET nom = :nom, description = :description, url_video = :url_video, difficulte = :difficulte, activite_id = :activite_id WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
            'url_video' => $url_video,
            'difficulte' => $difficulte,
            'activite_id' => $activite_id ?: null
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM exercices WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Récupérer les exercices directement liés à une activité (via la clé étrangère)
    public function getByActivite($activite_id) {
        $stmt = $this->db->prepare("SELECT * FROM exercices WHERE activite_id = :activite_id");
        $stmt->execute(['activite_id' => $activite_id]);
        return $stmt->fetchAll();
    }
}
