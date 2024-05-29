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

    $CPF = preg_replace('/[^0-9]/', '', $CPF);

    if (!validaCPF($CPF)) {
        echo "<script>alert('CPF inválido. Por favor, insira um CPF válido.'); window.location.href='registro-personal.php';</script>";
        exit();
    }

    $stmt = $conex->prepare("SELECT * FROM Personal WHERE Email_Personal = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Email já está em uso. Por favor, use um email diferente.'); window.location.href='registro-personal.php';</script>";
        exit();
    }

    $stmt = $conex->prepare("SELECT * FROM Personal WHERE CPF_Personal = ?");
    $stmt->bind_param("s", $CPF);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('CPF já está em uso. Por favor, use um CPF diferente.'); window.location.href='registro-personal.php';</script>";
        exit();
    }

    $stmt = $conex->prepare("INSERT INTO Personal (Nome_Personal, Email_Personal, Senha_Personal, CPF_Personal, Genero_Personal, DataNasc_Personal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $senha, $CPF, $genero, $data_nasc);
    $result = $stmt->execute();

    if ($result) {
        header("Location: login-personal.php");
        exit();
    } else {
        echo "<script>alert('Erro ao registrar-se. Por favor, tente novamente.'); window.location.href='registro-personal.php';</script>";
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
            background-image: url('assets/gym.jpg');
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
            <h2>Registro Personal GymON</h2>
            <p class="register-intro">É um prazer recebê-lo(a) aqui. Estamos empolgados em tê-lo(a) aqui! Ao se registrar, você <br>
                está dando o primeiro passo em direção a uma jornada de transformação pessoal e conquistas.</p>
            <form id="registerForm" method="POST" action="registro-personal.php">
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
                <div class="file-upload-container">
                    <label for="crefFileInput" class="file-upload-button">Selecionar CREF</label>
                    <input type="file" id="crefFileInput" name="cref" accept=".pdf" style="display: none;">
                </div>
                <br>
                <hr class="line-separator">
                <br>
                <button type="submit" name="register" value="Registrar-se" class="register-button">Registrar-se</button>
            </form>
            <p>Você já possui cadastro? <a href="login-personal.php" class="login-link">Sign in</a></p>
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

        document.getElementById('crefFileInput').addEventListener('change', function() {
            var fileName = this.files[0].name;
            var label = document.querySelector('.file-upload-button');
            label.textContent = fileName;
        });
    </script>
</body>
</html>
