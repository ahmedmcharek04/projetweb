<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriMind AI - Administration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>views/style_back.css">
</head>
<body>

    <div class="dashboard-layout">
        
        <!-- Sidebar (Menu Latéral Gauche) -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                🌿 NutriMind <span class="accent">AI</span>
            </div>

            <div class="sidebar-group">
                <span>ADMINISTRATION COMMUNE</span>
                <ul>
                    <li><a href="#" class="sidebar-link">📊 Vue Globale</a></li>
                    <li><a href="#" class="sidebar-link">👥 Utilisateurs & Profils</a></li>
                </ul>
            </div>

            <div class="sidebar-group">
                <span>MODULES SPÉCIFIQUES</span>
                <ul>
                    <li><a href="#" class="sidebar-link">🍲 Repas & Recettes</a></li>
                    <li><a href="#" class="sidebar-link">📸 Analyse IA (Vision)</a></li>
                    <li><a href="#" class="sidebar-link">🌍 Scoring Écologique</a></li>
                    <!-- TON MODULE (actif) -->
                    <li><a href="index.php?c=activite" class="sidebar-link active">💪 Activités Sportives</a></li>
                    <li><a href="index.php?c=exercice" class="sidebar-link">🏃 Exercices</a></li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <div class="admin-profile">
                    <div class="avatar">AM</div>
                    <div>
                        <strong>Ahmed Mcharek</strong><br>
                        <small>Administrateur</small>
                    </div>
                </div>
                <a href="index.php?c=home" class="logout-btn">🚪 Retour au site public</a>
            </div>
        </aside>

        <!-- Contenu Principal à Droite -->
        <main class="main-content">
            
            <header class="topbar">
                <h2>Gestion des Entités</h2>
                <div class="topbar-actions">
                    <span class="notification-bell">🔔</span>
                </div>
            </header>

            <div class="content-wrapper">
                <?php
                // Affichage des erreurs globales PHP strictes
                if (!empty($errors)): ?>
                    <div class="alert alert-error slide-in">
                        <strong>Attention :</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- L'injection des CRUD se fait ici -->
                <div class="fade-in">
                    <?php echo $content; ?>
                </div>
            </div>
            
        </main>

    </div>

    <script src="<?= BASE_URL ?? '/projet2a32/' ?>views/validation.js"></script>
</body>
</html>
