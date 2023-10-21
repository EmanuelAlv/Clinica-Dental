<?php

$db = mysqli_connect(
    'confidentgt.com', 
    'u163179695_admin', 
    'lololoco.A12', 
    'u163179695_confident'
);

// $db->set_charset('UTF-8');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
