<?php
// index.php
require_once 'config.php';
require_once 'models/Database.php';

// Simple Routeur
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$controller = isset($_GET['c']) ? $_GET['c'] : 'activite';

switch ($controller) {
    case 'activite':
        require_once 'controllers/ActiviteController.php';
        $ctrl = new ActiviteController();
        break;
    case 'exercice':
        require_once 'controllers/ExerciceController.php';
        $ctrl = new ExerciceController();
        break;
    default:
        die("Contrôleur introuvable.");
}

// Appeler l'action correspondante
if (method_exists($ctrl, $action)) {
    $ctrl->$action();
} else {
    // Si méthode introuvable, afficher l'index
    $ctrl->index();
}
