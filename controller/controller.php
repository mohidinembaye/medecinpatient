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

    
}