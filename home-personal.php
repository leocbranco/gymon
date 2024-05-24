<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

$sql = "SELECT * FROM Aluno";
$result = $conex->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos - GymON</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Alunos Cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Objetivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['ID_Aluno']; ?></td>
                    <td><?php echo $row['Nome_Aluno']; ?></td>
                    <td><?php echo $row['Email_Aluno']; ?></td>
                    <td><?php echo $row['DataNasc_Aluno']; ?></td>
                    <td><?php echo $row['Objetivo_Aluno']; ?></td>
                    <td><a href="send_training.php?id=<?php echo $row['ID_Aluno']; ?>" class="button">Enviar Treino</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php require 'menu-aluno.php'; ?>
</body>
</html>
