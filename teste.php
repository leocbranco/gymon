<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON - Cadastro de Exercícios</title>
    <link rel="icon" href="imagens/IE_favicon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1C1C1C;
            color: white;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #1C1C1C;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            font-size: 28px;
            color: #ffffff;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            font-weight: bold;
            margin-bottom: 5px;
            vertical-align: top; /* Para alinhar o label ao topo do input */
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #4F4F4F;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            color: white;
            background-color: transparent;
            margin-top: 5px;
        }
        textarea {
            height: 100px;
        }
        input[type="file"] {
            display: none;
        }
        .upload-btn {
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            padding: 12px 24px;
            display: inline-block;
            text-align: center;
            vertical-align: top; /* Para alinhar o botão ao topo do input */
        }
        .upload-btn:hover {
            background-color: #0056b3;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 5px;
            display: block;
            cursor: pointer;
        }
        input[type="submit"],
        input[type="button"] {
            padding: 12px 24px;
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Exercícios</h1>
        <form action="ExercicioCriar_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="Nome" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="Ementa" rows="5" title="Texto Descritivo" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagem" class="upload-btn">
                    <img id="imagemSelecionada" src="assets/imagem.png" alt="Imagem Selecionada">
                </label><input type="file" id="imagem" name="Imagem" accept="image/*" onchange="validaImagem(this);">
            </div>
            <div class="form-group">
                <input type="submit" value="Registrar">
                <input type="button" value="Cancelar" onclick="window.location.href='.'"">
            </div>
        </form>
    </div>
</body>
</html>
        