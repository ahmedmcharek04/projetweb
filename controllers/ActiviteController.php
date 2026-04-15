<?php
// controllers/ActiviteController.php
require_once 'models/ActiviteSportive.php';
require_once 'models/Exercice.php';

class ActiviteController {
    private $model;
    private $exerciceModel;

    public function __construct() {
        $this->model = new ActiviteSportive();
        $this->exerciceModel = new Exercice();
    }

    public function index() {
        $activites = $this->model->getAll();
        require_once 'views/activites/index.php';
    }

    // CREATE, EDIT, DELETE restent inchangés
    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $categorie = trim($_POST['categorie'] ?? '');

            if (empty($nom)) {
                $errors[] = "Le nom de l'activité est requis.";
            }
            if (empty($categorie)) {
                $errors[] = "La catégorie est requise.";
            }

            if (empty($errors)) {
                $this->model->create($nom, $description, $categorie);
                header('Location: index.php?c=activite&action=index');
                exit();
            }
        }
        require_once 'views/activites/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?c=activite&action=index');
            exit();
        }

        $activite = $this->model->getById($id);
        if (!$activite) {
            die("Activité introuvable.");
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $categorie = trim($_POST['categorie'] ?? '');

            if (empty($nom)) {
                $errors[] = "Le nom de l'activité est requis.";
            }
            if (empty($categorie)) {
                $errors[] = "La catégorie est requise.";
            }

            if (empty($errors)) {
                $this->model->update($id, $nom, $description, $categorie);
                header('Location: index.php?c=activite&action=index');
                exit();
            }
        }
        require_once 'views/activites/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header('Location: index.php?c=activite&action=index');
        exit();
    }

    // Afficher les exercices associés (uniquement lecteur maintenant)
    public function exercices() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?c=activite&action=index');
            exit();
        }

        $activite = $this->model->getById($id);
        // Exercices liés avec la Foreign Key
        $linkedExercices = $this->exerciceModel->getByActivite($id);

        require_once 'views/activites/exercices.php';
    }
}
