<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="stylesheet" href="css/style-menu.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">

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
        <a href="ExercicioCriar.php">Adicionar Exercicio</a>
        <a href="ExercicioListar.php">Lista de Exercicios</a>
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
