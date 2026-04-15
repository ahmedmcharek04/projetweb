<?php ob_start(); ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Catalogue des Activités Sportives</h2>
    <a href="index.php?c=activite&action=create" class="btn" style="white-space: nowrap; font-size:14px; padding: 12px 25px;">Nouvelle Activité</a>
</div>

<!-- Filtres Visuels (Pills) -->
<div class="filter-tabs">
    <div class="filter-tab active" onclick="filterCards(this, 'Tous')">Tous</div>
    <div class="filter-tab" onclick="filterCards(this, 'Être musclé')">Être musclé</div>
    <div class="filter-tab" onclick="filterCards(this, 'Perte de poids')">Perte de poids</div>
    <div class="filter-tab" onclick="filterCards(this, 'Cardio')">Cardio</div>
    <div class="filter-tab" onclick="filterCards(this, 'Force')">Force</div>
</div>

<div class="card-grid">
    <?php 
    // Superbe dictionnaire d'images dynamiques (Fitness / Sport) tirées de banques professionnelles
    $images = [
        'Force' => 'https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=800',
        'Perte de poids' => 'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=800',
        'Être musclé' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=800',
        'Cardio' => 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?q=80&w=800',
        'Souplesse' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800',
        'default' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=800'
    ];

    foreach ($activites as $activite): 
        // On cherche le lien correspondant à la catégorie, sinon on attribue l'image par défaut
        $imgUrl = isset($images[$activite['categorie']]) ? $images[$activite['categorie']] : $images['default'];
    ?>
        <div class="card">
            <!-- La DIV devient un background pour accueillir la vraie image en plein cadre -->
            <div class="card-img-placeholder" style="background-image: url('<?= $imgUrl ?>'); background-size: cover; background-position: center; height: 180px;">
                <div class="card-pill"><?= htmlspecialchars($activite['categorie']) ?></div>
            </div>
            
            <div class="card-content">
                <h3 class="card-title"><?= htmlspecialchars($activite['nom']) ?></h3>
                
                <div class="card-actions" style="position: relative; z-index: 100; pointer-events: auto;">
                    <a href="index.php?c=exercice&action=index&activite_id=<?= $activite['id'] ?>" class="btn"  style="flex:100%; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border: 1px solid var(--accent); background:transparent; color:var(--accent); position: relative; z-index: 101;">🏋️ Gérer les Exercices</a>
                    <a href="index.php?c=activite&action=edit&id=<?= $activite['id'] ?>" class="btn" style="position: relative; z-index: 101;">Modifier</a>
                    <a href="index.php?c=activite&action=delete&id=<?= $activite['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer définitivement l\'activité ?');" style="position: relative; z-index: 101;">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
function filterCards(tabElement, category) {
    // Mettre à jour l'état visuel du bouton cliqué
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    tabElement.classList.add('active');

    // Cacher ou afficher les cartes instantanément
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        // On récupère le texte du petit badge dans la carte
        const cardCategory = card.querySelector('.card-pill').innerText.trim();
        
        if (category === 'Tous' || cardCategory === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php 
$content = ob_get_clean();
require 'views/layout_back.php'; 
?>
