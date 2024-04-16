<?php  
    session_start();
    if(isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        include_once('cfg.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM Personal WHERE Email_Personal = '$email' and Senha_Personal = '$senha'";
        $result = $conex->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            unset($_SESSION['id']);
            header('Location: login-personal.php');
        }
        else
        {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['ID_Personal'];
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: home-personal.php');
            
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Hoot Note</title>
    <style>
        body{
            background-color: #1B1F27;
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
            background-color: #d63a25;
            border-radius: 10px;
            width: 355px;
            height: 320px;
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
            color: #CBD0F7;
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
            color: #CBD0F7;
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
            color: #CBD0F7;
        }

        a{
            color:#5568FE;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="assets/logo-gymon.jpeg">
            </div>
            <form method="POST" action="">
                <input type="text" name="email" placeholder="E-mail:" autofocus>
                <input type="password" name="senha" placeholder="Senha:">
                <input type="submit" name="login" value="entrar">
            </form>
            <p>Ainda não tem uma conta? <a href="registrar.php">Criar Conta</a></p>
        </div>
    </section>
</body>
</html>
