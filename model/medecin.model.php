<?php


$medecins = [
    ['id' => 1, 'nom' => 'Sow', 'specialite' => 'Généraliste', 'localisation' => 'Dakar', 'email' => 'dr.sow@sante.sn'],
    ['id' => 2, 'nom' => 'Ndiaye', 'specialite' => 'Dentiste', 'localisation' => 'Thiès', 'email' => 'dr.ndiaye@sante.sn'],
];
$creneaux = [];
function ajouterCreneau($creneau) {
    global $creneaux;
    $creneau['id'] = genererId($creneaux);
    $creneaux[] = $creneau;
    return $creneau['id'];
}