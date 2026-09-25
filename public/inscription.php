<?php
$erreur_doublon = null;
$erreur_champs = [];
$email = trim($_POST['email'] ?? '');
$pass = $_POST['pass'] ?? '';
$prenom = trim($_POST['prenom'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$ville = trim($_POST['ville'] ?? '');
$pays = trim($_POST['pays'] ?? '');
$addresse_postale = trim($_POST['addresse_postale'] ?? '');
$code_postal = trim($_POST['code_postal'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__ . "/../src/config/database.php";
  require_once __DIR__ ."/../src/validation.php";

  $champs_obligatoires = [
    'nom' => $nom,
    'prenom' => $prenom,
    'telephone' => $telephone,
    'addresse_postale' => $addresse_postale,
    'code_postal' => $code_postal,
    'ville' => $ville,
    'pays' => $pays,
    'email' => $email,
    'pass' => $pass,
  ];

  foreach ($champs_obligatoires as $champ => $valeur) {
    if ($valeur === '') {
      $erreur_champs[$champ] = 'Ce champ est obligatoire.';
    }
  }

  if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $erreur_champs['email'] = "L'adresse email n'est pas valide.";
  }

$erreur_pass = verifier_mot_de_passe($pass);
if ($pass !== '' && $erreur_pass !== null) {
    $erreur_champs['pass'] = $erreur_pass;
}

  if (empty($erreur_champs)) {

    $stmt_verif = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
    $stmt_verif->execute(['email' => $email]);
    $nb_comptes = $stmt_verif->fetchColumn();

    if ($nb_comptes == 0) {
      $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

      $stmt_inscript = $pdo->prepare("INSERT INTO utilisateur (email, pass, prenom, nom, telephone, ville, pays, addresse_postale, code_postal, roles_id)
            VALUES (:email, :pass, :prenom, :nom, :telephone, :ville, :pays, :addresse_postale, :code_postal, 1)");
      $stmt_inscript->execute([
        'email' => $email,
        'pass' => $pass_hash,
        'prenom' => $prenom,
        'nom' => $nom,
        'telephone' => $telephone,
        'ville' => $ville,
        'pays' => $pays,
        'addresse_postale' => $addresse_postale,
        'code_postal' => $code_postal,
      ]);
    } else {
      $erreur_doublon = 'Un compte existe déjà avec cette adresse email. <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>';
    }
  }
}

$titre_page = "Créer un compte";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">

  <form class="needs-validation" method="post">

    <?php if ($erreur_doublon !== null): ?>
      <div class="alert alert-danger" role="alert"><?= $erreur_doublon ?></div>
    <?php endif; ?>

    <fieldset class="border rounded p-3 mt-4 mb-4">
      <legend class="fs-5">Vos coordonnées</legend>

      <div class="row g-3">

        <div class="col-md-4">
          <label for="validationNom" class="form-label">Nom</label>
          <input type="text" class="form-control" id="validationNom" name="nom" required>
          <div class="valid-feedback">
            Bien !
          </div>
        </div>

        <div class="col-md-4">
          <label for="validationPrenom" class="form-label">Prénom</label>
          <input type="text" class="form-control" id="validationPrenom" name="prenom" required>
          <div class="valid-feedback">
            Bien !
          </div>
        </div>

        <div class="col-md-4">
          <label for="validationTel" class="form-label">Téléphone</label>
          <input type="tel" class="form-control" id="validationTel" name="telephone" required>
          <div class="invalid-feedback">
            SVP saisir un téléphone valide.
          </div>
        </div>

        <div class="col-md-12">
          <label for="validationAddresse" class="form-label">Adresse</label>
          <input type="text" class="form-control" id="validationAddresse" name="addresse_postale" required>
          <div class="invalid-feedback">
            SVP saisir une adresse postale
          </div>
        </div>

        <div class="col-md-3">
          <label for="validationCP" class="form-label">Code Postal</label>
          <input type="text" class="form-control" id="validationCP" name="code_postal" required>
          <div class="invalid-feedback">
            SVP saisir un code postal.
          </div>
        </div>

        <div class="col-md-6">
          <label for="validationVille" class="form-label">Ville</label>
          <input type="text" class="form-control" id="validationVille" name="ville" required>
          <div class="invalid-feedback">
            SVP saisir la ville
          </div>
        </div>

        <div class="col-md-3">
          <label for="validationPays" class="form-label">Pays</label>
          <input type="text" class="form-control" id="validationPays" value="France" name="pays" required>
          <div class="invalid-feedback">
            SVP saisir le pays
          </div>
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
            <input type="email" class="form-control" id="validationEmail" aria-describedby="inputGroupPrepend" name="email" required>
            <div class="invalid-feedback">
              Saisissez un mail valide.
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <label for="validationPass" class="form-label">Mot de passe</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="validationPass" name="pass" aria-describedby="aideMdp" required>
            <div id="aideMdp" class="form-text">
              10 caractères minimum, dont une majuscule, une minuscule, un chiffre et un caractère spécial.
            </div>
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