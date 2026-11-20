<?php
require_once __DIR__ . "/../src/validation.php";
require_once __DIR__ . "/../src/utilisateur.php";
$erreur_doublon = null;
$succes = false;
$erreur_champs = [];
$erreur_champs_vide = [];
$erreur_inscription = [];
$donnees = [];
foreach (['nom', 'prenom', 'ville', 'telephone', 'addresse_postale', 'code_postal', 'email'] as $champ) {
  $donnees[$champ] = trim($_POST[$champ] ?? '');
}
$donnees['pays'] = trim($_POST['pays'] ?? 'France');
$donnees['pass'] = $_POST['pass'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__ . "/../src/config/database.php";

  foreach ($donnees as $champ => $valeur_champ) {
    if ($valeur_champ === '') {
      $erreur_champs_vide[$champ] = 'Ce champ est obligatoire.';
    }
  }

  $erreur_champs = valider_inscription($donnees);

  $erreur_inscription = array_merge($erreur_champs, $erreur_champs_vide);

  if (empty($erreur_inscription)) {

    $compte_absent = compte_absent($pdo, $donnees['email']);

    if ($compte_absent) {
      $inscription = creer_utilisateur($pdo, $donnees);
      $succes = $inscription;
      if ($inscription == TRUE) {
        $donnees['email'] = $donnees['pass'] = $donnees['prenom'] = $donnees['nom'] = $donnees['telephone'] = $donnees['ville'] = $donnees['addresse_postale'] = $donnees['code_postal'] = '';
        $donnees['pays'] = 'France';
      }
    } else {
      $erreur_doublon = 'Un compte existe déjà avec cette adresse email. <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>';
    }
  }
}

$titre_page = "Créer un compte";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">

  <form class="needs-validation" method="post" novalidate>

    <?php if ($succes): ?>
      <div class="alert alert-success" role="alert">Votre compte a bien été créé.</div>
    <?php endif; ?>

    <?php if ($erreur_doublon !== null): ?>
      <div class="alert alert-danger" role="alert"><?= $erreur_doublon ?></div>
    <?php endif; ?>

    <fieldset class="border rounded p-3 mt-4 mb-4">
      <legend class="fs-5">Vos coordonnées</legend>

      <div class="row g-3">

        <div class="col-md-4">
          <label for="validationNom" class="form-label">Nom</label>
          <input type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'nom') ?>"
            id="validationNom"
            name="nom"
            value="<?= htmlspecialchars($donnees['nom']) ?>"
            aria-describedby="erreur-nom"
            required>
          <?= message_erreur($erreur_inscription, 'nom') ?>
        </div>

        <div class="col-md-4">
          <label for="validationPrenom" class="form-label">Prénom</label>
          <input
            type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'prenom') ?>"
            id="validationPrenom"
            name="prenom"
            value="<?= htmlspecialchars($donnees['prenom']) ?>"
            aria-describedby="erreur-prenom"
            required>
          <?= message_erreur($erreur_inscription, 'prenom') ?>
        </div>

        <div class="col-md-4">
          <label for="validationTel" class="form-label">Téléphone</label>
          <input type="tel"
            class="form-control <?= classe_erreur($erreur_inscription, 'telephone') ?>"
            id="validationTel"
            name="telephone"
            value="<?= htmlspecialchars($donnees['telephone']) ?>"
            aria-describedby="erreur-telephone"
            required>
          <?= message_erreur($erreur_inscription, 'telephone') ?>
        </div>

        <div class="col-md-12">
          <label for="validationAddresse" class="form-label">Adresse</label>
          <input type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'addresse_postale') ?>"
            id="validationAddresse"
            name="addresse_postale"
            value="<?= htmlspecialchars($donnees['addresse_postale']) ?>"
            aria-describedby="erreur-addresse_postale"
            required>
          <?= message_erreur($erreur_inscription, 'addresse_postale') ?>
        </div>

        <div class="col-md-3">
          <label for="validationCP" class="form-label">Code Postal</label>
          <input type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'code_postal') ?>"
            id="validationCP"
            name="code_postal"
            value="<?= htmlspecialchars($donnees['code_postal']) ?>"
            inputmode="numeric"
            aria-describedby="erreur-code_postal"
            required>
          <?= message_erreur($erreur_inscription, 'code_postal') ?>
        </div>

        <div class="col-md-6">
          <label for="validationVille" class="form-label">Ville</label>
          <input type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'ville') ?>"
            id="validationVille"
            name="ville"
            value="<?= htmlspecialchars($donnees['ville']) ?>"
            aria-describedby="erreur-ville"
            required>
          <?= message_erreur($erreur_inscription, 'ville') ?>
        </div>

        <div class="col-md-3">
          <label for="validationPays" class="form-label">Pays</label>
          <input type="text"
            class="form-control <?= classe_erreur($erreur_inscription, 'pays') ?>"
            id="validationPays"
            name="pays" value="<?= htmlspecialchars($donnees['pays']) ?>"
            aria-describedby="erreur-pays"
            required>
          <?= message_erreur($erreur_inscription, 'pays') ?>
        </div>

      </div>
    </fieldset>

    <fieldset class="border rounded p-3 mt-4 mb-4">
      <legend class="fs-5">Vos identifiants</legend>

      <div class="row g-3">

        <div class="col-md-6">
          <label for="validationEmail" class="form-label">Email</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope" aria-hidden="true"></i></span>
            <input type="email"
              class="form-control <?= classe_erreur($erreur_inscription, 'email') ?>"
              id="validationEmail"
              name="email" value="<?= htmlspecialchars($donnees['email']) ?>"
              aria-describedby="erreur-email"
              required>
            <?= message_erreur($erreur_inscription, 'email') ?>
          </div>
        </div>

        <div class="col-md-6">
          <label for="validationPass" class="form-label">Mot de passe</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock" aria-hidden="true"></i></span>
            <input type="password" class="form-control <?= classe_erreur($erreur_inscription, 'pass') ?>" id="validationPass" name="pass" aria-describedby="aideMdp erreur-pass" required>
            <?= message_erreur($erreur_inscription, 'pass') ?>
          </div>
          <div id="aideMdp" class="form-text">
            10 caractères minimum, dont une majuscule, une minuscule, un chiffre et un caractère spécial.
          </div>
        </div>

      </div>

    </fieldset>

    <div class="col-12 d-flex justify-content-end gap-2 mb-5">
      <button class="btn btn-secondary" type="reset">Annuler</button>
      <button class="btn btn-primary" type="submit">Valider</button>
    </div>
  </form>
</section>

<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>