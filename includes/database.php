<?php

$db = mysqli_connect('localhost', 'root', '0000', 'clinica_confident');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}