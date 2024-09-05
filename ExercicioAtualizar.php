<?php
require 'cfg.php';

$conn = mysqli_connect($dbHost, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_GET['id']) ? $_GET['id'] : $_POST['Id'];
$nome = isset($_POST['Nome']) ? $_POST['Nome'] : '';
$ementa = isset($_POST['Ementa']) ? $_POST['Ementa'] : '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $errorMsg = "Erro ao atualizar registro: " . mysqli_error($conn);
        mysqli_close($conn);
    }
} else {
    mysqli_query($conn, "SET NAMES 'utf8'");
    mysqli_query($conn, 'SET character_set_connection=utf8');
    mysqli_query($conn, 'SET character_set_client=utf8');
    mysqli_query($conn, 'SET character_set_results=utf8');

    $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio, FotoBin FROM Exercicios WHERE ID_Exercicio = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nome = $row['Nome_Exercicio'];
    $ementa = $row['Descricao_Exercicio'];
    $fotoBin = $row['FotoBin'];

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1C1C1C;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: #2C2C2C;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #329834;
        }

        input,
        textarea {
            width: calc(100% - 16px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #3C3C3C;
            color: #fff;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        .btn {
            background-color: #329834;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #007100;
        }

        .btn-cancel:hover {
            background-color: red;
        }

        .btn-cancel {
            background-color: #333;
        }

        .img-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .img-preview {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }

        input[type="file"] {
            display: none;
        }

        .btn-file {
            background-color: #329834;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-file:hover {
            background-color: #007100;
        }

        .btn-container {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>Edição Exercicio</h2>
            <?php if ($errorMsg) { echo "<p style='color: red;'>$errorMsg</p>"; } ?>
            <form action="exercicioAtualizar.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="Id" value="<?php echo $id; ?>">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="Nome" type="text" title="Nome do exercício" value="<?php echo $nome; ?>" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="Ementa" rows="8" title="Texto Descritivo" required><?php echo $ementa; ?></textarea>
                </div>
                <div class="form-group img-preview-container">
                    <label for="imagem">Imagem Selecionada:</label>
                    <?php if ($fotoBin) { ?>
                        <img class="img-preview" id="imagemSelecionada" src="data:image/jpeg;base64,<?php echo base64_encode($fotoBin); ?>" />
                    <?php } else { ?>
                        <img class="img-preview" id="imagemSelecionada" src="imagens/imagem.png" />
                    <?php } ?>
                    <label class="btn-file" for="Imagem">Selecionar Imagem</label>
                    <input type="file" id="Imagem" name="Imagem" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="btn-container">
                    <input type="submit" class="btn" value="Alterar">
                    <input type="button" class="btn btn-cancel" value="Cancelar" onclick="window.location.href='ExercicioListar.php'">
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var imgPreview = document.getElementById('imagemSelecionada');
                imgPreview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
