<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $treino_id = $_POST['id_treino'];
    $idAluno = $_POST['id_aluno'];
    $idExercicio = $_POST['id_exercicio'];
    $repeticoes = intval($_POST['repeticoes']);
    $series = intval($_POST['series']);

    $sql = "UPDATE Treinos SET ID_Exercicio = ?, Repeticoes = ?, Series = ? WHERE ID_Treino = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("iiii", $idExercicio, $repeticoes, $series, $treino_id);

    if ($stmt->execute()) {
        header("Location: list_trainings.php?id=$idAluno");
        exit();
    } else {
        echo "Erro ao editar treino.";
    }
} else {
    $treino_id = $_GET['id'];
    $sql = "SELECT * FROM Treinos WHERE ID_Treino = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("i", $treino_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $treino = $result->fetch_assoc();
}

$sqlExercicios = "SELECT * FROM Exercicios";
$resultExercicios = $conex->query($sqlExercicios);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Treino</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Treino</h1>
        <form method="POST" action="">
            <input type="hidden" name="id_treino" value="<?php echo htmlspecialchars($treino['ID_Treino']); ?>">
            <input type="hidden" name="id_aluno" value="<?php echo htmlspecialchars($treino['ID_Aluno']); ?>">
            <div class="form-group">
                <label for="id_exercicio">Exercício:</label>
                <select name="id_exercicio" required>
                    <?php while($exercicio = $resultExercicios->fetch_assoc()): ?>
                    <option value="<?php echo $exercicio['ID_Exercicio']; ?>" <?php if($exercicio['ID_Exercicio'] == $treino['ID_Exercicio']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($exercicio['Nome_Exercicio']); ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="repeticoes">Repetições:</label>
                <input type="number" name="repeticoes" value="<?php echo htmlspecialchars($treino['Repeticoes']); ?>" required>
            </div>
            <div class="form-group">
                <label for="series">Séries:</label>
                <input type="number" name="series" value="<?php echo htmlspecialchars($treino['Series']); ?>" required>
            </div>
            <button type="submit" class="button">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
