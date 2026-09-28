<?php

// Contrôle du mot de passe
function verifier_mot_de_passe(string $pass): ?string
{
    if (mb_strlen($pass) < 10) {
        return 'Le mot de passe doit contenir au moins 10 caractères.';
    }
    if (preg_match('/[A-Z]/', $pass) === 0) {
        return 'Le mot de passe doit contenir au moins une majuscule.';
    }
    if (preg_match('/[a-z]/', $pass) === 0) {
        return 'Le mot de passe doit contenir au moins une minuscule.';
    }
    if (preg_match('/[0-9]/', $pass) === 0) {
        return 'Le mot de passe doit contenir au moins un chiffre.';
    }
    if (preg_match('/[^a-zA-Z0-9]/', $pass) === 0) {
        return 'Le mot de passe doit contenir au moins un caractère spécial.';
    }
    return null;
}

// Contôles des champs de formulaire
function classe_erreur(array $erreurs, string $champ): string
{
    return isset($erreurs[$champ]) ? 'is-invalid' : '';
}

function message_erreur(array $erreurs, string $champ): string
{
    if (!isset($erreurs[$champ])) {
        return '';
    }
    return '<div id="erreur-' . $champ . '" class="invalid-feedback">' . htmlspecialchars($erreurs[$champ]) . '</div>';
}
