<?php


require_once 'utils/utils.php';
require_once 'view/view.medecin.php';
require_once 'validator/medecin.validator.php';


function menuMedecin() {
    $retour = false;
    while (!$retour) {
        afficherMenuMedecin();
        switch (lireEntree("Votre choix : ")) {
            case '1':
                traiterSaisieDisponibilites();
                break;
            case '0':
                $retour = true;
                break;
            default:
                afficherErreur("Choix invalide");
        }
    }
}


function traiterSaisieDisponibilites() {
    afficherTitre("Définir mes disponibilités");
    $saisie = saisirDisponibilites();

    $resultat = validerDateFuture($saisie['date']);
    if ($resultat !== "ok") { afficherErreur($resultat); return; }

    $resultat = validerFormatHeure($saisie['heureDebut']);
    if ($resultat !== "ok") { afficherErreur($resultat); return; }

    $resultat = validerFormatHeure($saisie['heureFin']);
    if ($resultat !== "ok") { afficherErreur($resultat); return; }

    $resultat = validerPlageHoraire($saisie['heureDebut'], $saisie['heureFin']);
    if ($resultat !== "ok") { afficherErreur($resultat); return; }

    $resultat = validerDureeConsultation($saisie['duree']);
    if ($resultat !== "ok") { afficherErreur($resultat); return; }

    afficherConfirmation("Saisie valide (date, heures, durée) — génération des créneaux à venir");
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