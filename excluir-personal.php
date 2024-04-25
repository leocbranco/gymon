<?php
    include_once('cfg.php');

    $id = $_GET['ID_Personal'];
        
    $sqlDelete = "DELETE FROM Personal WHERE ID_Personal = $id";
    $resultDelete = $conex->query($sqlDelete);

    if ($resultDelete) {
        header('Location: home.php');
        exit; 
    } else {
        echo "Erro ao excluir usuário.";
    }

?>
