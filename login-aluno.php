<?php  
    session_start();
    if(isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        include_once('cfg.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM Aluno WHERE Email_Aluno = '$email' and Senha_Aluno = '$senha'";
        $result = $conex->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            unset($_SESSION['id']);
            header('Location: login-aluno.php');
        }
        else
        {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['ID_Personal'];
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: home-aluno.php');
            
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
            justify-content: center; 
            height: 100vh;
            overflow: hidden;
        }

        .register-container {
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

        .logo {
            width: 90px; 
            height: auto; 
            margin-bottom: 20px; 
        }

        .register-form {
            width: 100%;
            max-width: 400px; 
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

        .register-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #4F4F4F;
            background-color: transparent;
            color: white;
            font-size: 14px;
            box-sizing: border-box;
        }

        .line-separator {
            width: 100%;
            border: none;
            border-top: 1px solid #4F4F4F;
            margin-bottom: 20px;
        }

        .register-button {
            width: 100%;
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

        .login-link {
            color: #1E90FF;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media only screen and (max-width: 768px) {
            .register-form input,
            .register-form select {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <img src="assets/logo-gymon.jpeg" alt="GymON Logo" class="logo">
    <div class="register-form">
        <form id="registerForm" method="POST" action="">
            <input type="email" name="email" id="email" placeholder="Email:" class="register-input" required autofocus>
            <input type="password" name="senha" id="senha" placeholder="Senha:" class="register-input" required>
            <hr class="line-separator">
            <br>
            <button type="submit" name="login" value="entrar" class="register-button">Entrar</button>
        </form>
        <p>Ainda não possui uma conta? <a href="registro-aluno.php" class="login-link">Sign in</a></p>
    </div>
</div>
</body>
</html>
