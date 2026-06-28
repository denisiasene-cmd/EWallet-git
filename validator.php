<?php
require_once "repository.php";

function verifiertaille($telephone){
    $telephone = trim($telephone);
    if (strlen($telephone) === 9) {
        return true;
    } else {
        return false;
    }
}

function verifierNumero($telephone){
    $telephone = trim($telephone);
    if (strlen($telephone) === 0) return false;

    for ($i = 0; $i < strlen($telephone); $i++) {
        $char = $telephone[$i];
        if ($char < '0' || $char > '9') {
            return false;
        }
    }
    return true;
}

function verifierPrefixe($telephone) {
    $telephone = trim($telephone);

    if (str_starts_with($telephone, "77") || 
        str_starts_with($telephone, "78") || 
        str_starts_with($telephone, "76") || 
        str_starts_with($telephone, "70") || 
        str_starts_with($telephone, "75")) {
        return true;
    }
    return false;
}


function incite($telephone){
    global $wallets;
    $telephone = trim($telephone);
    
    if (!isset($wallets) || empty($wallets)) {
        return true;
    }
    $telephonesNettoyes = array_map(fn($wallet) => trim($wallet['telephone']), $wallets);

    if (in_array($telephone, $telephonesNettoyes)) {
        return false; 
    }
    
    return true; 
}


function controllerNumero($telephone){
    $tailleNumero = verifierNumero($telephone);
    $numeroUnique = incite($telephone);
    $numeroTaille = verifiertaille($telephone);
    $prefixeValide = verifierPrefixe($telephone); 

    if (!$tailleNumero || !$numeroUnique || !$numeroTaille || !$prefixeValide){
        return false;
    }

    return true;
}

function controlerCode($code){
    $code = trim($code);
    
    if (strlen($code) !== 4) return false;

    for ($i = 0; $i < strlen($code); $i++) {
        if ($code[$i] < '0' || $code[$i] > '9') {
            return false;
        }
    }
    return true;
}

function controlerNom($nom){
    $nom = trim($nom);
    if (strlen($nom) === 0) return false;

    for ($i = 0; $i < strlen($nom); $i++) {
        $char = $nom[$i];
        
        $isMajuscule = ($char >= 'A' && $char <= 'Z');
        $isMinuscule = ($char >= 'a' && $char <= 'z');
        $isEspace = ($char === ' ');

        if (!$isMajuscule && !$isMinuscule && !$isEspace) {
            return false;
        }
    }
    return true;
}

function controlerSolde($solde){
    $solde = trim($solde);
    if (strlen($solde) === 0) return false;

    $nombreDePoints = 0;

    for ($i = 0; $i < strlen($solde); $i++) {
        $char = $solde[$i];

        if ($char === '.') {
            $nombreDePoints++;
            if ($nombreDePoints > 1) return false;
            continue;
        }

        if ($char < '0' || $char > '9') {
            return false;
        }
    }
    return true;
}

function verifierRetrait($telephone, $montant) {
    global $wallets;
    $telephone = trim($telephone);
    $montant = (float)trim($montant);

    if ($montant <= 0) return false;
    if (!isset($wallets) || empty($wallets)) return false;

    require_once "services.php";
    $frais = calculerFraisRetrait($montant);
    $sommeTotale = $montant + $frais;

    $walletsTrouves = array_filter($wallets, fn($wallet) => trim($wallet['telephone']) === $telephone);

    if (empty($walletsTrouves)) {
        return false;
    }

    $walletClient = current($walletsTrouves);

    return $walletClient['solde'] >= $sommeTotale;
}

?>
