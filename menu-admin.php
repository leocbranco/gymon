<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/menuu.css">
</head>
<body>
    <?php require 'modoescuro/mododark.php'; ?>
    <div class="menu-top">
        <div class="menu-bar">
            <a href="javascript:void(0)" onclick="toggleSidebar()">☰ Menu</a>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
    <div class="menu-container">
        <br>
        <a href="visualizar-alunos.php"><i class="fas fa-users"></i> Visualizar Alunos</a>
        <a href="visualizar-personais.php"><i class="fas fa-user"></i> Visualizar Personais</a>
    </div>
    <div class="logout-btn">
        <a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </div>
    </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-270px";
            } else {
                sidebar.style.left = "0px";
            }
        }

        function confirmLogout() {
            if(confirm("Tem certeza de que deseja sair da sua conta?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
    <script src="modoescuro/modo-escuro.js"></script>
</body>
</html>
