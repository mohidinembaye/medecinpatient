<?php
function validerDateFuture($date) {
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        return "La date ne peut pas être antérieure à aujourd'hui";
    }
    return "ok";
}


function validerFormatHeure($heure) {
    if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $heure)) {
        return "Format d'heure invalide, attendu HH:MM";
    }
    return "ok";
}


function validerPlageHoraire($heureDebut, $heureFin) {
    if (heureEnMinutes($heureFin) <= heureEnMinutes($heureDebut)) {
        return "L'heure de fin doit être postérieure à l'heure de début";
    }
    return "ok";
}


function validerDureeConsultation($duree) {
    if (!is_numeric($duree) || (int)$duree <= 0) {
        return "La durée de consultation doit être un nombre de minutes positif";
    }
    return "ok";
}
function validerIdMedecinExiste($id, $medecins) {
    foreach ($medecins as $medecin) {
        if ($medecin['id'] === $id) {
            return "ok";
        }
    }
    return "Aucun médecin ne correspond à cet identifiant";
}
