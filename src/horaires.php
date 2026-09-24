<?php

require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query("
    SELECT j.libelle, h.horaire_ouverture, h.horaire_fermeture
    FROM horaire h
    JOIN jours j ON h.jours_id = j.jours_id
    ORDER BY j.jours_id
");

$horaires = $stmt->fetchAll(PDO::FETCH_ASSOC);