<?php
require_once __DIR__ . "/../src/validation.php";
require_once __DIR__ . "/../src/utilisateur.php";


$titre_page = "Connexion";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">
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