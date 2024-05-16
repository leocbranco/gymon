<?php

if(isset($_POST['register']))
{
    include_once('cfg.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $CPF = $_POST['cpf'];
    $genero = $_POST['genero'];
    $data_nasc = $_POST['data_nasc'];

    $regex_nome = "/^[a-zA-Z\s]+$/";
    $regex_email = "/^\S+@\S+\.\S+$/";
    $regex_senha = "/^.{6,}$/"; 
    $regex_cpf = "/^\d{3}\.\d{3}\.\d{3}-\d{2}$/";
    $regex_genero = "/^(Masculino|Feminino|Outro)$/i";

    if(!preg_match($regex_nome, $nome)) {
        echo "Nome inválido. Por favor, insira apenas letras e espaços.";
        exit();
    }

    if(!preg_match($regex_email, $email)) {
        echo "Email inválido. Por favor, insira um endereço de email válido.";
        exit();
    }

    if(!preg_match($regex_senha, $senha)) {
        echo "Senha inválida. A senha deve ter pelo menos 6 caracteres.";
        exit();
    }

    if(!preg_match($regex_cpf, $CPF)) {
        echo "CPF inválido. Por favor, insira um CPF válido no formato XXX.XXX.XXX-XX.";
        exit();
    }
    
    $result = mysqli_query($conex, "INSERT INTO Aluno(Nome_Aluno,Email_Aluno,Senha_Aluno,CPF_Aluno,Genero_Aluno,DataNasc_Aluno) VALUES ('$nome','$email','$senha','$CPF','$genero','$data_nasc')");

    if($result) {
        header("Location: login-aluno.php");
        exit(); 
    } else {
        echo "Erro ao registrar-se. Por favor, tente novamente.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="stylesheet" href="css/style-registro.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        .register-image {
            width: 30%;
            background-image: url('assets/academia.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 0 10px 10px 0;
            margin-right: 200px;
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-image"></div>
    <div class="register-form">
        <h2>Registro Aluno GymON</h2>
        <p class="register-intro">Seja bem-vindo à nossa comunidade de bem-estar e saúde! <br>
            É um prazer tê-lo conosco na jornada rumo a uma vida mais ativa e saudável. </p>
            <form id="registerForm" method="POST" action="registro-aluno.php">
                <input type="text" name="nome" id="nome" placeholder="Nome:" class="register-input" required pattern="[a-zA-Z\u00C0-\u00FF]+( [a-zA-Z\u00C0-\u00FF]+)*$" title="Nome e Sobrenomes">
                <input type="email" name="email" id="email" placeholder="Email:" class="register-input" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Formato válido: usuario@dominio.com">
                <input type="password" name="senha" id="senha" placeholder="Senha:" class="register-input" required pattern=".{8,}" title="Mínimo de 8 caracteres">
                <input type="text" name="cpf" id="cpf" placeholder="CPF:" class="register-input" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato válido: XXX.XXX.XXX-XX" maxlength="14">

            <div class="gender-container">
                <select name="genero" id="genero" class="register-input" required>
                    <option value="" disabled selected hidden>Gênero</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <input type="date" name="data_nasc" id="data_nasc" placeholder="Data de Nascimento:" class="register-input" required>
            <br>
            <hr class="line-separator">
            <br>
            <button type="submit" name="register" value="Registrar-se" class="register-button">Registrar-se</button>
        </form>
        <p>Você já possui cadastro? <a href="login-aluno.php" class="login-link">Sign in</a></p>
    </div>
</div>

<script>
    document.getElementById('crefFileInput').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.file-upload-button');
        label.textContent = fileName;
    });

</script>
</body>
</html>