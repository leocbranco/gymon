<!DOCTYPE html>
<html>
<head>
    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style-exe.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
</head>
<body>
    <?php require 'menu.php';?>
    <?php require 'cfg.php'; ?>

    <div class="main-content">

        <div class="panel">
            <h1 class="header">Exclusão de Exercício</h1>

            <p class="large-text">
                <?php
                $id=$_GET['id'];

                $conn = mysqli_connect($dbHost, $username, $password, $dbname);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                mysqli_query($conn,"SET NAMES 'utf8'");
                mysqli_query($conn,'SET character_set_connection=utf8');
                mysqli_query($conn,'SET character_set_client=utf8');
                mysqli_query($conn,'SET character_set_results=utf8');

                $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio FROM Exercicios WHERE ID_Exercicio = $id";
                echo "<div class='responsive-table'>";
                 if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                                <form class="main-content" action="ExercicioExcluir_exe.php" method="post" onsubmit="return check(this.form)">
                                    <input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Exercicio']; ?>">
                                    <p>
                                    <input type="submit" value="Confirmar exclusão?" class="button" >
                                    <input type="button" value="Cancelar" class="button theme-color" onclick="window.location.href='ExercicioListar.php'"></p>
                                </form>
            <?php
                            }
                        }
                }
                else {
                    echo "Erro executando DELETE: " . mysqli_error($conn);
                }
                echo "</div>";
                mysqli_close($conn);  

            ?>

            </div>
        </div>
    </div>
</body>
</html>
