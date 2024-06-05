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

if (!$result) {
    die("Erro na consulta ao banco de dados: " . $conex->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.2s linear, color 0.2s linear;
            background-color: #1C1C1C;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
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
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e; 
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
            flex-direction: column;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .form-group label {
            font-weight: bold;
            color: inherit;
            margin-bottom: 5px;
        }

        .form-group .value {
            width: 100%;
            background-color: #333333; 
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #444444; 
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
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #329834;
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

        svg {
            vertical-align: middle;
            margin-right: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.875rem;
            }

            h2 {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 8px 12px;
                font-size: 0.75rem;
            }

            .btn-group {
                margin-top: 20px;
            }
        }
    </style>
    <script>
        function confirmDeletion(id) {
            if (confirm("Você realmente deseja excluir esta conta?")) {
                window.location.href = 'excluir-personal.php?ID_Personal=' + id;
            }
        }
    </script>
</head>
<body>
    <?php require 'menu.php'; ?>
    <div class="container">
        <h2>Dados Pessoais</h2>
        <?php
            if ($result->num_rows > 0) {
                while($user_data = mysqli_fetch_assoc($result)) {
                    echo "<div class='form-group'>";
                    echo "<label>Nome:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Nome_Personal']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Email:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Email_Personal']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Senha:</label>";
                    echo "<div class='value'>" . str_repeat('*', strlen($user_data['Senha_Personal'])) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>CPF:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['CPF_Personal']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Gênero:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Genero_Personal']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Data de Nascimento:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['DataNasc_Personal']) . "</div>";
                    echo "</div>";

                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-primary' href='editar-personal.php?ID_Personal=" . $user_data['ID_Personal'] . "'>";
                    echo "<svg width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>";
                    echo "<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>";
                    echo "<path fill-rule='evenodd' d='M1 13.5V2.5A1.5 1.5 0 0 1 2.5 1h11a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>";
                    echo "</svg> Editar</a>";
                    echo "<a class='btn btn-danger' href='#' onclick='confirmDeletion(" . $user_data['ID_Personal'] . ")'>";
                    echo "<svg width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>";
                    echo "<path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>";
                    echo "</svg> Excluir</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum dado encontrado.</p>";
            }
        ?>
    </div>
</body>
</html>
