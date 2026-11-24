<?php
session_start();
require_once __DIR__ . "/../src/validation.php";
require_once __DIR__ . "/../src/utilisateur.php";
$erreur = [];
$donnees = [];
$donnees['email'] = trim($_POST['email'] ?? '');
$donnees['pass'] = $_POST['pass'] ?? '';
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
        if (!$fiche_utilisateur || !password_verify($donnees['pass'], $fiche_utilisateur['pass'])) {
            $erreur['pass'] = 'Identifiants incorrects';
        } else {
            $_SESSION['utilisateur_id'] = $fiche_utilisateur['utilisateur_id'];
            $_SESSION['prenom'] = $fiche_utilisateur['prenom'];
            $_SESSION['roles_id'] = $fiche_utilisateur['roles_id'];
            header('Location: index.php');
            exit;
        }
    }
}

$titre_page = "Connexion";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">
    <form class="needs-validation" method="post" novalidate>

        <fieldset class="border rounded p-3 mt-4 mb-4">
            <legend class="fs-5">Vos identifiants</legend>

            <div class="row g-3">

                <?php foreach ($champs_formulaire as $nom_champ => $description_champ) {
                    if ($description_champ['groupe'] !== 'identifiants') {
                        continue;
                    }
                    unset($description_champ['aide']);
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

    <p>Pas de compte ? <a href="inscription.php">En créer un ici.</a></p>

</section>