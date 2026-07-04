<?php

function afficherTitre($titre) {
    echo "\n=== " . $titre . " ===\n";
}


function afficherConfirmation($message) {
    echo "[OK] " . $message . "\n";
}


function afficherErreur($message) {
    echo "[ERREUR] " . $message . "\n";
}


function afficherMenuPrincipal() {
    echo "\n===== PLATEFORME DE PRISE DE RENDEZ-VOUS MEDICAUX =====\n";
    echo "1. Espace Médecin\n";
    echo "0. Quitter\n";
}


function afficherMenuMedecin() {
    echo "\n----- ESPACE MEDECIN : GESTION D'AGENDA -----\n";
    echo "1. Définir mes disponibilités\n";
    echo "0. Retour\n";
}