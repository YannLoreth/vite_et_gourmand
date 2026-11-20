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

// Contrôle du code postal
function verifier_code_postal(string $code_postal): ?string
{
    if (preg_match('/^[0-9]{5}$/', $code_postal) === 0) {
        return "Le code postal doit contenir 5 chiffres.";
    }
    return null;
}

// Contrôle du mail
function verifier_mail(string $email): ?string
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return "L'adresse email n'est pas valide.";
    }
    return null;
}

function verifier_telephone(string $telephone): ?string
{
    if (preg_match('/^0[1-9][0-9]{8}$/', str_replace(' ', '', $telephone)) === 0) {
        return "Le numéro de téléphone doit contenir 10 chiffres et commencer par 0.";
    }
    return null;
}

function valider_inscription(array $donnees): array
{
    $erreur_champs = [];

    $erreur_code_postal = verifier_code_postal($donnees['code_postal']);
    if ($donnees['code_postal'] !== '' && $erreur_code_postal !== null) {
        $erreur_champs['code_postal'] = $erreur_code_postal;
    }

    $erreur_mail = verifier_mail($donnees['email']);
    if ($donnees['email'] !== '' && $erreur_mail !== null) {
        $erreur_champs['email'] = $erreur_mail;
    }

    $erreur_telephone = verifier_telephone($donnees['telephone']);
    if ($donnees['telephone'] !== '' && $erreur_telephone !== null) {
        $erreur_champs['telephone'] = $erreur_telephone;
    }
    $erreur_pass = verifier_mot_de_passe($donnees['pass']);
    if ($donnees['pass'] !== '' && $erreur_pass !== null) {
        $erreur_champs['pass'] = $erreur_pass;
    }
    return $erreur_champs;
}
