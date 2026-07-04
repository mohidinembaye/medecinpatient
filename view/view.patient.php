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

function afficherAgendaMedecin($creneaux) {
    if (empty($creneaux)) {
        echo "Aucun créneau libre disponible pour ce médecin.\n";
        return;
    }
    echo "\n--- Créneaux libres ---\n";
    foreach ($creneaux as $creneau) {
        echo $creneau['id'] . ". " . $creneau['date']
            . " : " . $creneau['heureDebut'] . " - " . $creneau['heureFin'] . "\n";
    }
}

function saisirSelectionCreneau() {
    $id = lireEntree("Identifiant du créneau souhaité : ");
    return (int)$id;
}