<?php

require_once __DIR__ . '/config/database.php';

// Select pour la page d'accueil
$stmt_acc = $pdo->query("
    SELECT a.note, a.commentaire, u.prenom, u.nom
    FROM avis a
    JOIN commande c ON a.numero_commande = c.numero_commande
    JOIN utilisateur u ON c.utilisateur_id = u.utilisateur_id
    WHERE a.statut_avis_id = 2
    ORDER BY a.avis_id
");

$avis_acc = $stmt_acc->fetchAll(PDO::FETCH_ASSOC);

// Select pour l'espace employé 

$stmt_empl = $pdo->query("
    SELECT a.note, a.commentaire, u.prenom, u.nom
    FROM avis a
    JOIN commande c ON a.numero_commande = c.numero_commande
    JOIN utilisateur u ON c.utilisateur_id = u.utilisateur_id
    ORDER BY a.avis_id
");

$avis_empl = $stmt_empl->fetchAll(PDO::FETCH_ASSOC);