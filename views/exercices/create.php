<?php ob_start(); ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Créer un nouvel Exercice</h2>
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

<form action="index.php?c=exercice&action=create" method="POST">
    <div>
        <label for="nom">Nom de l'exercice <span style="color:var(--accent);">*</span></label>
        <input type="text" name="nom" id="nom" placeholder="Ex: Développé couché, Squat..." value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>">
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <label for="difficulte">Niveau de difficulté <span style="color:var(--accent);">*</span></label>
            <select name="difficulte" id="difficulte">
                <option value="Débutant" <?= (isset($_POST['difficulte']) && $_POST['difficulte'] == 'Débutant') ? 'selected' : '' ?>>🟢 Débutant</option>
                <option value="Moyen" <?= (isset($_POST['difficulte']) && $_POST['difficulte'] == 'Moyen') ? 'selected' : '' ?>>🟡 Moyen</option>
                <option value="Difficile" <?= (isset($_POST['difficulte']) && $_POST['difficulte'] == 'Difficile') ? 'selected' : '' ?>>🔴 Difficile</option>
            </select>
        </div>

        <div>
            <label for="activite_id">Associer au Programme Sportif <span style="color:var(--accent);">*</span></label>
            <select name="activite_id" id="activite_id">
                <option value="">Sélectionnez le module parent...</option>
                <?php foreach ($activites as $act): ?>
                    <option value="<?= $act['id'] ?>" <?= (isset($_POST['activite_id']) && $_POST['activite_id'] == $act['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($act['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div>
        <label for="url_video">URL Vidéo de démonstration (ex: https://youtube.com/...) - Optionnel</label>
        <input type="text" name="url_video" id="url_video" placeholder="Lien direct vers la vidéo" value="<?= isset($_POST['url_video']) ? htmlspecialchars($_POST['url_video']) : '' ?>">
    </div>

    <div>
        <label for="description">Instructions / Description</label>
        <textarea name="description" id="description" rows="4" placeholder="Expliquez le mouvement..."><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
    </div>
    
    <div style="text-align: right; margin-top: 10px;">
        <button type="submit" class="btn" style="padding: 14px 30px; font-size: 15px;">💾 Ajouter l'exercice à la Base</button>
    </div>
</form>

<?php
$content = ob_get_clean();
require 'views/layout_back.php';
?>
