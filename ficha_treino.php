<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

$idAluno = $_GET['id_aluno'];

$sqlAluno = "SELECT * FROM Aluno WHERE ID_Aluno = $idAluno";
$resultAluno = $conex->query($sqlAluno);
$aluno = $resultAluno->fetch_assoc();

$sqlTreinos = "
    SELECT e.Nome_Exercicio, t.Repeticoes, t.Series 
    FROM Treinos t 
    JOIN Exercicios e ON t.ID_Exercicio = e.ID_Exercicio 
    WHERE t.ID_Aluno = $idAluno
";
$resultTreinos = $conex->query($sqlTreinos);
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
            background-color: #1C1C1C;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }
        .button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #2c2c2c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ficha de Treino para <?php echo $aluno['Nome_Aluno']; ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Exercício</th>
                    <th>Repetições</th>
                    <th>Séries</th>
                </tr>
            </thead>
            <tbody>
                <?php while($treino = $resultTreinos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $treino['Nome_Exercicio']; ?></td>
                    <td><?php echo $treino['Repeticoes']; ?></td>
                    <td><?php echo $treino['Series']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="home-personal.php" class="button">Voltar</a>
    </div>
</body>
</html>
