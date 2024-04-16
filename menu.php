<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymON</title>
<style>
/* Estilos para o menu */
.menu-top {
    background-color: #ffffff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.menu-logo {
    margin: 4px 0 6px 0;
}

.menu-logo img {
    width: 100px; /* Ajuste conforme necessário */
    height: auto;
}

.menu-instituicao {
    font-weight: bold;
}

.menu-bar {
    background-color: #d63a25; /* Cor de fundo do menu */
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

/* Estilos para a barra lateral */
.sidebar {
    background-color: #f1f1f1; /* Cor de fundo da barra lateral */
    width: 270px;
    position: fixed;
    left: 0;
    top: 60px; /* Ajuste conforme necessário */
    height: 100%;
    overflow-x: hidden;
    transition: 0.5s;
    z-index: 1;
    display: none; /* Inicia fechada por padrão */
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

<!-- Menu -->
<div class="menu-top">
    
<div class="menu-bar">
    <a href="javascript:void(0)" onclick="toggleSidebar()">☰ Menu</a>
</div>

<!-- Barra lateral -->
<div class="sidebar" id="sidebar">
    <a href="javascript:void(0)" onclick="toggleSidebar()" class="closebtn" title="Fechar">&times;</a>
    <div class="menu-container">
        <a href="#">Adicionar Exercicio</a>
        <a href="#">Lista de Exercicios</a>
        <a href="#">Criar Treino</a>
        <a href="#">Criar Treino</a> 
    </div>
</div>

<!-- Script para abrir/fechar a barra lateral -->
<script>
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    if (sidebar.style.display === "block") {
        sidebar.style.display = "none";
    } else {
        sidebar.style.display = "block";
    }
}
</script>

</body>
</html>
