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
    </style>
</head>

<body>
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>Cadastro de Exercícios</h2>
            <form action="ExercicioCriar_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
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
                    <input type="file" id="Imagem" name="Imagem" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="btn-container">
                    <input type="submit" class="btn" value="Registrar">
                    <input type="button" class="btn btn-cancel" value="Cancelar" onclick="window.location.href='home-personal.php'">
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
