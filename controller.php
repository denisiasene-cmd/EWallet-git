<?php

function verifierChoix($choix) {
    switch ($choix) {
        case '1':
            echo "\n--- FORMULAIRE DE CRÉATION DE WALLET ---\n";
            $nom = readline("Entrez le nom : ");
            $telephone = readline("Entrez le numéro de téléphone : ");
            $solde = readline("Entrez le solde initial : ");
            $code = readline("Entrez le code secret (4 chiffres) : ");
            
            echo "Creer wallet\n";
            break;
            
        case '2':
            echo "\n--- FORMULAIRE DE DÉPÔT ---\n";
            $telephone = readline("Entrez le numéro de téléphone du bénéficiaire : ");
            $montant = readline("Entrez le montant à déposer : ");
            
            echo "faire un depots\n";
            break;
            
        case '3':
            echo "\n--- FORMULAIRE DE RETRAIT ---\n";
            $telephone = readline("Entrez votre numéro de téléphone : ");
            $montant = readline("Entrez le montant à retirer : ");
            
            echo "faire un retrait\n";
            break;
            
        case '4':
            echo " HISTORIQUE DES TRANSACTIONS\n";
            echo "Chargement de la liste...\n";
            break;
            
        case '0':
            echo " quitter\n";
            break;
            
        default:
            echo " Choix invalide, veuillez réessayer.\n";
            break;
    }
}
?>
