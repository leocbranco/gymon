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
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>GymON</title>
    <style>
        body{
             background: linear-gradient(
                233deg,
                rgba(211, 211, 211, 1) 1%,
                rgba(160, 0, 0, 1) 29%,
                rgba(0, 0, 0, 1) 60%
            );
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
        }

        .area-login{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .login{
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: green;
            border-radius: 10px;
            width: 355px;
            height: 520px;
            padding: 35px;
        }

        .login form{
            display: flex;
            width: 100%;
            flex-direction: column;
        }

        .login input{
            margin-top: 10px;
            background-color: #252A34;
            padding-left: 10px;
            color: white;
            border: none;
            height: 45px;
            outline: none; 
            border-radius: 8px;
        }

        .login img{
            width: 70px;
            height: auto;
        }

        input::placeholder{
            color: white;
            font-size: 14px;
        }

        form [type="submit"]{
            display: block;
            background-color: #181920;
            font-size: 14px;
            text-transform: uppercase;  
            font-weight: bold;
            cursor: pointer;
        }

        p{
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <a href="registrar.php">Voltar</a>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="assets/logo-gymon.jpeg">
            </div>
            <form id="registerForm" method="POST" action="registro-aluno.php">
                <input type="text" name="nome" id="nome" placeholder="Nome:" autofocus>
                <div id="nomeError" style="color: red;"></div>
                <input type="text" name="email" id="email" placeholder="E-mail:">
                <div id="emailError" style="color: red;"></div>
                <input type="password" name="senha" id="senha" placeholder="Senha:">
                <div id="senhaError" style="color: red;"></div>
                <input type="text" name="cpf" id="cpf" placeholder="CPF:">
                <div id="cpfError" style="color: red;"></div>
                <input type="text" name="genero" id="genero" placeholder="Gênero:">
                <div id="generoError" style="color: red;"></div>
                <input type="date" name="data_nasc" id="data_nasc" placeholder="Data de Nascimento:">
                <div id="data_nascError" style="color: red;"></div>
                <input type="submit" name="register" value="Registrar-se">
            </form>
        </div>
    </section>

    <script>
        function setErrorColor(elementId, isError) {
            var errorElement = document.getElementById(elementId);
            if (isError) {
                errorElement.style.color = 'red'; o
            } else {
                errorElement.style.color = 'transparent'; 
            }
        }

        document.getElementById('nome').addEventListener('input', function() {
            var nome = this.value.trim();
            var regex = /^[a-zA-Z\s]+$/;
            var isError = !regex.test(nome);
            setErrorColor('nomeError', isError);
            document.getElementById('nomeError').textContent = isError ? 'Nome inválido. Por favor, insira apenas letras e espaços.' : '';
        });

        document.getElementById('email').addEventListener('input', function() {
            var email = this.value.trim();
            var regex = /^\S+@\S+\.\S+$/;
            var isError = !regex.test(email);
            setErrorColor('emailError', isError);
            document.getElementById('emailError').textContent = isError ? 'Email inválido. Por favor, insira um endereço de email válido.' : '';
        });

        document.getElementById('senha').addEventListener('input', function() {
            var senha = this.value.trim();
            var regex = /^.{6,}$/;
            var isError = !regex.test(senha);
            setErrorColor('senhaError', isError);
            document.getElementById('senhaError').textContent = isError ? 'Senha inválida. A senha deve ter pelo menos 6 caracteres.' : '';
        });

        document.getElementById('cpf').addEventListener('input', function() {
            var cpf = this.value.trim();
            var regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            var isError = !regex.test(cpf);
            setErrorColor('cpfError', isError);
            document.getElementById('cpfError').textContent = isError ? 'CPF inválido. Por favor, insira um CPF válido no formato XXX.XXX.XXX-XX.' : '';
        });

        document.getElementById('genero').addEventListener('input', function() {
            var genero = this.value.trim();
            var regex = /^(Masculino|Feminino|Outro)$/i;
            var isError = !regex.test(genero);
            setErrorColor('generoError', isError);
            document.getElementById('generoError').textContent = isError ? "Gênero inválido. Por favor, insira 'Masculino', 'Feminino' ou 'Outro'." : '';
        });
    </script>
</body>
</html>
