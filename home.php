<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style-index.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <title>GymON</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            list-style: none;
            text-decoration: none;
        }

        :root{
            --red:#800000;
            --white:#1C1C1C;
            --dark: #fff;
        }   

        body{
            color: var(--dark);
            background: var(--white);
        }

        .navigation{
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

        .navigation .logo{
            color: var(--red);
            font-size: 1.7rem;
            font-weight: 600;
        }

        .logo img {
            max-width: 11%; 
            height: auto; 
            vertical-align: middle; 
        }

        .logo span{
            color: var(--dark)
        }

        .navigation ul{
            display: flex;
            align-items: center;
            gap: 5rem;
        }

        .navigation ul li a{
            color: var(--dark);
            font-size: 17px;
            font-weight: 500;
            transition: all 0.5s;
        }

        .navigation ul li a:hover{
            color: var(--red);
        }

        .navigation box-icon{
            cursor: pointer;
            font-size: 1.5rem;
        }

        .menu{
            cursor: pointer;
        }

        .menu .bar{
            display: block;
            width: 28px;
            height: 3px;
            border-radius: 3px;
            background: var(--dark);
            margin: 5px auto;
            transition: all 0.3s;
        }

        .home{
            width: 100%;
            min-height: 100vh; 
            display: flex;
            justify-content: center; 
            align-items: center; 
            padding: 0px 10%;
            box-sizing: border-box; 
        }


        .home-texts{
            max-width: 37rem;
        }

        .home-texts .text-h4{
            font-size: 1.5 rem;
            color: var(--red);
            margin-bottom: 1rem;
        }

        .home-texts .text-h1{
            font-size: 4rem;
            margin-bottom: 1rem;
            line-height: 4rem;
        }

        .home-texts p{
            margin-bottom: 4rem;
        }

        .home-btn{
            padding: 15px 45px;
            background: var(--red);
            color: var(--white);
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.5s;
        }

        .home-btn hover{
            background: var(--red);
        }

        .home-img img{
            width: 100%;
        }

        @media (max-width:785px) {
            .navigation{
                padding: 18px 20px;
            }
            .menu{
                display: block;
            }

            .menu.ativo .bar:nth-child(1){
                transform: translateY(8px) rotate(45deg);
            }

            .menu.ativo .bar:nth-child(2){
                opacity: 0;
            }

            .menu.ativo .bar:nth-child(3){
                transform: translateY(-8px) rotate(-45deg);
            }

            .nav-menu{
                position: fixed;
                right: -100%;
                top: 70px;
                width: 100%;
                height: 100%;
                flex-direction: column;
                background: var(--white);
                gap: -10px;
                transition: 0.3s;

            }

            .nav-menu.ativo{
                right: 0;
            }

            .nav-item{
                margin: 16px 0px;
            }

            .home{
                padding: 100px 2%;
                flex-direction: column;
                text-align: center;
                overflow: hidden;
                gap: 5rem;
            }

            .home .text-h4{
                font-size: 15px;
            }

            .home .text-h1{
                font-size: 2.5rem;
                line-height: 3rem;
            }

            .home p{
                font-size: 15px;
            }

            .home-img{
                width: 125%;
            }
        }       

        .home-content {
            text-align: center; 
        }

        .registration-text {
            margin-bottom: 100px; 
        }

        .home-buttons {
            display: flex;
            justify-content: center; 
        }


        .home-btn {
            padding: 20px 50px;
            background: var(--red);
            color: var(--dark);
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.5s;
            margin-right: 20px; 
            border: 2px solid var(--red);
            text-transform: uppercase;
            text-decoration: none;
        }

        .home-btn:last-child {
            margin-right: 0;
        }


        .home-btn:hover {
            background: var(--white);
            border-color: var(--white);
        }

        .home-btn:active {
            transform: translateY(2px);
        }

    </style>
</head>
<body>
    <header>
        <nav class = "navigation">
            <a href="home.php" class="logo">
                <img src="assets/logo-gymon.jpeg" alt="Logo GymON">
                Gym<span>ON</span>
            </a>
            <ul class="nav_menu">
                <li class="nav-item"><a href="#">Home</a></li>
                <li class="nav-item"><a href="#">Sobre</a></li>
                <li class="nav-item"><a href="#">Planos</a></li>
                <box-icon name='search'></box-icon>
            </ul>
        </nav>
    </header>
    <main>
        <section class="home">
            <div class="home-img">
                <img src="assets/personal.png" alt="Atleta amarrando o tenis">
            </div>
            <div class="home-texts">
                <h4 class="text-h4">Treinos personalizados, resultados garantidos</h4>
                <h1 class="text-h1">Seja Bem-vindo ao GymON!</h1>
                <p>Um site online que oferece personalização de treinos e acompanhamento de progresso para personal trainers e seus clientes, facilitando a comunicação, a criação de rotinas e o monitoramento de resultados de forma eficiente e segura.</p>
                <a class="home-btn" href="registrar.php">Registre-se</a>
                <a class="home-btn" href="logar.php">Entrar</a>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>