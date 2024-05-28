<?php
require 'valida_cpf.php';

if (isset($_POST['register'])) {
    include_once('cfg.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $CPF = $_POST['cpf'];
    $genero = $_POST['genero'];
    $data_nasc = $_POST['data_nasc'];

    // Remove pontos e traços do CPF
    $CPF = preg_replace('/[^0-9]/', '', $CPF);

    // Valida CPF
    if (!validaCPF($CPF)) {
        echo "<script>alert('CPF inválido. Por favor, insira um CPF válido.'); window.location.href='registro-aluno.php';</script>";
        exit();
    }

    // Verifica se o email já está em uso
    $stmt = $conex->prepare("SELECT * FROM Aluno WHERE Email_Aluno = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Email já está em uso. Por favor, use um email diferente.'); window.location.href='registro-aluno.php';</script>";
        exit();
    }

    // Verifica se o CPF já está em uso
    $stmt = $conex->prepare("SELECT * FROM Aluno WHERE CPF_Aluno = ?");
    $stmt->bind_param("s", $CPF);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('CPF já está em uso. Por favor, use um CPF diferente.'); window.location.href='registro-aluno.php';</script>";
        exit();
    }

    // Insere novo aluno no banco de dados
    $stmt = $conex->prepare("INSERT INTO Aluno (Nome_Aluno, Email_Aluno, Senha_Aluno, CPF_Aluno, Genero_Aluno, DataNasc_Aluno) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $senha, $CPF, $genero, $data_nasc);
    $result = $stmt->execute();

    if ($result) {
        header("Location: login-aluno.php");
        exit();
    } else {
        echo "<script>alert('Erro ao registrar-se. Por favor, tente novamente.'); window.location.href='registro-aluno.php';</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="stylesheet" href="css/styleregistro.css">
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
<div class="back-button-container">
    <a href="home.php" class="back-button">Voltar</a>
</div>
<div class="register-container">
    <div class="register-image"></div>
    <div class="register-form">
        <h2>Registro Aluno GymON</h2>
        <p class="register-intro">Seja bem-vindo à nossa comunidade de bem-estar e saúde! <br>
            É um prazer tê-lo conosco na jornada rumo a uma vida mais ativa e saudável. </p>
        <form id="registerForm" method="POST" action="registro-aluno.php">
            <input type="text" name="nome" id="nome" placeholder="Nome:" class="register-input" required pattern=".+ .+" title="Nome e Sobrenomes">
            <input type="email" name="email" id="email" placeholder="Email:" class="register-input" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\.com" title="Formato válido: usuario@dominio.com">
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
            <input type="date" name="data_nasc" id="data_nasc" placeholder="Data de Nascimento:" class="register-input" required min="1900-01-01" max="<?php echo date('Y-m-d'); ?>">
            <br>
            <hr class="line-separator"> 
            <br>
            <button type="submit" name="register" value="Registrar-se" class="register-button">Registrar-se</button>
        </form>
        <p>Você já possui cadastro? <a href="login-aluno.php" class="login-link">Sign in</a></p>
    </div>
</div>

<script>
    document.getElementById('cpf').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    });
</script>
</body>
</html>
