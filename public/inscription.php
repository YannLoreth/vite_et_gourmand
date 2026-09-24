<?php
$titre_page = "Créer un compte";
require_once __DIR__ . '/../src/partials/header.php';
?>

<section class="container py-auto mb-auto mt-auto">
<form class="row g-3 needs-validation" method="post">
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
    <label for="validationEmail"  class="form-label">Email</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="email" class="form-control" id="validationEmail" aria-describedby="inputGroupPrepend" name="email" required>
      <div class="invalid-feedback">
        Saisez un mail valide.
      </div>
    </div>
  </div>

   <div class="col-md-6">
    <label for="validationPass"  class="form-label">Mot de passe</label>
    <div class="input-group has-validation">
      <input type="Password" class="form-control" id="validationPass" name="pass" required>
      <div class="invalid-feedback">
        Saisez un mot de passe valide.
      </div>
    </div>
  </div>

    <div class="col-md-4">
    <label for="validationTel" class="form-label">Téléphone</label>
    <input type="tel" class="form-control" id="validationTel" name="telephone" required>
    <div class="invalid-feedback">
      SVP saisir un téléphone valide.
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationAddresse"  class="form-label">Addresse</label>
    <input type="text" class="form-control" id="validationAddresse" name="addresse_postale" required>
    <div class="invalid-feedback">
      SVP saisir une adresse postale
    </div>
  </div>

      <div class="col-md-4">
    <label for="validationPays" class="form-label">Pays</label>
    <input type="text" class="form-control" id="validationPays" name="pays" required>
    <div class="invalid-feedback">
      SVP saisir le pays
    </div>
  </div>

  <div class="col-md-3">
    <label for="validationCP" class="form-label">Code Postal</label>
    <input type="text" class="form-control" id="validationCP" name="code_postal" required>
    <div class="invalid-feedback">
      SVP saisir un code postal.
    </div>
  </div>

  <div class="col-md-3">
    <label for="validationVille" class="form-label">Ville</label>
    <input type="text" class="form-control" id="validationVille" name="ville" required>
    <div class="invalid-feedback">
      SVP saisir la ville
    </div>
  </div>



  <div class="col-12 d-flex justify-content-end gap-2 mb-5">
    <button class="btn btn-secondary" type="reset">Annuler</button>
    <button class="btn btn-primary" type="submit">Valider</button>
  </div>
</form>
  </section>

<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>