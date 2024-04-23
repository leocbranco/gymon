<?php
    include_once('cfg.php');

    if(!empty($_GET['ID_Personal']))
    {
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
            header('Location: crud-personal.php');
            exit(); // Adicionado para evitar que o código continue sendo executado após a redireção
        }
    }
    else
    {
        header('Location: crud-personal.php');
        exit(); // Adicionado para evitar que o código continue sendo executado após a redireção
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
            background-color: #1B1F27; /* Alterado para a cor de fundo do body */
            border: 2px solid #C0C0C0; /* Adicionada uma borda cinza */
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
            background-color: transparent; /* Alterado para transparente */
            padding-left: 10px;
            color: #CBD0F7;
            border: 1px solid #C0C0C0; /* Adicionada uma borda cinza */
            height: 45px;
            outline: none; 
            border-radius: 8px;
            width: 100%; /* Adicionado para ocupar toda a largura */
        }

        .login img{
            width: 50px;
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
            border: none;
            color: white;
            height: 45px;
            border-radius: 8px;
            margin-top: 10px;
        }

        p{
            color:#CBD0F7;
            text-decoration: none;
            margin-left: 10px;
            margin-top: 10px; /* Adicionado para espaçamento */
        }

        a{
            color: #CBD0F7;
            text-decoration: none;
            margin-left: 10px;
            margin-top: 10px; /* Adicionado para espaçamento */
        }
    </style>
</head>
<body>
    <a href="crud-personal.php">Voltar</a>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="assets/logo-gymon.jpeg">
            </div>
            <form method="POST" action="atualizar-personal.php">
                <input type="text" name="nome" value="<?php echo $nome?>" placeholder="Nome:" autofocus>
                <input type="text" name="email" value="<?php echo $email?>" placeholder="E-mail:" readonly>
                <input type="password" name="senha" value="<?php echo $senha?>" placeholder="Senha:">
                <input type="text" name="cpf" value="<?php echo $CPF?>" placeholder="CPF:" readonly>
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
