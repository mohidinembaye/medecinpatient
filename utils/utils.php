<?php
function lireEntree($message) {
    echo $message;
    return trim(fgets(STDIN));
}
function heureEnMinutes($heure) {
    $parties = explode(':', $heure);
    return ((int)$parties[0] * 60) + (int)$parties[1];
}