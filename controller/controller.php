<?php
function traiterDefinitionDisponibilites($medecinId) {
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

    $confirmation = enregistrerDisponibilites($medecinId, $saisie['date'], $saisie['heureDebut'], $saisie['heureFin'], (int)$saisie['duree']);
    afficherConfirmation($confirmation);
}
function traiterRechercheMedecin($patientId) {
    afficherTitre("Recherche d'un médecin");

    $saisie = saisirRechercheMedecin();

    $medecinsTrouves = rechercherMedecinsParSpecialite($saisie['specialite']);

    afficherListeMedecins($medecinsTrouves);

    if (empty($medecinsTrouves)) {
        return;
    }

    $medecinId = saisirSelectionMedecin();

    $resultat = validerIdMedecinExiste($medecinId, $medecinsTrouves);
    if ($resultat !== "ok") {
        afficherErreur($resultat);
        return;
    }

    $creneauxLibres = obtenirCreneauxLibres($medecinId);
    afficherAgendaMedecin($creneauxLibres);

    if (empty($creneauxLibres)) {
        return;
    }

    traiterPriseRendezVous($patientId, $creneauxLibres);
}
function traiterPriseRendezVous($patientId, $creneauxLibres) {
    afficherTitre("Prise de rendez-vous");

    $creneauId = saisirSelectionCreneau();

    $resultat = validerCreneauDansListe($creneauId, $creneauxLibres);
    if ($resultat !== "ok") {
        afficherErreur($resultat);
        return;
    }

    $confirme = saisirConfirmationReservation();
    if (!$confirme) {
        afficherConfirmation("Réservation annulée par le patient");
        return;
    }

    if (!creneauEstLibre($creneauId)) {
        afficherErreur("Ce créneau vient d'être réservé par un autre patient, veuillez en choisir un autre");
        return;
    }

    $creneauReserve = reserverCreneau($creneauId, $patientId);

    $patient = obtenirPatientParId($patientId);
    if ($patient !== null) {
        envoyerEmailConfirmation($patient['email'], $creneauReserve);
    }

    afficherConfirmation("Rendez-vous réservé avec succès pour le " . $creneauReserve['date']
        . " de " . $creneauReserve['heureDebut'] . " à " . $creneauReserve['heureFin']);
}
function traiterAnnulationRendezVous($patientId) {
    afficherTitre("Annulation d'un rendez-vous");

    $rendezVousAVenir = obtenirRendezVousAVenir($patientId);
    afficherRendezVousAVenir($rendezVousAVenir);

    if (empty($rendezVousAVenir)) {
        return;
    }

    $creneauId = saisirSelectionRendezVousAAnnuler();

    $resultat = validerCreneauDansListe($creneauId, $rendezVousAVenir);
    if ($resultat !== "ok") {
        afficherErreur($resultat);
        return;
    }

    $confirme = saisirConfirmationAnnulation();
    if (!$confirme) {
        afficherConfirmation("Annulation abandonnée, le rendez-vous est maintenu");
        return;
    }

    $creneauLibere = libererCreneau($creneauId);

    afficherConfirmation("Rendez-vous annulé, le créneau du " . $creneauLibere['date']
        . " de " . $creneauLibere['heureDebut'] . " à " . $creneauLibere['heureFin']
        . " est de nouveau disponible");

}