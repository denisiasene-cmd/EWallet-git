<?php
include_once "controller.php";

do {
    echo "\n-------- Menu Distributeur --------\n";
    echo "1 - Créer Wallet\n";
    echo "2 - Faire Dépôt\n";
    echo "3 - Faire Retrait\n";
    echo "4 - Lister les Transactions\n";
    echo "0 - Quitter\n";

    $choix = trim(readline("Veuillez donner votre choix : "));

    verifierChoix($choix);

} while ($choix !== "0");
?>
