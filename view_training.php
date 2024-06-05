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

$idTreino = $_GET['id'];
$sql = "
    SELECT Exercicios_Treino.ID_Exercicio_Treino, Exercicios.Nome_Exercicio, Exercicios.FotoBin, Exercicios_Treino.Repeticoes, Exercicios_Treino.Series 
    FROM Exercicios_Treino 
    JOIN Exercicios ON Exercicios_Treino.ID_Exercicio = Exercicios.ID_Exercicio 
    WHERE Exercicios_Treino.ID_Treino = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idTreino);
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
        img {
            max-width: 100px;
            height: auto;
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
        <h1>Exercícios do Treino</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome do Exercício</th>
                    <th>Imagem</th>
                    <th>Repetições</th>
                    <th>Séries</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Nome do Exercício"><?php echo htmlspecialchars($row['Nome_Exercicio']); ?></td>
                    <td data-label="Imagem">
                        <?php if (!empty($row['FotoBin'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['FotoBin']); ?>" alt="<?php echo htmlspecialchars($row['Nome_Exercicio']); ?>">
                        <?php else: ?>
                            Sem imagem
                        <?php endif; ?>
                    </td>
                    <td data-label="Repetições"><?php echo htmlspecialchars($row['Repeticoes']); ?></td>
                    <td data-label="Séries"><?php echo htmlspecialchars($row['Series']); ?></td>
                    <td data-label="Ações" class="actions">
                        <a href="edit_exercise.php?id=<?php echo $row['ID_Exercicio_Treino']; ?>&id_treino=<?php echo $idTreino; ?>" class="button">Editar</a>
                        <a href="delete_exercise.php?id=<?php echo $row['ID_Exercicio_Treino']; ?>&id_treino=<?php echo $idTreino; ?>" class="button" onclick="return confirm('Tem certeza que deseja excluir este exercício?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php require 'menu.php'; ?>
</body>
</html>
