<?php
function lireEntree($message) {
    echo $message;
    return trim(fgets(STDIN));
}