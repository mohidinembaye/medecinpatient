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