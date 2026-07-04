<?php


require_once 'utils/utils.php';
require_once 'view/view.medecin.php';
require_once 'validator/medecin.validator.php';
require_once 'service/medecin.service.php';
require_once 'controller/controller.php';



function menuMedecin() {
    $medecinId = (int)lireEntree("Identifiant du médecin : ");
    $retour = false;
    while (!$retour) {
        afficherMenuMedecin();
        switch (lireEntree("Votre choix : ")) {
            case '1':
                traiterGenerationCreneaux($medecinId);
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