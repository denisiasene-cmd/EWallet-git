<?php

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
?>
