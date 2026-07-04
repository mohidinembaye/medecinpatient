<?php

require_once 'utils/utils.php';
require_once 'view/view.medecin.php';
require_once 'view/view.patient.php';      
require_once 'validator/medecin.validator.php';
require_once 'service/medecin.service.php';
require_once 'controller/controller.php';



function menuPatient() {
    $retour = false;
    while (!$retour) {
        afficherMenuPatient();
        switch (lireEntree("Votre choix : ")) {
            case '1':
                traiterRechercheMedecin();
                break;
            case '0':
                $retour = true;
                break;
            default:
                afficherErreur("Choix invalide");
        }
    }
}

switch (lireEntree("Votre choix : ")) {
    case '1': menuMedecin(); break;
    case '2': menuPatient(); break; // ajout
    case '0': $quitter = true; break;
    default: afficherErreur("Choix invalide");
}