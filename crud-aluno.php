<?php
require 'aluno_auth.php';
include_once('cfg.php');

$idAluno = $_SESSION['id'];

$sql = "SELECT * FROM Aluno WHERE ID_Aluno = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idAluno);
$stmt->execute();
$result = $stmt->get_result();
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
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.2s linear, color 0.2s linear;
            background-color: #1C1C1C;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 10% auto;
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
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group label {
            flex: 0 0 180px;
            font-weight: bold;
            color: inherit;
        }

        .form-group .value {
            flex: 1;
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
    </style>
</head>
<body>
    <?php require 'menu-aluno.php'; ?>
    <div class="container">
        <h2>Dados Pessoais</h2>
        <?php
            if ($result->num_rows > 0) {
                while($user_data = mysqli_fetch_assoc($result)) {
                    echo "<div class='form-group'>";
                    echo "<label>Nome:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Nome_Aluno']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Email:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Email_Aluno']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Senha:</label>";
                    echo "<div class='value'>" . str_repeat('*', strlen($user_data['Senha_Aluno'])) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>CPF:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['CPF_Aluno']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Gênero:</label>";
                    echo "<div class='value'>" . htmlspecialchars($user_data['Genero_Aluno']) . "</div>";
                    echo "</div>";

                    echo "<div class='form-group'>";
                    echo "<label>Data de Nascimento:</label>";
                    echo "<div class='value'>" . date('d/m/Y', strtotime($user_data['DataNasc_Aluno'])) . "</div>";
                    echo "</div>";

                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-primary' href='editar-aluno.php?ID_Aluno=" . $user_data['ID_Aluno'] . "'>";
                    echo "<svg width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>";
                    echo "<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>";
                    echo "<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>";
                    echo "</svg> Editar</a>";
                    echo "<a class='btn btn-danger' href='excluir-aluno.php?ID_Aluno=" . $user_data['ID_Aluno'] . "'>";
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
