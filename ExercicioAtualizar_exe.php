<!DOCTYPE html>
<html>

<head>

    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style-exe.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">

</head>

<body onload="showNav('menuDisc')">
    <?php include 'menu.php'; ?>
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <div class="main-content">

        <div class="panel">
            <h1 class="header">Atualização de Exercicio</h1>

            <p class="large-text">
            <div class="code-block">

                <?php
                $id      = $_POST['Id'];
                $nome    = $_POST['Nome'];
                $ementa  = $_POST['Ementa'];

                if ($_FILES['Imagem']['size'] == 0) {
                    $sql = "UPDATE Exercicios SET Nome_Exercicio = '$nome', Descricao_Exercicio = '$ementa' WHERE ID_Exercicio = $id";
                } else {
                    $imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name']));
                    echo "okok\n";
                    $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio, FotoBin FROM Exercicios WHERE ID_Exercicio = $id";
                }

                $conn = mysqli_connect($dbHost, $username, $password, $dbname);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                mysqli_query($conn, "SET NAMES 'utf8'");
                mysqli_query($conn, 'SET character_set_connection=utf8');
                mysqli_query($conn, 'SET character_set_client=utf8');
                mysqli_query($conn, 'SET character_set_results=utf8');

                echo "<div class='responsive-table card'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "Um registro alterado!";
                } else {
                    echo "Erro executando UPDATE: " . mysqli_error($conn);
                }
                echo "</div>";
                mysqli_close($conn);
                ?>
            </div>
            <a href="ExercicioListar.php" class="button">Voltar</a>
        </div>
    </div>
</body>

</html>
