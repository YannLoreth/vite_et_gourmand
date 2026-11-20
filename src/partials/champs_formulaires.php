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
         <input type="<?= $description_champ['type'] ?>"
             class="form-control <?= classe_erreur($erreur_inscription, $nom_champ) ?>"
             id="validation<?= $nom_champ ?>"
             name="<?= $nom_champ ?>"
             value="<?= htmlspecialchars($donnees[$nom_champ]) ?>"
             <?php if (isset($description_champ['inputmode'])): ?>inputmode="<?= $description_champ['inputmode'] ?>"<?php endif; ?>
             aria-describedby="erreur-<?= $nom_champ ?>"
             required>
         <?= message_erreur($erreur_inscription, $nom_champ) ?>
     </div>