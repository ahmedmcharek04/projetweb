<?php
// controllers/HomeController.php

class HomeController {
    public function index() {
        // Charge la vue publique d'accueil
        require_once 'views/front/home.php';
    }
}
