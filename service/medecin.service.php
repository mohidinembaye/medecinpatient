<?php
 function genererListeCreneaux($medecinId, $date, $heureDebut, $heureFin, $duree) {
    $creneauxGeneres = [];
    $debut = heureEnMinutes($heureDebut);
    $fin = heureEnMinutes($heureFin);
    $curseur = $debut;
    while ($curseur + $duree <= $fin) {
        $creneauxGeneres[] = [
            'medecinId' => $medecinId,
            'date' => $date,
            'heureDebut' => minutesEnHeure($curseur),
            'heureFin' => minutesEnHeure($curseur + $duree),
            'statut' => 'Libre'
        ];
        $curseur += $duree;
    }
    return $creneauxGeneres;
}
function enregistrerDisponibilites($medecinId, $date, $heureDebut, $heureFin, $duree) {
    $nouveauxCreneaux = genererListeCreneaux($medecinId, $date, $heureDebut, $heureFin, $duree);
    foreach ($nouveauxCreneaux as $creneau) {
        ajouterCreneau($creneau);
    }
    return "Disponibilités enregistrées : " . count($nouveauxCreneaux) . " créneau(x) créé(s) avec le statut Libre";
}
function rechercherMedecinsParSpecialite($specialite) {
    global $medecins;
    $resultats = [];
    foreach ($medecins as $medecin) {
        if (strcasecmp($medecin['specialite'], $specialite) === 0) {
            $resultats[] = $medecin;
        }
    }
    return $resultats;
}
function traiterRechercheMedecin() {
    afficherTitre("Recherche d'un médecin");

    $saisie = saisirRechercheMedecin();

    $medecinsTrouves = rechercherMedecinsParSpecialite($saisie['specialite']);

}
function obtenirCreneauxLibres($medecinId) {
    global $creneaux;
    $resultats = [];
    foreach ($creneaux as $creneau) {
        if ($creneau['medecinId'] === $medecinId && $creneau['statut'] === 'Libre') {
            $resultats[] = $creneau;
        }
    }
    return $resultats;
}