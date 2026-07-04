<?php

function afficherMenuPatient() {
    echo "\n----- ESPACE PATIENT : RECHERCHE DE MEDECIN -----\n";
    echo "1. Rechercher un médecin\n";
    echo "2. Annuler un rendez-vous\n"; // ajout
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
function saisirConfirmationReservation() {
    $reponse = lireEntree("Confirmez-vous la réservation de ce créneau ? (O/N) : ");
    return strtoupper(trim($reponse)) === 'O';
}
function afficherRendezVousAVenir($rendezVous) {
    if (empty($rendezVous)) {
        echo "Vous n'avez aucun rendez-vous à venir.\n";
        return;
    }
    echo "\n--- Vos rendez-vous à venir ---\n";
    foreach ($rendezVous as $rdv) {
        echo $rdv['id'] . ". " . $rdv['date']
            . " : " . $rdv['heureDebut'] . " - " . $rdv['heureFin']
            . " (médecin id " . $rdv['medecinId'] . ")\n";
    }
}

function saisirSelectionRendezVousAAnnuler() {
    $id = lireEntree("Identifiant du rendez-vous à annuler : ");
    return (int)$id;
}
function saisirConfirmationAnnulation() {
    $reponse = lireEntree("Confirmez-vous l'annulation de ce rendez-vous ? (O/N) : ");
    return strtoupper(trim($reponse)) === 'O';
}
