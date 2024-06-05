<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>
        body {
            background-color: #1C1C1C;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        h1 {
            color: #dc3545;
        }
        a, button {
            color: #329834;
            text-decoration: none;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
        }
        a:hover, button:hover {
            text-decoration: underline;
        }
        button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #329834;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Acesso não autorizado</h1>
        <p>Você não tem permissão para acessar esta página.</p>
        <button onclick="goBack()">Voltar para a página anterior</button>
    </div>
</body>
</html>
