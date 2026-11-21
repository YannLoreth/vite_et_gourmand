<?php

/**
 * @var string $nom_champ        Clé du champ (name, id...)
 * @var array  $description_champ  Libellé, type, largeur...
 * @var array  $donnees            Valeurs saisies
 * @var array  $erreur_inscription Erreurs par champ
 */
?>

<div class="col-md-<?= $description_champ['largeur'] ?>">
    <label for="validation<?= $nom_champ ?>" class="form-label"> <?= $description_champ['libelle'] ?> </label>
    <?php if (isset($description_champ['icone'])): ?> <div class="input-group has-validation"><span class="input-group-text"><i class="<?= $description_champ['icone'] ?>" aria-hidden="true"></i></span><?php endif; ?>
        <input type="<?= $description_champ['type'] ?>"
            class="form-control <?= classe_erreur($erreur_inscription, $nom_champ) ?>"
            id="validation<?= $nom_champ ?>"
            name="<?= $nom_champ ?>"
            <?php if ($description_champ['type'] !== 'password'): ?>value="<?= htmlspecialchars($donnees[$nom_champ]) ?>"<?php endif; ?>
            <?php if (isset($description_champ['inputmode'])): ?>inputmode="<?= $description_champ['inputmode'] ?>" <?php endif; ?>
            aria-describedby="<?php if (isset($description_champ['aide'])): ?>aideMdp <?php endif; ?> erreur-<?= $nom_champ ?>"
            required>
        <?= message_erreur($erreur_inscription, $nom_champ) ?>
        <?php if (isset($description_champ['icone'])): ?> </div> <?php endif; ?>
        <?php if (isset($description_champ['aide'])): ?> <div id="aideMdp" class="form-text"><?=$description_champ['aide'] ?></div> <?php endif; ?>
</div>