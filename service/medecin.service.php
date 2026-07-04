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
