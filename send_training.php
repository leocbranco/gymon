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
    $idExercicio = $_POST['id_exercicio'];
    $repeticoes = $_POST['repeticoes'];

    $sql = "INSERT INTO Treinos (ID_Exercicio, ID_Aluno, ID_Personal, Repeticoes) VALUES ('$idExercicio', '$idAluno', '$idPersonal', '$repeticoes')";
    if ($conex->query($sql) === TRUE) {
        echo "Treino enviado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conex->error;
    }
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
    <title>Enviar Treino - GymON</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Enviar Treino para <?php echo $aluno['Nome_Aluno']; ?></h1>
        <form method="POST" action="">
            <input type="hidden" name="id_aluno" value="<?php echo $aluno['ID_Aluno']; ?>">
            <div class="form-group">
                <label for="id_exercicio">Exercício:</label>
                <select name="id_exercicio" id="id_exercicio" required>
                    <?php while($exercicio = $resultExercicios->fetch_assoc()): ?>
                    <option value="<?php echo $exercicio['ID_Exercicio']; ?>"><?php echo $exercicio['Nome_Exercicio']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="repeticoes">Repetições:</label>
                <input type="text" name="repeticoes" id="repeticoes" required>
            </div>
            <button type="submit" name="enviar" class="button">Enviar Treino</button>
        </form>
    </div>
</body>
</html>
