<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <style>

        .menu-top {
            background-color: #800000; 
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 2;
        }

        .menu-bar {
            color: #ffffff;
            font-size: 18px;
            padding: 12px;
        }

        .menu-bar a {
            text-decoration: none;
            color: #ffffff;
            padding: 16px;
        }

        .sidebar {
            background-color: #3e3e3e; 
            width: 270px;
            position: fixed;
            left: -270px; 
            top: 60px;
            height: 100%;
            overflow-x: hidden;
            transition: left 0.5s; a
            z-index: 1;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #800000;
        }
    </style>
</head>

<body>

<div class="menu-top">
    <div class="menu-bar">
        <a href="javascript:void(0)" onclick="toggleSidebar()">☰ Menu</a>
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="menu-container">
        <br>
        <a href="crud-personal.php">Visualizar Perfil</a>
        <a href="#" onclick="confirmLogout()">Sair</a>
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

</body>
</html>
