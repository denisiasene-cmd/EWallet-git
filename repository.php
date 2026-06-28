<?php

$wallets = [
    [
        "telephone" => "771001010",
        "nom" => "Baila Wane",
        "code" => "1234",
        "solde" => 50000
    ],
    [
        "telephone" => "782345678",
        "nom" => "Hawa Baila Wane",
        "code" => "5678",
        "solde" => 100000
    ]
];

$transactions = [];

function enregistrerWallet($nom, $telephone, $code, $solde){
    global $wallets;

    $wallets[] = [
        "telephone" => $telephone,
        "nom" => $nom,
        "code" => $code,
        "solde" => $solde
    ];

    return true;
}

function calculerFraisRetrait($montant) {
    $frais = 0;

    if ($montant >= 0 && $montant <= 10000) {
        $frais = 200;
    } 
  
    if ($montant > 10000 && $montant <= 100000) {
        $frais = 500;
    } 
 
    if ($montant > 100000) {
        $frais = $montant * 0.01; 
        
        if ($frais > 5000) {
            $frais = 5000;
        }
    }

    return (int) $frais;
}

function faireDepots($telephone, $montant){
    global $wallets;

    $montant = (float)$montant; 

    foreach ($wallets as &$wallet) {
        if ($wallet['telephone'] === $telephone){
            $wallet['solde'] += $montant;
            ajouterTransaction($telephone, 'depot', $montant, 0);
            return true; 
        }
    }
    return false; 
}

function faireRetrait($telephone, $montant) {
    global $wallets;

    $frais = calculerFraisRetrait($montant);
    $sommeTotale = $montant + $frais;

    foreach ($wallets as &$wallet) {
        if ($wallet['telephone'] === $telephone) {
            if ($wallet['solde'] >= $sommeTotale) {
                $wallet['solde'] = $wallet['solde'] - $sommeTotale;
                ajouterTransaction($telephone, 'retrait', $montant, $frais);
                return true;
            }
        }
    }
    return false;
}

function ajouterTransaction($telephone, $type, $montant, $frais = 0) {
    global $transactions;
    $transactions[] = [
        "telephone" => $telephone,
        "type" => $type, 
        "montant" => (int)$montant,
        "frais" => (int)$frais
    ];
}

function listerTransactions() {
    global $transactions;

    if (empty($transactions)) {
        echo "Aucune transaction enregistrée pour le moment.\n";
        return;
    }

    echo "LISTE DES TRANSACTIONS\n";
    foreach ($transactions as $t) {
        echo "Téléphone : " . $t['telephone'] . " | Type : " . strtoupper($t['type']) . " | Montant : " . $t['montant'] . " FCFA | Frais : " . $t['frais'] . " FCFA\n";
    }
}
?>
