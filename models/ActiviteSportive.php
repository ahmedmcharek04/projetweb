<?php
// models/ActiviteSportive.php
require_once 'Database.php';

class ActiviteSportive {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM activites_sportives ORDER BY nom ASC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM activites_sportives WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($nom, $description, $categorie) {
        $stmt = $this->db->prepare("INSERT INTO activites_sportives (nom, description, categorie) VALUES (:nom, :description, :categorie)");
        return $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'categorie' => $categorie
        ]);
    }

    public function update($id, $nom, $description, $categorie) {
        $stmt = $this->db->prepare("UPDATE activites_sportives SET nom = :nom, description = :description, categorie = :categorie WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
            'categorie' => $categorie
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM activites_sportives WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
