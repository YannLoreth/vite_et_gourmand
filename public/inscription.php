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
$champs_formulaire = require __DIR__ . '/../src/config/champs.php';

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

        <?php foreach ($champs_formulaire as $nom_champ => $description_champ) {
          if ($description_champ['groupe'] !== 'coordonnees') {
            continue;
          }
          require __DIR__ . '/../src/partials/champs_formulaires.php';
        }
        ?>

      </div>
    </fieldset>

    <fieldset class="border rounded p-3 mt-4 mb-4">
      <legend class="fs-5">Vos identifiants</legend>

      <div class="row g-3">

        <?php foreach ($champs_formulaire as $nom_champ => $description_champ) {
          if ($description_champ['groupe'] !== 'identifiants') {
            continue;
          }
          require __DIR__ . '/../src/partials/champs_formulaires.php';
        }
        ?>

      </div>

    </fieldset>

    <div class="col-12 d-flex justify-content-end gap-2 mb-5">
      <button class="btn btn-secondary" type="reset">Annuler</button>
      <button class="btn btn-primary" type="submit">Valider</button>
    </div>
  </form>
</section>

<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>