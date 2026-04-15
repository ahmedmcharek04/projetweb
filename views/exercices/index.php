<?php ob_start(); ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Exercices : <?= htmlspecialchars($activite['nom']) ?></h2>
    <div style="display: flex; gap: 10px;">
        <a href="index.php?c=exercice&action=create&activite_id=<?= $activite_id ?>" class="btn">Nouvel Exercice</a>
        <a href="index.php?c=activite&action=index" class="btn btn-danger">Retour aux activités</a>
    </div>
</div>

<div class="card-grid">
    <?php if (empty($exercices)): ?>
        <p style="grid-column: 1 / -1; color: var(--text-muted); font-size: 18px; text-align: center; padding: 40px; background: var(--bg-dark); border-radius: 16px; border: 1px dashed var(--glass-border2);">Aucun exercice disponible pour cette activité. Soyez le premier à en ajouter !</p>
    <?php else: ?>
        <?php 
        // Images d'action d'exercices
        $imgExos = [
            'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=800',
            'https://images.unsplash.com/photo-1599058917212-d750089bc07e?q=80&w=800',
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=800',
            'https://images.unsplash.com/photo-1507398941214-5a10cbce11dd?q=80&w=800'
        ];
        
        $i = 0;
        foreach ($exercices as $exercice): 
            // Permet d'alterner différentes images pour chaque exercice pour éviter la redondance
            $randomImg = $imgExos[$i % count($imgExos)];
            $i++;
        ?>
            <div class="card">
                <div class="card-img-placeholder" style="background-image: url('<?= $randomImg ?>'); background-size: cover; background-position: center; height: 160px;">
                </div>
                <div class="card-content">
                    <h3 class="card-title" style="margin-bottom: 10px;"><?= htmlspecialchars($exercice['nom']) ?></h3>
                    <p style="color:var(--text-muted); font-size:13px; line-height:1.5; min-height:60px; margin-bottom:15px;">
                        <?= htmlspecialchars($exercice['description']) ?>
                    </p>
                    
                    <div class="card-actions" style="position: relative; z-index: 100; pointer-events: auto;">
                        <a href="index.php?c=exercice&action=edit&id=<?= $exercice['id'] ?>" class="btn" style="position: relative; z-index: 101;">Modifier</a>
                        <a href="index.php?c=exercice&action=delete&id=<?= $exercice['id'] ?>&activite_id=<?= $activite_id ?>" class="btn btn-danger" onclick="return confirm('Supprimer définitivement cet exercice ?');" style="position: relative; z-index: 101;">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php 
$content = ob_get_clean();
require 'views/layout_back.php'; 
?>
