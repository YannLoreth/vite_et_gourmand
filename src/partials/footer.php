<?php require_once __DIR__ . '/../horaires.php'; ?>

<footer class="text-center py-1 mt-2">
  <div class="container">
<div class="row">
  <?php foreach ($horaires as $index => $ouverture): ?>
    <?php if ($index % 2 === 0): ?>
      <div class="col-3">
    <?php endif; ?>

    <p><?= $ouverture['libelle'] ?> : <?= $ouverture['horaire_ouverture'] ?> - <?= $ouverture['horaire_fermeture'] ?></p>

    <?php if ($index % 2 === 1 || $index === count($horaires) - 1): ?>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
    <p class="mt-2">
      <a href="#" class="text-white">lien mentions légales</a> |
      <a href="#" class="text-white">lien CGV </a>
    </p>
  </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
