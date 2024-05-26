<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="css/style-index.css">
    <style>
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
            padding: 10px;
            box-sizing: border-box;
            margin: 0 30px;
            display: flex;
            flex-direction: column;
            width: 20%;
            height: 60%;
        }
        .table h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 16px;
        }
        .description {
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 12px;
        }
        .topics {
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 12px;
        }
        .topics ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .topics ul li {
            padding: 5px 0;
        }
        .form-group {
            margin-bottom: 10px;
            margin-top: auto;
        }
        .form-group button {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            background-color: #329834;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #007100;
        }
        :root {
            --red: #329834;
            --white: #1C1C1C;
            --dark: #fff;
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
            <br>
            <h2>Registro de Conta como Aluno</h2>
            <br>
            <div class="description">
                <p>Se você está em busca de um treinador pessoal para te ajudar a alcançar seus objetivos de fitness, registre-se como Aluno e encontre o personal perfeito para você.</p>
            </div>
            <div class="topics">
                <ul>
                    <li>➜ Encontre o personal ideal para suas necessidades</li>
                    <br>
                    <li>➜ Agende treinos personalizados</li>
                    <br>
                    <li>➜ Acompanhe seu progresso de forma fácil</li>
                    <br>
                    <li>➜ Conecte-se com outros alunos</li>
                    <br>
                    <li>➜ Explore uma variedade de modalidades de treino</li>
                </ul>
            </div>
            <div class="form-group">
                <button onclick="window.location.href='registro-aluno.php'">Registrar-se como Aluno</button>
            </div>
        </div>
        <div class="table">
            <br>
            <h2>Registro de Conta como Personal</h2>
            <br>
            <div class="description">
                <p>Se você é um profissional de saúde ou fitness, registre-se como Personal e comece a ajudar seus clientes a atingirem seus objetivos.</p>
            </div>
            <div class="topics">
                <ul>
                    <li>➜ Crie perfis personalizados para seus clientes</li>
                    <br>
                    <li>➜ Elabore treinos adaptados às necessidades individuais</li>
                    <br>
                    <li>➜ Compartilhe dicas e recursos de saúde e fitness</li>
                    <br>
                    <li>➜ Agende sessões de treino com facilidade</li>
                    <br>
                    <li>➜ Acompanhe o progresso de seus clientes de forma eficaz</li>
                </ul>
            </div>
            <div class="form-group">
                <button onclick="window.location.href='registro-personal.php'">Registrar-se como Personal</button>
            </div>
        </div>
    </div>
    <!-- Botão de voltar -->
    <a href="home.php" class="back-button">Voltar</a>
</body>
</html>
