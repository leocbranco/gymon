<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" type="image/png" href="assets/logo-gymon.jpeg" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1C1C1C;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .exercise-list {
            padding: 20px;
            border-radius: 10px;
            background-color: #2d2d2d;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-height: 70vh;
            overflow-y: auto;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
        }

        .exercise-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .exercise-table th,
        .exercise-table td {
            padding: 10px;
            border-bottom: 1px solid #333333;
        }

        .exercise-table th {
            background-color: #329834;
            color: #ffffff;
            text-align: left;
        }

        .exercise-table td {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        .exercise-table td img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .exercise-table td a img {
            vertical-align: middle;
            width: 40px;
            height: 40px;
        }

        .responsive-table {
            overflow-x: auto;
        }
    </style>
</head>

<body onload="showMenu('menuDisc')">
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <div class="exercise-list">
        <h1>Relação de Exercícios</h1>
        <?php
        $conn = mysqli_connect($dbHost, $username, $password, $dbname);
        if (!$conn) {
            echo "<p>Falha na conexão com o Banco de Dados: " . mysqli_connect_error() . "</p>";
        } else {
            mysqli_query($conn, "SET NAMES 'utf8'");
            mysqli_query($conn, 'SET character_set_connection=utf8');
            mysqli_query($conn, 'SET character_set_client=utf8');
            mysqli_query($conn, 'SET character_set_results=utf8');

            $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio, FotoBin FROM Exercicios";

            echo "<div class='responsive-table'>";
            if ($result = mysqli_query($conn, $sql)) {
                echo "<table class='exercise-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th width='7%'>Código</th>";
                echo "<th width='20%'>Nome</th>";
                echo "<th>Descrição</th>";
                echo "<th width='20%'>Imagem</th>";
                echo "<th width='5%'></th>";
                echo "<th width='5%'></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cod = $row["ID_Exercicio"];
                        echo "<tr>";
                        echo "<td>$cod</td>";
                        echo "<td>{$row['Nome_Exercicio']}</td>";
                        echo "<td>{$row['Descricao_Exercicio']}</td>";
                        echo "<td>";
                        if ($row['FotoBin']) {
                            echo "<img src='data:image/png;base64," . base64_encode($row['FotoBin']) . "' alt='Imagem do exercício'/>";
                        } else {
                            echo "<img src='imagens/imagem.png' alt='Imagem padrão'/>";
                        }
                        echo "</td>";
                        echo "<td><a href='ExercicioAtualizar.php?id=$cod'><img src='assets/Edit.png' title='Editar Exercicio' alt='Editar'></a></td>";
                        echo "<td><a href='ExercicioExcluir.php?id=$cod'><img src='assets/Delete.png' title='Excluir Exercicio' alt='Excluir'></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum exercício encontrado</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>Erro executando SELECT: " . mysqli_error($conn) . "</p>";
            }
            mysqli_close($conn);
        }
        ?>
    </div>
</body>

</html>
