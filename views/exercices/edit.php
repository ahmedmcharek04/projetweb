<?php ob_start(); ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Modifier l'Exercice : <?= htmlspecialchars($exercice['nom'] ?? 'Inconnu') ?></h2>
    <a href="index.php?c=exercice&action=index" class="btn" style="background:transparent; border:1px solid var(--glass-border2); color:var(--text-muted);">Annuler et Retour</a>
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

<form action="index.php?c=exercice&action=edit&id=<?= $exercice['id'] ?? '' ?>" method="POST">
    <div>
        <label for="nom">Nom de l'exercice <span style="color:var(--accent);">*</span></label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($_POST['nom'] ?? $exercice['nom'] ?? '') ?>">
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <label for="difficulte">Niveau de difficulté <span style="color:var(--accent);">*</span></label>
            <?php $currentDiff = $_POST['difficulte'] ?? $exercice['difficulte'] ?? ''; ?>
            <select name="difficulte" id="difficulte">
                <option value="Débutant" <?= ($currentDiff == 'Débutant') ? 'selected' : '' ?>>🟢 Débutant</option>
                <option value="Moyen" <?= ($currentDiff == 'Moyen') ? 'selected' : '' ?>>🟡 Moyen</option>
                <option value="Difficile" <?= ($currentDiff == 'Difficile') ? 'selected' : '' ?>>🔴 Difficile</option>
            </select>
        </div>

        <div>
            <label for="activite_id">Associer au Programme Sportif <span style="color:var(--accent);">*</span></label>
            <?php $currentAct = $_POST['activite_id'] ?? $exercice['activite_id'] ?? ''; ?>
            <select name="activite_id" id="activite_id">
                <option value="">Sélectionnez le module parent...</option>
                <?php foreach ($activites as $act): ?>
                    <option value="<?= $act['id'] ?>" <?= ($currentAct == $act['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($act['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div>
        <label for="url_video">URL Vidéo de démonstration (ex: https://youtube.com/...) - Optionnel</label>
        <input type="text" name="url_video" id="url_video" value="<?= htmlspecialchars($_POST['url_video'] ?? $exercice['url_video'] ?? '') ?>">
    </div>

    <div>
        <label for="description">Instructions / Description</label>
        <textarea name="description" id="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? $exercice['description'] ?? '') ?></textarea>
    </div>
    
    <div style="text-align: right; margin-top: 10px;">
        <button type="submit" class="btn" style="padding: 14px 30px; font-size: 15px;">💾 Mettre à jour la Base</button>
    </div>
</form>

<?php
$content = ob_get_clean();
require 'views/layout_back.php';
?>
