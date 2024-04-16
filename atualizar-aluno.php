<?php
    include_once('cfg.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['ID_Aluno'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $CPF = $_POST['cpf'];
        $genero = $_POST['genero'];
        $data_nasc = $_POST['data_nasc'];

        $sqlUpdate = "UPDATE aluno SET Nome_Aluno='$nome', Email_Aluno='$email', Senha_Aluno='$senha', CPF_Aluno='$CPF', Genero_Aluno='$genero', DataNasc_Aluno='$data_nasc' WHERE ID_Aluno='$id'";

        $result = $conex->query($sqlUpdate);
        
        header('Location: crud-aluno.php');
        exit(); 
    }
?>
