<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriMind AI - Recommandations Durables</title>
    <!-- Mêmes Polices Modernes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>views/style_front.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <span class="leaf-icon">🌿</span> NutriMind <span class="accent">AI</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php?c=home">Accueil</a></li>
                <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                <li><a href="#equipe">Notre Équipe</a></li>
                <li><a href="index.php?c=activite" class="btn-login">Accès BackOffice</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Contenu injecté depuis les vues front -->
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> NutriMind AI - Projet Académique.</p>
    </footer>
</body>
</html>
