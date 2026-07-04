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
function creneauEstLibre($creneauId) {
    global $creneaux;
    foreach ($creneaux as $creneau) {
        if ($creneau['id'] === $creneauId) {
            return $creneau['statut'] === 'Libre';
        }
    }
    return false;
}
function reserverCreneau($creneauId, $patientId) {
    global $creneaux;
    foreach ($creneaux as &$creneau) {
        if ($creneau['id'] === $creneauId) {
            $creneau['statut'] = 'Réservé';
            $creneau['patientId'] = $patientId;
            return $creneau;
        }
    }
    return null;
}

function envoyerEmailConfirmation($email, $creneau) {
    echo "[EMAIL envoyé à " . $email . "] Votre rendez-vous du " . $creneau['date']
        . " de " . $creneau['heureDebut'] . " à " . $creneau['heureFin'] . " est confirmé.\n";
}
function libererCreneau($creneauId) {
    global $creneaux;
    foreach ($creneaux as &$creneau) {
        if ($creneau['id'] === $creneauId) {
            $creneau['statut'] = 'Libre';
            unset($creneau['patientId']);
            return $creneau;
        }
    }
    return null;
}
function notifierMedecinAnnulation($medecin, $creneau) {
    echo "[NOTIFICATION envoyée à " . $medecin['email'] . "] "
        . "Le rendez-vous du " . $creneau['date']
        . " de " . $creneau['heureDebut'] . " à " . $creneau['heureFin']
        . " a été annulé par le patient.\n";
}
function obtenirMedecinParId($medecinId) {
    global $medecins;
    foreach ($medecins as $medecin) {
        if ($medecin['id'] === $medecinId) {
            return $medecin;
        }
    }
    return null;
}
