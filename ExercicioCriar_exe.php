<!DOCTYPE html>
<html>

<head>

	<title>GymON</title>
	<link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
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
	<?php require 'menu.php'; ?>
	<?php require 'cfg.php'; ?>

	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<h1 class="w3-xxlarge">Registro de Exercícios</h1>

			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<?php

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<?php

				$nome    = $_POST['Nome'];
				$ementa = $_POST['Ementa'];


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

				if ($_FILES['Imagem']['size'] == 0) { 
					$sql = "INSERT INTO Exercicios (Nome_Exercicio, Descricao_Exercicio, FotoBin) VALUES ('$nome','$ementa', NULL)";
				} else {                        
					$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name']));
					$sql = "INSERT INTO Exercicios (Nome_Exercicio, Descricao_Exercicio, FotoBin) VALUES ('$nome','$ementa', '$imagem')";
				}

				$conn = mysqli_connect($dbHost, $username, $password, $dbname);

				if (!$conn) {
					echo "</table>";
					echo "</div>";
					die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
				}

				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');

				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					echo "Um registro adicionado!";
				} else {
					echo "Erro executando INSERT: " . mysqli_error($conn);
				}
				echo "</div>";
				mysqli_close($conn);  

				?>
			</div>
		</div>
</body>

</html>