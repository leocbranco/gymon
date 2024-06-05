<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
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
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #3C3C3C;
            color: #fff;
            margin-bottom: 10px;
            box-sizing: border-box;
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
            background-color: #0056b3;
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
            background-color: #0056b3;
        }

        .btn-container {
            display: flex;
            justify-content: flex-start;
        }

        .responsive-table {
            width: 100%;
            margin-top: 20px;
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
        }
    </style>
</head>

<body>
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                echo "<div class='card'>Falha na conexão com o Banco de Dados: " . mysqli_connect_error() . "</div>";
            } else {
                mysqli_query($conn, "SET NAMES 'utf8'");
                mysqli_query($conn, 'SET character_set_connection=utf8');
                mysqli_query($conn, 'SET character_set_client=utf8');
                mysqli_query($conn, 'SET character_set_results=utf8');

                if ($result = mysqli_query($conn, $sql)) {
                    echo "<div class='card'>Um registro adicionado!</div>";
                } else {
                    echo "<div class='card'>Erro executando INSERT: " . mysqli_error($conn) . "</div>";
                }
                mysqli_close($conn);  
            }
            echo '<a href="ExercicioListar.php" class="button">Voltar</a>';
        } else {
        ?>
        <div class="form-container">
            <h2>Cadastro de Exercícios</h2>
            <form action="" method="post" onsubmit="return checkForm()" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="Nome" type="text" title="Nome do exercício" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="Ementa" rows="3" title="Texto Descritivo" required></textarea>
                </div>
                <div class="form-group img-preview-container">
                    <label for="imagem">Imagem Selecionada:</label>
                    <img class="img-preview" id="imagemSelecionada" src="assets/imagem.png" alt="Imagem Selecionada">
                    <label class="btn-file" for="Imagem">Selecionar Imagem</label>
                    <input type="file" id="Imagem" name="Imagem" accept="image/*" onchange="previewImage(event)" required>
                </div>
                <div class="btn-container">
                    <input type="submit" class="btn" value="Registrar">
                    <input type="button" class="btn btn-cancel" value="Cancelar" onclick="window.location.href='home-personal.php'">
                </div>
            </form>
        </div>
        <?php } ?>
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

        function checkForm() {
            var fileInput = document.getElementById('Imagem');
            if (fileInput.files.length === 0) {
                echo("É obrigatório enviar uma imagem.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
