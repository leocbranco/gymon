<?php
require 'aluno_auth.php';
include_once('cfg.php');

$idAluno = $_SESSION['id'];
$idTreino = $_GET['id'];

if (!verificaTreinoAluno($conex, $idTreino, $idAluno)) {
    die('Acesso não autorizado.');
}

$sqlTreino = "SELECT Nome_Treino FROM Treinos WHERE ID_Treino = ? AND ID_Aluno = ?";
$stmtTreino = $conex->prepare($sqlTreino);
$stmtTreino->bind_param("ii", $idTreino, $idAluno);
$stmtTreino->execute();
$resultTreino = $stmtTreino->get_result();

if ($resultTreino->num_rows > 0) {
    $treino = $resultTreino->fetch_assoc();
    $nomeTreino = $treino['Nome_Treino'];
} else {
    $nomeTreino = 'Treino Desconhecido';
}

$sql = "
    SELECT Exercicios_Treino.ID_Exercicio_Treino, Exercicios.Nome_Exercicio, Exercicios.FotoBin, Exercicios.Descricao_Exercicio, Exercicios_Treino.Repeticoes, Exercicios_Treino.Series 
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
    <title>Exercícios do Treino</title>
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
            color: #FFFFFF;
        }
        h1 span {
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
    </style>
</head>
<body>
    <?php require 'menu-aluno.php'; ?>
    <div class="container">
        <h1>Exercícios do Treino <span><?php echo htmlspecialchars($nomeTreino); ?></span></h1>
        <table>
            <thead>
                <tr>
                    <th>Nome do Exercício</th>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Repetições</th>
                    <th>Séries</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Nome_Exercicio']); ?></td>
                    <td>
                        <?php if (!empty($row['FotoBin'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['FotoBin']); ?>" alt="<?php echo htmlspecialchars($row['Nome_Exercicio']); ?>">
                        <?php else: ?>
                            Sem imagem
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['Descricao_Exercicio']); ?></td>
                    <td><?php echo htmlspecialchars($row['Repeticoes']); ?></td>
                    <td><?php echo htmlspecialchars($row['Series']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
