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
    <?php require 'cfg.php'; ?>

    <div class="main-content">

        <div class="panel">
            <h1 class="header">Registro de Exercícios</h1>

            <p class="large-text">
            <div class="code-block">
                <?php

                $nome    = $_POST['Nome'];
                $ementa = $_POST['Ementa'];

                switch ($_FILES['Imagem']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No file sent.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    default:
                        throw new RuntimeException('Unknown errors.');
                }

                if ($_FILES['Imagem']['size'] == 0) { 
                    $sql = "INSERT INTO Exercicios (Nome_Exercicio, Descricao_Exercicio, FotoBin) VALUES ('$nome','$ementa', NULL)";
                } else {                        
                    $imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name']));
                    $sql = "INSERT INTO Exercicios (Nome_Exercicio, Descricao_Exercicio, FotoBin) VALUES ('$nome','$ementa', '$imagem')";
                }

                $conn = mysqli_connect($dbHost, $username, $password, $dbname);

                if (!$conn) {
                    echo "</table>";
                    echo "</div>";
                    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                }

                mysqli_query($conn, "SET NAMES 'utf8'");
                mysqli_query($conn, 'SET character_set_connection=utf8');
                mysqli_query($conn, 'SET character_set_client=utf8');
                mysqli_query($conn, 'SET character_set_results=utf8');

                echo "<div class='responsive-table card'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "Um registro adicionado!";
                } else {
                    echo "Erro executando INSERT: " . mysqli_error($conn);
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
