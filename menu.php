<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: login-personal.php');
    exit;
}

include_once('cfg.php');

$email = $_SESSION['email'];


$stmt = $conex->prepare("SELECT Status_Personal FROM Personal WHERE Email_Personal = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($status_personal);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/style-menu.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/menu.css">
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
        <?php if ($status_personal == 1): ?>
            <a href="ExercicioCriar.php"><i class="fas fa-dumbbell"></i> Adicionar Exercício</a>
            <a href="ExercicioListar.php"><i class="fas fa-list"></i> Lista de Exercícios</a>
            <a href="crud-personal.php"><i class="fas fa-user"></i> Visualizar Perfil</a>
        <?php endif; ?>
    </div>
    <div class="logout-btn">
        <a href="#" onclick="confirmLogout()" ><i class="fas fa-sign-out-alt"></i> Sair</a>
    </div>
    </div>
    </div>

    <?php
    if ($status_personal == 0) {
        echo "<p>Seu cadastro foi negado.</p>";
        // Ou redirecione para uma página específica informando que o cadastro foi negado
    } elseif ($status_personal != 1) {
        echo "<p>Seu cadastro ainda está sendo avaliado.</p>";
        // Ou redirecione para uma página específica informando que o cadastro está em avaliação
    }
    ?>

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
