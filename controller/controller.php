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
function traiterRechercheMedecin() {
    afficherTitre("Recherche d'un médecin");

    $saisie = saisirRechercheMedecin();

   
}