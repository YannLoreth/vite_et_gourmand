<?php
return [
  'nom' => ['libelle' => 'Nom', 'type' => 'text', 'largeur' => 4, 'groupe' => 'coordonnees'],
  'prenom' => ['libelle' => 'Prénom', 'type' => 'text', 'largeur' => 4, 'groupe' => 'coordonnees'],
  'telephone' => ['libelle' => 'Téléphone', 'type' => 'tel', 'largeur' => 4, 'groupe' => 'coordonnees'],
  'addresse_postale' => ['libelle' => 'Adresse', 'type' => 'text', 'largeur' => 12, 'groupe' => 'coordonnees'],
  'code_postal' => ['libelle' => 'Code Postal', 'type' => 'text', 'inputmode' => 'numeric', 'largeur' => 3, 'groupe' => 'coordonnees'],
  'ville' => ['libelle' => 'Ville', 'type' => 'text', 'largeur' => 6, 'groupe' => 'coordonnees'],
  'pays' => ['libelle' => 'Pays', 'type' => 'text', 'largeur' => 3, 'groupe' => 'coordonnees'],
  'email' => ['libelle' => 'Email', 'type' => 'email', 'icone' => 'bi bi-envelope','largeur' => 6, 'groupe' => 'identifiants'],
  'pass' => ['libelle' => 'Mot de passe', 'type' => 'password', 'icone' => 'bi bi-lock','largeur' => 6, 'aide' => '10 caractères minimum, dont une majuscule, une minuscule, un chiffre et un caractère spécial.', 'groupe' => 'identifiants']
];
