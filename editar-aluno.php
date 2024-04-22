<?php
include_once('cfg.php');

if(!empty($_GET['ID_Aluno']))
    {
        include_once('cfg.php');

        $id = $_GET['ID_Aluno'];

        $sqlSelect = "SELECT * FROM aluno WHERE ID_Aluno=$id";

        $result = $conex->query($sqlSelect);

        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
            $nome = $user_data['Nome_Aluno'];
            $email = $user_data['Email_Aluno'];
            $senha = $user_data['Senha_Aluno'];
            $CPF = $user_data['CPF_Aluno'];
            $genero = $user_data['Genero_Aluno'];
            $data_nasc = $user_data['DataNasc_Aluno'];
            }
        }
        else
        {
            header('Location crud-aluno.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
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
            background-color: #9370DB;
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
            color: #CBD0F7;
            border: none;
            height: 45px;
            outline: none; 
            border-radius: 8px;
        }

        .login img{
            width: 100px;
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
            color:#CBD0F7;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <a href="crud-aluno.php">Voltar</a>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="logo.png">
            </div>
            <form method="POST" action="atualizar-aluno.php">
                <input type="text" name="nome" value="<?php echo $nome?>" placeholder="Nome:" autofocus>
                <input type="text" name="email" value="<?php echo $email?>" placeholder="E-mail:">
                <input type="password" name="senha" value="<?php echo $senha?>" placeholder="Senha:">
                <input type="text" name="cpf" value="<?php echo $CPF?>" placeholder="CPF:">
                <input type="text" name="genero" value="<?php echo $genero?>" placeholder="Gênero:">
                <p>Data de Nascimento:</p>
                <input type="date" name="data_nasc" value="<?php echo $data_nasc?>" placeholder="Data de Nascimento:">
                <input href="crud-aluno.php" type="submit" name="update" value="Salvar">
                <input type="hidden" name="ID_Aluno" id="update" value='<?php echo $id ?>'>
            </form>
        </div>
    </section>
</body>
</html>