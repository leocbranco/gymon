<?php
    session_start();
    include_once('cfg.php');

    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        header('Location: login-personal.php');
        exit; 
    }

    $email_personal_logado = $_SESSION['email'];

    $sql = "SELECT * FROM Personal WHERE Email_Personal = '$email_personal_logado'";

    $result = $conex->query($sql);
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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
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

        /* Botão de volta estilizado */
        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            background-color: #dc3545;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #b5202b;
        }
    </style>
</head>
<body>
    <a class="btn-back" href="home-personal.php">Voltar</a>
    <div class="container">
        <h2>Dados Pessoais</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>" .$user_data['ID_Personal'] ."</td>";
                        echo "<td>" .$user_data['Nome_Personal'] ."</td>";
                        echo "<td>" .$user_data['Email_Personal'] ."</td>";
                        echo "<td>" .$user_data['Senha_Personal'] ."</td>";
                        echo "<td>" .$user_data['CPF_Personal'] ."</td>";
                        echo "<td>" .$user_data['Genero_Personal'] ."</td>";
                        echo "<td>" .$user_data['DataNasc_Personal'] ."</td>";
                        echo "<td> 
                            <a class='btn btn-sm btn-primary' href='editar-personal.php?ID_Personal=$user_data[ID_Personal]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg>
                            </a>
                            <a class='btn btn-sm btn-danger' href='excluir-personal.php?ID_Personal=$user_data[ID_Personal]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                        </td>";    
                    }    
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
