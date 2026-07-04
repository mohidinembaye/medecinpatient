<?php


require_once 'utils/utils.php';
require_once 'view/view.medecin.php';


function menuMedecin() {
    $retour = false;
    while (!$retour) {
        afficherMenuMedecin();
        switch (lireEntree("Votre choix : ")) {
            case '1':
                afficherTitre("Définir mes disponibilités");
                break;
            case '0':
                $retour = true;
                break;
            default:
                afficherErreur("Choix invalide");
        }
    }
}

$quitter = false;
while (!$quitter) {
    afficherMenuPrincipal();
    switch (lireEntree("Votre choix : ")) {
        case '1': menuMedecin(); break;
        case '0': $quitter = true; break;
        default: afficherErreur("Choix invalide");
    }
}

echo "\nFermeture de l'application. À bientôt !\n";