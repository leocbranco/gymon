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

        if(!preg_match($regex_genero, $genero)) {
            echo "Gênero inválido. Por favor, insira 'Masculino', 'Feminino' ou 'Outro'.";
            exit();
        }

        $result = mysqli_query($conex, "INSERT INTO Personal(Nome_Personal,Email_Personal,Senha_Personal,CPF_Personal,Genero_Personal,DataNasc_Personal) VALUES ('$nome','$email','$senha','$CPF','$genero','$data_nasc')");

        if($result) {
            header("Location: login-personal.php"); 
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
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1C1C1C;
            color: white;
            display: flex;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .register-container {
            display: flex;
            width: 100%;
            height: 100%;
            background-color: #1C1C1C;
            justify-content: flex-start;
        }

        .register-image {
            width: 30%;
            background-image: url('assets/gym.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 0 10px 10px 0;
            margin-right: 200px;
        }

        .register-form {
            margin-top: 1%;
            width: 70%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: left;
        }

        .register-form h2 {
            margin-bottom: 15px;
            text-align: left;
            margin-right: 50px;
        }

        .register-intro {
            font-size: 12px;
            color: #999;
            margin-bottom: 40px;
            margin-top: 0;
            text-align: left;
        }

        .register-input {
            width: 100%;
            max-width: 700px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #4F4F4F;
            background-color: transparent;
            color: white;
            font-size: 14px;
            box-sizing: border-box;
        }

        .register-input:hover {
            border-color: white;
        }

        .file-upload-container {
            text-align: center;
        }

        .file-upload-button {
            font-size: 14px;
            width: 100%;
            max-width: 660px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            padding: 10px 20px;
            background-color: #800000;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .file-upload-button:hover {
            background-color: #329834;
        }

        .login-link {
            color: #1E90FF;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .line-separator {
            width: 100%;
            max-width: 700px;
            margin-left: 0;
            border: none;
            border-top: 1px solid #4F4F4F;
        }

        .register-button {
            width: 100%;
            max-width: 150px;
            padding: 10px;
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .register-button:hover {
            background-color: #0056b3;
        }

        .register-input option {
            color: black;
        }

        @media only screen and (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }

            .register-image {
                border-radius: 10px 10px 0 0;
                height: auto;
                width: 100%;
            }

            .register-form input,
            .register-form select {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-image"></div>
    <div class="register-form">
        <h2>Registro Personal GymON</h2>
        <p class="register-intro">É um prazer recebê-lo(a) aqui. Estamos empolgados em tê-lo(a) aqui! Ao se registrar, você <br>
            está dando o primeiro passo em direção a uma jornada de transformação pessoal e conquistas.</p>
        <form id="registerForm" method="POST" action="registro-personal.php">
            <input type="text" name="nome" id="nome" placeholder="Nome:" class="register-input" required autofocus>
            <input type="email" name="email" id="email" placeholder="Email:" class="register-input" required>
            <input type="password" name="senha" id="senha" placeholder="Senha:" class="register-input" required>
            <input type="text" name="cpf" id="cpf" placeholder="CPF:" class="register-input" required>
            <div class="gender-container">
                <select name="genero" id="genero" class="register-input" required>
                    <option value="" disabled selected hidden>Gênero</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <input type="date" name="data_nasc" id="data_nasc" placeholder="Data de Nascimento:" class="register-input" required>
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
    document.getElementById('crefFileInput').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.file-upload-button');
        label.textContent = fileName;
    });
</script>
</body>
</html>