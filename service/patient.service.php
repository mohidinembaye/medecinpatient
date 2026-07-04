<?php

function obtenirPatientParId($patientId) {
    global $patients;
    foreach ($patients as $patient) {
        if ($patient['id'] === $patientId) {
            return $patient;
        }
    }
    return null;
}
function obtenirRendezVousAVenir($patientId) {
    global $creneaux;
    $resultats = [];
    foreach ($creneaux as $creneau) {
        if (
            isset($creneau['patientId'])
            && $creneau['patientId'] === $patientId
            && $creneau['statut'] === 'Réservé'
            && strtotime($creneau['date']) >= strtotime(date('Y-m-d'))
        ) {
            $resultats[] = $creneau;
        }
    }
    return $resultats;
}