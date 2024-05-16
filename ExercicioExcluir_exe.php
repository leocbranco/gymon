<!DOCTYPE html>
<html>
<head>
	<title>GymON</title>
	<link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style-exe.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
	<style>
		.theme-color {color:#FFFFFF;background-color:#380077}

		.code-block{background-color:#2E2E2E;padding:10px;margin-bottom:20px}

		.myMenu {margin-bottom:150px}

		body {
			background: #1C1C1C;
			color: #FFFFFF;
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
    </style>
</head>
<body onload="showNav('menuDisc')">
	<?php require 'menu.php';?>
	<?php require 'cfg.php'; ?>

	<div class="main-content">
	<div class="panel">
  	<h1 class="header">Exclusão de Exercicio</h1>

  	<p class="large-text">
  	<div class="code-block notranslate">

	<?php
	$id = $_POST['Id'];
		
	$conn = mysqli_connect($dbHost, $username, $password, $dbname);


	if (!$conn) {
		die("Falha na conexão: " . mysqli_connect_error());
	}
	mysqli_query($conn,"SET NAMES 'utf8'");
	mysqli_query($conn,'SET character_set_connection=utf8');
	mysqli_query($conn,'SET character_set_client=utf8');
	mysqli_query($conn,'SET character_set_results=utf8');

	$sql = "DELETE FROM Exercicios WHERE ID_Exercicio = $id";

	echo "<div class='responsive-table card'>";
	if ($result = mysqli_query($conn, $sql)) {
		echo "Um registro excluído!";
	} else {
		echo "Erro ao executar DELETE: " . mysqli_error($conn);
	}
    echo "</div>";
	mysqli_close($conn);  
	?>
  </div>
</div>
</body>
</html>
