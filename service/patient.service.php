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