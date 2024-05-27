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
            exit(); 
        }
    }
    else
    {
        header('Location: crud-personal.php');
        exit(); 
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
            transition: background-color 0.2s linear, color 0.2s linear;
            background-color: #1C1C1C;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        body.light {
            background-color: #eef1f7;
            color: #000000;
        }

        body.light .container {
            background-color: #ffffff;
            color: #000000;
        }

        .container {
            max-width: 800px;
            margin: 10% auto;
            padding: 20px;
            background-color: #1e1e1e; /* Cor do modo escuro */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #ffffff;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: inherit;
            font-size: 2rem;
        }

        .form-group {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group label {
            flex: 0 0 150px;
            font-weight: bold;
            color: inherit;
        }

        .form-group input {
            flex: 1;
            background-color: #333333; /* Cor do modo escuro */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #444444; /* Cor do modo escuro */
            color: #ffffff;
        }

        .btn-group {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #b5202b;
        }

        .btn-voltar {
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="crud-personal.php" class="btn btn-danger btn-voltar">Voltar</a>
    <div class="container">
        <h2>Editar Dados</h2>
        <form method="POST" action="atualizar-personal.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome?>" placeholder="Nome:" autofocus>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo $email?>" placeholder="E-mail:" readonly>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="<?php echo $senha?>" placeholder="Senha:">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $CPF?>" placeholder="CPF:" readonly>
            </div>
            <div class="form-group">
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="<?php echo $genero?>" placeholder="Gênero:">
            </div>
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" id="data_nasc" name="data_nasc" value="<?php echo $data_nasc?>" placeholder="Data de Nascimento:">
            </div>
            <div class="btn-group">
                <input type="submit" class="btn btn-primary" name="update" value="Salvar">
            </div>
            <input type="hidden" name="ID_Personal" id="update" value='<?php echo $id ?>'>
        </form>
    </div>
</body>
</html>
