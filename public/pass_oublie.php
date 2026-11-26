<?php
session_start();
require_once __DIR__ . "/../src/validation.php";
require_once __DIR__ . "/../src/utilisateur.php";
$succes = false;
$erreur = [];
$donnees = [];
$donnees['email'] = trim($_POST['email'] ?? '');
$champs_formulaire = require __DIR__ . '/../src/config/champs.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . "/../src/config/database.php";

    foreach ($donnees as $champ => $valeur_champ) {
        if ($valeur_champ === '') {
            $erreur[$champ] = 'Ce champ est obligatoire.';
        }
    }
    if (empty($erreur)) {
        $fiche_utilisateur =  trouver_utilisateur($pdo, $donnees['email']);
        $succes = true;
        if ($fiche_utilisateur) {
            $jeton = bin2hex(random_bytes(32));
            enregistrer_jeton($pdo, $fiche_utilisateur['utilisateur_id'], $jeton);
        }
    }
}

$titre_page = "Mot de passe oublié";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">
    <form class="needs-validation" method="post" novalidate>

        <?php if ($succes): ?>
            <div class="alert alert-success" role="alert">Si cette adresse est associée à un compte, un lien pour réinitialiser votre mot de passe vient de vous être envoyé.</div>
        <?php endif; ?>

        <fieldset class="border rounded p-3 mt-4 mb-4">
            <legend class="fs-5">Vos identifiants</legend>

            <div class="row g-3">

                <?php foreach ($champs_formulaire as $nom_champ => $description_champ) {
                    if ($nom_champ !== ('email')) {
                        continue;
                    }
                    require __DIR__ . '/../src/partials/champs_formulaires.php';
                }
                ?>

            </div>

        </fieldset>

        <div class="col-12 d-flex justify-content-end gap-2 mb-5">
            <button class="btn btn-primary" type="submit">Valider</button>
        </div>
    </form>

    <p>Pour revenir à l'accueil <a href="index.php">il suffit de cliquer ici.</a></p>

</section>