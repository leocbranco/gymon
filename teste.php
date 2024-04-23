<!DOCTYPE html>
<html>

<head>
    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            height: 100vh;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: transparent; /* fundo transparente */
            border: 1px solid #ccc; /* borda cinza fraca */
            border-radius: 10px;
            display: flex; /* alteração para flexbox */
            justify-content: space-between; /* espaço entre os elementos */
        }

        .form-container {
            flex: 1; /* cada contêiner de formulário ocupará a mesma largura */
            padding: 0 10px; /* espaço interno para separar os elementos */
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            color: #fff;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc; /* borda cinza fraca */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: transparent; /* fundo transparente */
            color: #fff;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #800000;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #550000;
        }

        .btn-cancel {
            background-color: #333;
            color: #fff;
        }

        .img-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 30px;
        }

        .img-preview {
            max-width: 150px; /* reduzido o tamanho da imagem */
            height: auto;
            margin-bottom: 10px;
        }

        input[type="file"] {
            display: none;
        }

        .btn-file {
            background-color: #800000;
            color: #fff;
            padding: 5px 10px; /* reduzido o padding do botão */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-file:hover {
            background-color: #550000;
        }

        /* Adicionado */
        .btn-container {
            margin-top: 10px;
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
                    <input id="nome" class="form-control" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" class="form-control" name="Ementa" rows="3" title="Texto Descritivo" required></textarea>
                </div>
                <!-- Movido para baixo -->
                <div class="btn-container">
                    <input type="submit" class="btn" value="Registrar">
                    <input type="button" class="btn btn-cancel" value="Cancelar" onclick="window.location.href='home-personal.php'">
                </div>
            </form>
        </div>
        <div class="form-container">
            <div class="form-group img-preview-container">
                <label for="imagem">Imagem Selecionada:</label>
                <br>
                <img class="img-preview" src="assets/imagem.png" alt="Imagem Selecionada">
                <br>
                <label class="btn-file" for="Imagem">Selecionar Imagem</label>
                <input type="file" id="Imagem" name="Imagem" accept="image/*">
            </div>
        </div>
    </div>
</body>

</html>
