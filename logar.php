<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/stylehomee.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <title>GymON</title>
    <style>
        :root {
            --red: #329834;
            --white: #1C1C1C;
            --dark: #fff;
        }   

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('assets/background2.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .table {
            background-color: rgba(62, 62, 62, 0.7); 
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            margin: 0 20px;
            display: flex;
            flex-direction: column;
            width: 40%;
            max-width: 350px;
        }
        .table h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #ffffff;
            font-size: 18px;
        }
        .description {
            margin-bottom: 15px;
            color: #ffffff;
            font-size: 14px;
            text-align: center;
        }
        .form-group {
            margin-top: auto;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #329834;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #007100;
        }

        .navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 40px;
            box-shadow: 0 0.1rem 0.5rem #ccc;
            width: 100%;
            background: var(--white);
            transition: all 0.5s;
            position: fixed;
        }

        .navigation .logo {
            color: var(--red);
            font-size: 1.7rem;
            font-weight: 600;
        }

        .back-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #329834;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #007100;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navigation">
            <a href="home.php" class="logo">
                <img src="assets/logo-gymon.jpeg" alt="Logo GymON">
                Gym<span>ON</span>
            </a>
        </nav>
    </header>
    <div class="container">
        <div class="table">
            <h2>Login como Aluno</h2>
            <div class="description">
                <p>Se você está em busca de um treinador pessoal para te ajudar a alcançar seus objetivos de fitness, acesse como Aluno.</p>
            </div>
            <div class="form-group">
                <button onclick="window.location.href='login-aluno.php'">Acessar como Aluno</button>
            </div>
        </div>
        <div class="table">
            <h2>Login como Personal</h2>
            <div class="description">
                <p>Se você é um profissional de saúde ou fitness, acesse como Personal e comece a ajudar seus clientes a atingirem seus objetivos.</p>
            </div>
            <div class="form-group">
                <button onclick="window.location.href='login-personal.php'">Acessar como Personal</button>
            </div>
        </div>
    </div>
    <!-- Botão de voltar -->
    <a href="home.php" class="back-button">Voltar</a>
</body>
</html>
