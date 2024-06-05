<?php
session_start();
if (!isset($_SESSION['id_personal'])) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if (!isset($_GET['id'])) {
    header('Location: home-personal.php');
    exit();
}

$idAluno = $_GET['id'];

$sqlAluno = "SELECT Nome_Aluno FROM Aluno WHERE ID_Aluno = ?";
$stmtAluno = $conex->prepare($sqlAluno);
$stmtAluno->bind_param("i", $idAluno);
$stmtAluno->execute();
$resultAluno = $stmtAluno->get_result();

if ($resultAluno->num_rows > 0) {
    $aluno = $resultAluno->fetch_assoc();
    $nomeAluno = $aluno['Nome_Aluno'];
} else {
    $nomeAluno = "Aluno não encontrado";
}

$sql = "
    SELECT Treinos.ID_Treino, Treinos.Nome_Treino, Treinos.Data_Treino 
    FROM Treinos 
    WHERE Treinos.ID_Aluno = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idAluno);
$stmt->execute();
$result = $stmt->get_result();
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
            background-color: #1C1C1C;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            background-color: #2C2C2C;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #329834;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
        }
        .actions {
            display: flex;
            justify-content: space-around;
        }
        .actions a {
            margin: 0 5px;
        }
        .button {
            background-color: #329834;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #007100;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
            }
            td {
                border: none;
                border-bottom: 1px solid #ddd;
                position: relative;
                padding-left: 50%;
                text-align: left;
            }
            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: bold;
            }
        }
        @media (max-width: 480px) {
            .button {
                padding: 5px 10px;
                font-size: 12px;
            }
            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Treinos do Aluno: <?php echo htmlspecialchars($nomeAluno, ENT_QUOTES, 'UTF-8'); ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Nome do Treino</th>
                    <th>Data do Treino</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Nome do Treino"><?php echo htmlspecialchars($row['Nome_Treino'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td data-label="Data do Treino"><?php echo date("d/m/Y", strtotime(htmlspecialchars($row['Data_Treino'], ENT_QUOTES, 'UTF-8'))); ?></td>
                    <td data-label="Ações" class="actions">
                        <a href="view_training.php?id=<?php echo htmlspecialchars($row['ID_Treino'], ENT_QUOTES, 'UTF-8'); ?>&id_aluno=<?php echo htmlspecialchars($idAluno, ENT_QUOTES, 'UTF-8'); ?>" class="button">Ver Exercícios</a>
                        <a href="delete_training.php?id=<?php echo htmlspecialchars($row['ID_Treino'], ENT_QUOTES, 'UTF-8'); ?>&id_aluno=<?php echo htmlspecialchars($idAluno, ENT_QUOTES, 'UTF-8'); ?>" class="button" onclick="return confirm('Tem certeza que deseja excluir este treino?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="send_training.php?id=<?php echo htmlspecialchars($idAluno, ENT_QUOTES, 'UTF-8'); ?>" class="button">Adicionar Treino</a>
    </div>
    <?php require 'menu.php'; ?>
</body>
</html>
