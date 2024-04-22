<!DOCTYPE html>
<html>

<head>
	<title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
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

		#Imagem {
			display: none
		}

		#imagemSelecionada {
			width: 20%;
			height: auto;
		}
	</style>
</head>

<body onload="w3_show_nav('menuDisc')">

	<?php include 'menu.php'; ?>
	<?php require 'menu.php'; ?>
	<?php require 'cfg.php'; ?>

	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<h1 class="w3-xxlarge">Atualização Disciplina</h1>

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
				$id = $_GET['id'];

				$conn = mysqli_connect($dbHost, $username, $password, $dbname);

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');


				$sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio, FotoBin FROM Exercicios WHERE ID_Exercicio = $id";


				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
				?>
							<div class="w3-container w3-theme">
								<h2>Altere os dados da Disciplina Cód. = [<?php echo $row['ID_Exercicio']; ?>]</h2>
							</div>
							<form class="w3-container" action="ExercicioAtualizar_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
								<table class='w3-table-all'>
									<tr>
										<td style="width:50%;">
											<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Exercicio']; ?>">
											<p>
												<label class="w3-text-deep-purple"><b>Nome</b></label>
												<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." value="<?php echo $row['Nome_Exercicio']; ?>" required>
											</p>
											<p>
												<label class="w3-text-deep-purple"><b>Ementa</b></label>
												<textarea class="w3-input w3-border w3-light-grey " name="Ementa" rows="5" title="Texto Descritivo" required><?php echo $row['Descricao_Exercicio']; ?></textarea>
											</p>
										</td>
										<td style="text-align:center">
											<p>
												<label class="w3-text-deep-purple"><b>Imagem</b></label>
												<?php
												if ($row['FotoBin']) {
												?>
											<p><img id="imagemSelecionada" src="data:image/png;base64,<?= base64_encode($row['FotoBin']) ?>" /></p>
										<?php
												} else {
										?>
											<p><img id="imagemSelecionada" src="imagens/imagem.png" /></p>
										<?php
												}
										?>
										<p>
											<label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
												<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
												<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
										</p>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<p>
												<input type="submit" value="Alterar" class="w3-btn w3-red">
												<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='discListar.php'">
											</p>
										</td>
									</tr>
								</table>
							</form>
				<?php
						}
					}
				} else {
					echo "Erro executando UPDATE: " . mysqli_error($conn);
				}
				echo "</div>"; 
				mysqli_close($conn); 

				?>

			</div>
			</p>
		</div>
</body>

</html>