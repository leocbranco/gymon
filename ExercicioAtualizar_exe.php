<?php
require 'cfg.php';

$conn = mysqli_connect($dbHost, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id      = $_POST['Id'];
$nome    = $_POST['Nome'];
$ementa  = $_POST['Ementa'];

if ($_FILES['Imagem']['size'] == 0) {
    $sql = "UPDATE Exercicios SET Nome_Exercicio = '$nome', Descricao_Exercicio = '$ementa' WHERE ID_Exercicio = $id";
} else {
    $imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name']));
    $sql = "UPDATE Exercicios SET Nome_Exercicio = '$nome', Descricao_Exercicio = '$ementa', FotoBin = '$imagem' WHERE ID_Exercicio = $id";
}

mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET character_set_connection=utf8');
mysqli_query($conn, 'SET character_set_client=utf8');
mysqli_query($conn, 'SET character_set_results=utf8');

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ExercicioListar.php");
    exit();
} else {
    mysqli_close($conn);
    echo "Erro ao atualizar registro: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
    <link rel="stylesheet" href="css/style-exe.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
</head>
<body onload="showNav('menuDisc')">
    <?php include 'menu.php'; ?>
    <div class="main-content">
        <div class="panel">
            <h1 class="header">Atualização de Exercício</h1>
            <p class="large-text">
            <div class="code-block">
                <div class='responsive-table card'>
                    <?php
                    if (isset($errorMsg)) {
                        echo $errorMsg;
                    }
                    ?>
                </div>
            </div>
            <a href="ExercicioListar.php" class="button">Voltar</a>
        </div>
    </div>
</body>
</html>
