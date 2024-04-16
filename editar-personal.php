<?php

    if(!empty($_GET['ID_Personal']))
    {
        include_once('cfg.php');

        $id = $_GET['ID_Personal'];

        $sqlSelect = "SELECT * FROM Personal WHERE ID_Personal=$id";

        $result = $conex->query($sqlSelect);

        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
            $nome = $user_data['Nome_Personal'];
            $email = $user_data['Email_Personal'];
            $senha = $user_data['Senha_Personal'];
            $CPF = $user_data['CPF_Personal'];
            $genero = $user_data['Genero_Personal'];
            $data_nasc = $user_data['DataNasc_Personal'];
            }
        }
        else
        {
            header('Location crud-personal.php');
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
    <a href="crud-personal.php">Voltar</a>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="logo.png">
            </div>
            <form method="POST" action="atualizar-personal.php">
                <input type="text" name="nome" value="<?php echo $nome?>" placeholder="Nome:" autofocus>
                <input type="text" name="email" value="<?php echo $email?>" placeholder="E-mail:">
                <input type="password" name="senha" value="<?php echo $senha?>" placeholder="Senha:">
                <input type="text" name="cpf" value="<?php echo $CPF?>" placeholder="CPF:">
                <input type="text" name="genero" value="<?php echo $genero?>" placeholder="Gênero:">
                <p>Data de Nascimento:</p>
                <input type="date" name="data_nasc" value="<?php echo $data_nasc?>" placeholder="Data de Nascimento:">
                <input href="crud-personal.php" type="submit" name="update" value="Salvar">
                <input type="hidden" name="ID_Personal" id="update" value='<?php echo $id ?>'>
            </form>
        </div>
    </section>
</body>
</html>