<!DOCTYPE html>
<html>
<head>
    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style-exe.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        .theme-color { color: #FFFFFF; background-color: #380077 }
        .code-block { background-color: #2E2E2E; padding: 10px; margin-bottom: 20px }
        .myMenu { margin-bottom: 150px }
        body {
            background: #1C1C1C;
            color: #FFFFFF;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .main-content {
            width: 80%;
            padding: 20px;
            background-color: #2C2C2C;
            border-radius: 10px;
            box-sizing: border-box;
        }
        .panel {
            padding: 20px;
            background-color: #2C2C2C;
            border-radius: 10px;
        }
        .header {
            margin-bottom: 20px;
            color: #329834;
        }
        .large-text {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .responsive-table {
            width: 100%;
        }
        .card {
            padding: 20px;
            background-color: #2C2C2C;
            border-radius: 10px;
        }
        .button {
            background-color: #329834;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #007100;
        }
        .button.theme-color {
            background-color: #FF0000; 
        }
        .button.theme-color:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <div class="main-content">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['Id'];

            $conn = mysqli_connect($dbHost, $username, $password, $dbname);

            if (!$conn) {
                die("Falha na conexão: " . mysqli_connect_error());
            }

            mysqli_query($conn, "SET NAMES 'utf8'");
            mysqli_query($conn, 'SET character_set_connection=utf8');
            mysqli_query($conn, 'SET character_set_client=utf8');
            mysqli_query($conn, 'SET character_set_results=utf8');

            $sql = "DELETE FROM Exercicios WHERE ID_Exercicio = $id";

            echo "<div class='responsive-table card'>";
            if ($result = mysqli_query($conn, $sql)) {
                echo "Um registro excluído!";
            } else {
                echo "Erro ao executar DELETE: " . mysqli_error($conn);
            }
            echo "</div>";
            mysqli_close($conn);

            echo '<a href="ExercicioListar.php" class="button">Voltar</a>';
        } else {
            $id = $_GET['id'];

            $conn = mysqli_connect($dbHost, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            mysqli_query($conn, "SET NAMES 'utf8'");
            mysqli_query($conn, 'SET character_set_connection=utf8');
            mysqli_query($conn, 'SET character_set_client=utf8');
            mysqli_query($conn, 'SET character_set_results=utf8');

            $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio FROM Exercicios WHERE ID_Exercicio = $id";
            echo "<div class='panel'>";
            echo "<h1 class='header' style='color: #329834;'>Exclusão de Exercício</h1>";
            echo "<p class='large-text'>";
            echo "<div class='responsive-table'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
        ?>
                        <form action="" method="post" onsubmit="return check(this.form)">
                            <input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Exercicio']; ?>">
                            <p>
                                <input type="submit" value="Confirmar exclusão?" class="button">
                                <input type="button" value="Cancelar" class="button theme-color" onclick="window.location.href='ExercicioListar.php'">
                            </p>
                        </form>
        <?php
                    }
                }
            } else {
                echo "Erro executando SELECT: " . mysqli_error($conn);
            }
            echo "</div>";
            echo "</div>";
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
