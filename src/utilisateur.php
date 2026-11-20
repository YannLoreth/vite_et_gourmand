<?php

// Vérification doublons mail
function compte_absent(PDO $pdo, string $email): bool
{
    $stmt_verif = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
    $stmt_verif->execute(['email' => $email]);
    $nb_comptes = $stmt_verif->fetchColumn();

    return $nb_comptes == 0;
}

// Création utilisateur 
function creer_utilisateur(PDO $pdo, array $donnees): bool
{
    $pass_hash = password_hash($donnees['pass'], PASSWORD_DEFAULT);

    $stmt_inscript = $pdo->prepare("INSERT INTO utilisateur (email, pass, prenom, nom, telephone, ville, pays, addresse_postale, code_postal, roles_id)
            VALUES (:email, :pass, :prenom, :nom, :telephone, :ville, :pays, :addresse_postale, :code_postal, 1)");
    return $stmt_inscript->execute([
        'email' => $donnees['email'],
        'pass' => $pass_hash,
        'prenom' => $donnees['prenom'],
        'nom' => $donnees['nom'],
        'telephone' => $donnees['telephone'],
        'ville' => $donnees['ville'],
        'pays' => $donnees['pays'],
        'addresse_postale' => $donnees['addresse_postale'],
        'code_postal' => $donnees['code_postal'],
    ]);
}
