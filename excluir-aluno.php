<?php
    include_once('cfg.php');

    $id = $_GET['ID_Aluno'];
        
    $sqlDelete = "DELETE FROM aluno WHERE ID_Aluno = $id";
    $resultDelete = $conex->query($sqlDelete);

    if ($resultDelete) {
        header('Location: crud-aluno.php');
        exit; 
    } else {
        echo "Erro ao excluir usuário.";
    }

?>
