<?php ob_start(); ?>

<section class="hero">
    <div class="hero-content">
        <h1>Analyse des repas et recommandations durables</h1>
        <p>NutriMind AI est une plateforme web intelligente qui analyse vos repas pour fournir des recommandations nutritionnelles et un score écologique basés sur vos photos.</p>
        
        <!-- On lie le bouton vers la page d'administration (ou inscription logic) -->
        <a href="index.php?c=activite" class="btn-primary">Découvrir le projet (Accès Admin)</a>
    </div>
</section>

<section id="fonctionnalites" class="features">
    <div class="feature-card">
        <h3>Vision IA & NLP</h3>
        <p>Prenez en photo votre plat, l'intelligence artificielle analyse tous les ingrédients.</p>
    </div>
    <div class="feature-card">
        <h3>Scoring Écologique</h3>
        <p>Calcule l'empreinte CO2 et vous propose des alternatives plus vertes.</p>
    </div>
    <div class="feature-card">
        <h3>Sport & Exercices</h3>
        <p>Bénéficiez de recommandations d'exercices adaptées à vos objectifs physiques.</p>
    </div>
</section>

<?php
$content = ob_get_clean();
require 'views/layout_front.php';
?>
