<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin']) {
    header('Location: login-personal.php');
    exit();
}

include_once('cfg.php');

if (isset($_POST['enviar'])) {
    $idAluno = $_POST['id_aluno'];
    $idPersonal = $_SESSION['id'];
    $exercicios = $_POST['id_exercicio'];
    $repeticoes = $_POST['repeticoes'];
    $series = $_POST['series'];

    foreach ($exercicios as $index => $idExercicio) {
        $rep = $repeticoes[$index];
        $ser = $series[$index];
        $sql = "INSERT INTO Treinos (ID_Exercicio, ID_Aluno, ID_Personal, Repeticoes, Series) VALUES ('$idExercicio', '$idAluno', '$idPersonal', '$rep', '$ser')";
        if ($conex->query($sql) !== TRUE) {
            echo "Erro: " . $sql . "<br>" . $conex->error . "<br>";
        }
    }
    header("Location: ficha_treino.php?id_aluno=$idAluno");
    exit();
}

$idAluno = $_GET['id'];
$sqlAluno = "SELECT * FROM Aluno WHERE ID_Aluno = $idAluno";
$resultAluno = $conex->query($sqlAluno);
$aluno = $resultAluno->fetch_assoc();

$sqlExercicios = "SELECT * FROM Exercicios";
$resultExercicios = $conex->query($sqlExercicios);
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
        .table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .table th {
            background-color: #333;
        }
        .add-exercise {
            margin-top: 20px;
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }
        .add-exercise:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function addExercise() {
            const exerciseContainer = document.getElementById('exercises-container');
            const newExercise = document.createElement('div');
            newExercise.classList.add('form-group');
            newExercise.innerHTML = `
                <div class="form-group">
                    <label for="id_exercicio">Exercício:</label>
                    <select name="id_exercicio[]" required>
                        <?php
                        $resultExercicios->data_seek(0);
                        while($exercicio = $resultExercicios->fetch_assoc()): ?>
                        <option value="<?php echo $exercicio['ID_Exercicio']; ?>"><?php echo $exercicio['Nome_Exercicio']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="repeticoes">Repetições:</label>
                    <input type="text" name="repeticoes[]" required>
                </div>
                <div class="form-group">
                    <label for="series">Séries:</label>
                    <input type="text" name="series[]" required>
                </div>
            `;
            exerciseContainer.appendChild(newExercise);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Enviar Treino para <?php echo $aluno['Nome_Aluno']; ?></h1>
        <form method="POST" action="">
            <input type="hidden" name="id_aluno" value="<?php echo $aluno['ID_Aluno']; ?>">
            <div id="exercises-container">
                <div class="form-group">
                    <label for="id_exercicio">Exercício:</label>
                    <select name="id_exercicio[]" required>
                        <?php
                        $resultExercicios->data_seek(0);
                        while($exercicio = $resultExercicios->fetch_assoc()): ?>
                        <option value="<?php echo $exercicio['ID_Exercicio']; ?>"><?php echo $exercicio['Nome_Exercicio']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="repeticoes">Repetições:</label>
                    <input type="text" name="repeticoes[]" required>
                </div>
                <div class="form-group">
                    <label for="series">Séries:</label>
                    <input type="text" name="series[]" required>
                </div>
            </div>
            <button type="button" class="add-exercise" onclick="addExercise()">Adicionar Exercício</button>
            <button type="submit" name="enviar" class="button">Enviar Treino</button>
        </form>
    </div>
</body>
</html>
