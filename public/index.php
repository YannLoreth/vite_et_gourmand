<?php
$titre_page = "Accueil";
require_once __DIR__ . '/../src/partials/header.php';
require_once __DIR__ . '/../src/avis.php';
?>


<h1 class="container text-center my-4">Bienvenue chez Vite & Gourmand</h1>
<section class="py-auto">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-4">
        <img src="images/julie_josé.jpg" alt="Julie & José, le duo à l'oeuvre en cuisine" class="img-fluid rounded">
      </div>
      <div class="col-md-8">
        <h2>Quelques mots sur l'entreprise</h2>
        <p>
          Vite & Gourmand, c'est l'histoire de Julie et José, réunis depuis 25 ans autour d'une passion commune pour la cuisine conviviale.
          Installés à Bordeaux, nous accompagnons vos événements, qu'il s'agisse d'un repas de famille, d'un Noël en entreprise ou d'une célébration de Pâques, avec des menus pensés pour rassembler et régaler.
          Chaque recette est élaborée avec des produits soigneusement sélectionnés, dans le respect des traditions culinaires autant que des envies de chacun.
          Notre ambition : vous simplifier la vie tout en vous offrant une expérience gourmande à la hauteur de vos attentes.
        </p>
      </div>
    </div>

    <div class="row align-items-center flex-row-reverse mb-5">
      <div class="col-md-4">
        <img src="images/plat_en_preparation.jpg" alt="En cuisine, un plat est en préparation" class="img-fluid rounded">
      </div>
      <div class="col-md-8">
        <h2>Quelques mots sur Nous</h2>
        <p>
          Derrière chaque assiette, une équipe passionnée. Julie, à la création des menus, imagine chaque recette avec exigence et créativité. José, en cuisine, veille à la qualité et à la régularité de chaque préparation.
          Ensemble, ils mettent leur expérience au service de votre satisfaction, du premier échange jusqu'à la livraison.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="py-auto">
    <h2 class="container">Quelques avis clients</h2>
    <div class="container">
        <div class="row g-4">

            <?php foreach ($avis_acc as $index => $card_avis): ?>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= str_repeat('⭐', $card_avis['note']) ?> — <?= $card_avis['prenom'] ?> <?= substr($card_avis['nom'], 0, 1) ?>.</h5>
                            <p class="card-text"><?= $card_avis['commentaire'] ?></p>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>