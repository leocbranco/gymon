<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if (!isset($_GET['id'])) {
    header('Location: home-personal.php');
}

$idAluno = $_GET['id'];
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
    <title>Treinos do Aluno</title>
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
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Treinos do Aluno</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Treino</th>
                    <th>Nome do Treino</th>
                    <th>Data do Treino</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID_Treino']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nome_Treino']); ?></td>
                    <td><?php echo htmlspecialchars($row['Data_Treino']); ?></td>
                    <td class="actions">
                        <a href="view_training.php?id=<?php echo $row['ID_Treino']; ?>&id_aluno=<?php echo $idAluno; ?>" class="button">Ver Exercícios</a>
                        <a href="delete_training.php?id=<?php echo $row['ID_Treino']; ?>&id_aluno=<?php echo $idAluno; ?>" class="button" onclick="return confirm('Tem certeza que deseja excluir este treino?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="send_training.php?id=<?php echo $idAluno; ?>" class="button">Adicionar Treino</a>
    </div>
    <?php require 'menu.php'; ?>
</body>
</html>
