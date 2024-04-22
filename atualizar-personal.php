<?php
    include_once('cfg.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['ID_Personal'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $CPF = $_POST['cpf'];
        $genero = $_POST['genero'];
        $data_nasc = $_POST['data_nasc'];

        $sqlUpdate = "UPDATE Personal SET Nome_Personal='$nome', Email_Personal='$email', Senha_Personal='$senha', CPF_Personal='$CPF', Genero_Personal='$genero', DataNasc_Personal='$data_nasc' WHERE ID_Personal='$id'";

        $result = $conex->query($sqlUpdate);
        
        header('Location: crud-personal.php');
        exit(); 
    }
?>
x