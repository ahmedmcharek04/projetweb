<?php ob_start(); ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Modifier l'Activité : <?= htmlspecialchars($activite['nom'] ?? 'Inconnue') ?></h2>
    <a href="index.php?c=activite&action=index" class="btn" style="background:transparent; border:1px solid var(--glass-border2); color:var(--text-muted);">Annuler et Retour</a>
</div>

<?php if (!empty($errors)): ?>
    <div style="background: rgba(200, 122, 116, 0.1); border-left: 4px solid var(--danger); color: var(--danger); padding: 15px; margin-bottom: 20px; border-radius: 8px;">
        <strong>Veuillez corriger les erreurs suivantes :</strong>
        <ul style="margin: 5px 0 0 20px; padding: 0;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?c=activite&action=edit&id=<?= $activite['id'] ?? '' ?>" method="POST">
    <div>
        <label for="nom">Nom de l'activité <span style="color:var(--accent);">*</span></label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($_POST['nom'] ?? $activite['nom'] ?? '') ?>">
    </div>
    
    <div>
        <label for="categorie">Catégorie du Programme <span style="color:var(--accent);">*</span></label>
        <?php $currentCat = $_POST['categorie'] ?? $activite['categorie'] ?? ''; ?>
        <select name="categorie" id="categorie">
            <option value="">Sélectionnez une catégorie...</option>
            <option value="Être musclé" <?= ($currentCat == 'Être musclé') ? 'selected' : '' ?>>Être musclé (Bodybuilding)</option>
            <option value="Perte de poids" <?= ($currentCat == 'Perte de poids') ? 'selected' : '' ?>>Perte de poids (HIIT)</option>
            <option value="Cardio" <?= ($currentCat == 'Cardio') ? 'selected' : '' ?>>Cardio (Course, Vélo)</option>
            <option value="Force" <?= ($currentCat == 'Force') ? 'selected' : '' ?>>Force (Powerlifting)</option>
            <option value="Amateur" <?= ($currentCat == 'Amateur') ? 'selected' : '' ?>>Amateur</option>
            <option value="Autre" <?= ($currentCat == 'Autre') ? 'selected' : '' ?>>Autre...</option>
        </select>
    </div>

    <div>
        <label for="description">Description (Optionnel)</label>
        <textarea name="description" id="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? $activite['description'] ?? '') ?></textarea>
    </div>
    
    <div style="text-align: right; margin-top: 10px;">
        <button type="submit" class="btn" style="padding: 14px 30px; font-size: 15px;">💾 Mettre à jour la Base</button>
    </div>
</form>

<?php
$content = ob_get_clean();
require 'views/layout_back.php';
?>
