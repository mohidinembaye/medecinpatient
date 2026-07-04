<?php
function traiterGenerationCreneaux($medecinId) {
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

    $creneauxGeneres = genererListeCreneaux($medecinId, $saisie['date'], $saisie['heureDebut'], $saisie['heureFin'], (int)$saisie['duree']);

    afficherTitre("Créneaux générés (non encore enregistrés)");
    foreach ($creneauxGeneres as $creneau) {
        echo $creneau['heureDebut'] . " - " . $creneau['heureFin'] . " (" . $creneau['statut'] . ")\n";
    }
}
