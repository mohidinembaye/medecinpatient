<?php
function lireEntree($message) {
    echo $message;
    return trim(fgets(STDIN));
}
function heureEnMinutes($heure) {
    $parties = explode(':', $heure);
    return ((int)$parties[0] * 60) + (int)$parties[1];
}
function minutesEnHeure($minutes) {
    $h = intdiv($minutes, 60);
    $m = $minutes % 60;
    return sprintf('%02d:%02d', $h, $m);
}
function genererId($tableau) {
    if (empty($tableau)) {
        return 1;
    }
    $ids = array_column($tableau, 'id');
    return max($ids) + 1;
}