<?php
session_start();

if (!isset($_SESSION['id_personal'])) {
    header('Location: login-personal.php');
    exit();
}

function verificaPersonal($conex, $idPersonal) {
    if ($idPersonal != $_SESSION['id_personal']) {
        die('Acesso não autorizado.');
    }
}
?>
