<?php
require_once "validator.php";
require_once "repository.php";

function verifierChoix($choix) {
    switch ($choix) {
        case '1':
            echo "\n--- FORMULAIRE DE CRÉATION DE WALLET ---\n";
            $nom = readline("Entrez le nom : ");
            $telephone = readline("Entrez le numéro de téléphone : ");
            $solde = readline("Entrez le solde initial : ");
            $code = readline("Entrez le code secret (4 chiffres) : ");
            
            if (!controlerNom($nom) || !controlerSolde($solde) || !controlerCode($code) || !controllerNumero($telephone)) {
                echo "\n Erreur : Données invalides, vérifiez les champs.\n";
            } else {
                if (enregistrerWallet($nom, $telephone, $code, $solde)) {
                    echo "\n Succès : Le Wallet a été créé avec succès pour $nom !\n";
                }
            }
            break;
            
        case '2':
            echo "\n--- FORMULAIRE DE DÉPÔT ---\n";
            $telephone = readline("Entrez le numéro de téléphone du bénéficiaire : ");
            $montant = readline("Entrez le montant à déposer : ");
            
            if (faireDepots($telephone, $montant)) {
                echo "\n Dépôt réussi !\n";
            } else {
                echo "\n Échec du dépôt. Numéro introuvable.\n";
            }
            break;
            
        case '3':
            echo "\n--- FORMULAIRE DE RETRAIT ---\n";
            $telephone = readline("Entrez votre numéro de téléphone : ");
            $montant = readline("Entrez le montant à retirer : ");
            
            if (faireRetrait($telephone, $montant)) {
                echo "\n Retrait réussi !\n";
            } else {
                echo "\n Échec du retrait. Solde insuffisant ou numéro introuvable.\n";
            }
            break;
            
        case '4':
            echo "\n--- HISTORIQUE DES TRANSACTIONS ---\n";
            listerTransactions();
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
