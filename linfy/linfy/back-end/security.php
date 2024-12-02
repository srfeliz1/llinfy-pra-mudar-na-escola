<?php

require 'config_db.php';

$urls_permitidas = [
    'cursos' => '',
    'login' => '', 
    'register' => '',
];

function validaUrl($destino, $urls_permitidas): void   {
    if(array_key_exists(key: $destino, array: $urls_permitidas)) {
        header(header: "location" . $urls_permitidas[$destino]);
        exit();
    } else {
        die('DEDSEC_system: (Blocked acces)' . $conn->error);
    } 
}
?>