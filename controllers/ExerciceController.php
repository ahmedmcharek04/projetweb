<?php
// controllers/ExerciceController.php
require_once 'models/Exercice.php';
require_once 'models/ActiviteSportive.php'; // Pour la liste déroulante

class ExerciceController {
    private $model;
    private $activiteModel;

    public function __construct() {
        $this->model = new Exercice();
        $this->activiteModel = new ActiviteSportive();
    }

    public function index() {
        $activite_id = $_GET['activite_id'] ?? null;
        
        if ($activite_id) {
            // Affiche uniquement les exercices de cette activité
            $exercices = $this->model->getByActivite($activite_id);
            $activite = $this->activiteModel->getById($activite_id);
        } else {
            // Fallback: Affiche tout si on ne vient pas d'une carte activité
            $exercices = $this->model->getAll();
            $activite = ['id' => '', 'nom' => 'Tous les exercices confondus'];
        }
        require_once 'views/exercices/index.php';
    }

    public function create() {
        $activites = $this->activiteModel->getAll(); // Remplir le select
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $url_video = trim($_POST['url_video'] ?? '');
            $difficulte = trim($_POST['difficulte'] ?? '');
            $activite_id = $_POST['activite_id'] ?? null;

            if (empty($nom)) {
                $errors[] = "Le nom de l'exercice est requis.";
            }

            if (!empty($url_video) && !filter_var($url_video, FILTER_VALIDATE_URL)) {
                $errors[] = "Le lien vidéo n'est pas une URL valide.";
            }

            if (empty($errors)) {
                $this->model->create($nom, $description, $url_video, $difficulte, $activite_id);
                header('Location: index.php?c=exercice&action=index');
                exit();
            }
        }
        require_once 'views/exercices/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?c=exercice&action=index');
            exit();
        }

        $exercice = $this->model->getById($id);
        if (!$exercice) {
            die("Exercice introuvable.");
        }

        $activites = $this->activiteModel->getAll(); // Remplir le select
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $url_video = trim($_POST['url_video'] ?? '');
            $difficulte = trim($_POST['difficulte'] ?? '');
            $activite_id = $_POST['activite_id'] ?? null;

            if (empty($nom)) {
                $errors[] = "Le nom de l'exercice est requis.";
            }

            if (!empty($url_video) && !filter_var($url_video, FILTER_VALIDATE_URL)) {
                $errors[] = "Le lien vidéo n'est pas une URL valide.";
            }

            if (empty($errors)) {
                $this->model->update($id, $nom, $description, $url_video, $difficulte, $activite_id);
                header('Location: index.php?c=exercice&action=index');
                exit();
            }
        }
        require_once 'views/exercices/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header('Location: index.php?c=exercice&action=index');
        exit();
    }
}
