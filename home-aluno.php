<?php
require 'aluno_auth.php';
include_once('cfg.php');

$idAluno = $_SESSION['id'];
$sql = "
    SELECT Nome_Treino, Data_Treino, ID_Treino 
    FROM Treinos 
    WHERE ID_Aluno = ?";
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
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1C1C1C;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background-color: #2C2C2C;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #329834;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #4F4F4F;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {  /* Cor para as linhas pares */
            background-color: #2C2C2C;
        }
        tr:nth-child(odd) { /* Cor para as linhas ímpares */
            background-color: #3E3E3E;
        }
        .button {
            background-color: #329834;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #007100;
        }
    </style>
</head>
<body>
    <?php require 'menu-aluno.php'; ?>
    <div class="container">
        <h1>Seus Treinos</h1>
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
                    <td><?php echo htmlspecialchars($row['Nome_Treino']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['Data_Treino'])); ?></td>
                    <td class="actions">
                        <a href="view_training_aluno.php?id=<?php echo $row['ID_Treino']; ?>" class="button">Ver Exercícios</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
