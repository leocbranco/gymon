<!DOCTYPE html>
<!--
Desenvolvimento Web
PUCPR
Profa. Cristina V. P. B. Souza
Março/2021
-->
<html>

<head>

	<title>IE - Instituição de Ensino</title>
	<link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
		.w3-theme {
			color: #ffff !important;
			background-color: #380077 !important
		}

		.w3-code {
			border-left: 4px solid #380077
		}

		.myMenu {
			margin-bottom: 150px
		}
	</style>
</head>

<body onload="w3_show_nav('menuDisc')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'menu.php'; ?>
	<?php require 'conectaBD.php'; ?>

	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<h1 class="w3-xxlarge">Registro de Disciplina</h1>

			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
				<?php

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<!-- Acesso ao BD-->
				<?php

				$nome    = $_POST['Nome'];
				$ementa = $_POST['Ementa'];


				// Check $_FILES['Imagem']['error'] value.
				switch ($_FILES['Imagem']['error']) {
					case UPLOAD_ERR_OK:
						break;
					case UPLOAD_ERR_NO_FILE:
						throw new RuntimeException('No file sent.');
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						throw new RuntimeException('Exceeded filesize limit.');
					default:
						throw new RuntimeException('Unknown errors.');
				}

				if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
					$sql = "INSERT INTO disciplina (NomeDisc, ementa, FotoBin) VALUES ('$nome','$ementa', NULL)";
				} else {                              // Recebeu uma imagem binária
					$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
					$sql = "INSERT INTO disciplina (NomeDisc, ementa, FotoBin) VALUES ('$nome','$ementa', '$imagem')";
				}

				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão 
				if (!$conn) {
					echo "</table>";
					echo "</div>";
					die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
				}

				// Configura para trabalhar com caracteres acentuados do português
				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');

				// Faz Select na Base de Dados
				// $sql = "INSERT INTO disciplina (NomeDisc, ementa) VALUES ('$nome','$ementa')";
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					echo "Um registro adicionado!";
				} else {
					echo "Erro executando INSERT: " . mysqli_error($conn);
				}
				echo "</div>";
				mysqli_close($conn);  //Encerra conexao com o BD

				?>
			</div>
		</div>


		<footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center w3-opacity">
			<p>
			<nav>
				<a class="w3-button w3-theme w3-hover-white" onclick="document.getElementById('id01').style.display='block'">Sobre</a>
			</nav>
			</p>
		</footer>

		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'rodape.php'; ?>
</body>

</html>