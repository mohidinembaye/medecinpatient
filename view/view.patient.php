<?php

function afficherMenuPatient() {
    echo "\n----- ESPACE PATIENT : RECHERCHE DE MEDECIN -----\n";
    echo "1. Rechercher un médecin\n";
    echo "0. Retour\n";
}

function saisirRechercheMedecin() {
    $specialite = lireEntree("Spécialité recherchée : ");
    return ['specialite' => $specialite];
}
function afficherListeMedecins($medecins) {
    if (empty($medecins)) {
        echo "Aucun médecin trouvé pour cette spécialité.\n";
        return;
    }
    echo "\n--- Médecins disponibles ---\n";
    foreach ($medecins as $medecin) {
        echo $medecin['id'] . ". Dr " . $medecin['nom']
            . " - " . $medecin['specialite']
            . " - " . $medecin['localisation'] . "\n";
    }
}