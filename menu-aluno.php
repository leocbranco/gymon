<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
<style>
    .menu-top {
    background-color: #ffffff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .menu-logo {
    margin: 4px 0 6px 0;
    }

    .menu-logo img {
    width: 100px; 
    height: auto;
    }

    .menu-instituicao {
    font-weight: bold;
    }

    .menu-bar {
    background-color: #d63a25; 
    color: #ffffff;
    font-size: 18px;
    padding: 12px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
    }

    .menu-bar a {
    text-decoration: none;
    color: #ffffff;
    padding: 16px;
    }

    .sidebar {
    background-color: #f1f1f1; 
    width: 270px;
    position: fixed;
    left: 0;
    top: 60px; 
    height: 100%;
    overflow-x: hidden;
    transition: 0.5s;
    z-index: 1;
    display: none; 
    }

    .sidebar a {
    padding: 10px;
    text-decoration: none;
    font-size: 18px;
    color: #000000;
    display: block;
    }

    .sidebar a:hover {
    background-color: #ddd;
    }
</style>
</head>

<body>

    <div class="menu-top">
    
    <div class="menu-bar">
            <a href="javascript:void(0)" onclick="toggleSidebar()">☰ Menu</a>
    </div>

    <div class="sidebar" id="sidebar">
        <a href="javascript:void(0)" onclick="toggleSidebar()" class="closebtn" title="Fechar">&times;</a>
        <div class="menu-container">
        <a href="crud-aluno.php">Visualizar Perfil</a> 
        <a href="#" onclick="confirmLogout()">Sair</a> <!-- Link para o arquivo registrar.php -->
        </div>
    </div>

    <script>
    function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    if (sidebar.style.display === "block") {
        sidebar.style.display = "none";
    } else {
        sidebar.style.display = "block";
    }
    }

    function confirmLogout() {
        if(confirm("Tem certeza de que deseja sair da sua conta?")) {
            window.location.href = "logout.php";
        }
    }
    </script>
</body>
</html>
