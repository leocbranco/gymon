<?php
include_once('cfg.php');
require 'personal_auth.php'; 

if(isset($_POST['update']))
{
    $id = $_POST['ID_Personal'];

    if ($id != $_SESSION['id_personal']) {
        header('Location: acesso-negado.php');
        exit();
    }

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $genero = $_POST['genero'];
    $data_nasc = $_POST['data_nasc'];

    $sqlUpdate = "UPDATE Personal SET Nome_Personal=?, Senha_Personal=?, Genero_Personal=?, DataNasc_Personal=? WHERE ID_Personal=?";
    $stmt = $conex->prepare($sqlUpdate);
    $stmt->bind_param('ssssi', $nome, $senha, $genero, $data_nasc, $id);
    $stmt->execute();

    header('Location: crud-personal.php');
    exit();
} else {
    header('Location: crud-personal.php');
    exit();
}
?>
