<!DOCTYPE html>
<html>
<head>

    <title>GymON</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
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
<<<<<<< HEAD
		body {
			background: #1C1C1C;
		}
=======
		
>>>>>>> db7f578fc8f8168b247ef0e864b4b04a9c31557f
    </style>
</head>
<body onload="w3_show_nav('menuDisc')">
	<?php require 'menu.php';?>
	<?php require 'cfg.php'; ?>

	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    	<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
<<<<<<< HEAD
        	<h1 class="w3-xxlarge">Exclusão de Exercicio</h1>
=======
        	<h1 class="w3-xxlarge">Exclusão de Exercício</h1>
>>>>>>> db7f578fc8f8168b247ef0e864b4b04a9c31557f

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
				$id=$_GET['id'];

				$conn = mysqli_connect($dbHost, $username, $password, $dbname);

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,'SET character_set_connection=utf8');
				mysqli_query($conn,'SET character_set_client=utf8');
				mysqli_query($conn,'SET character_set_results=utf8');
				
				$sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio FROM Exercicios WHERE ID_Exercicio = $id";
				echo "<div class='w3-responsive w3-card-4'>"; 
				 if ($result = mysqli_query($conn, $sql)) {
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
				?>
<<<<<<< HEAD

=======
								<div class="w3-container w3-theme">
									<h2>Exclusão de Exercício ID = [<?php echo $row['ID_Exercicio']; ?>]</h2>
								</div>
>>>>>>> db7f578fc8f8168b247ef0e864b4b04a9c31557f
								<form class="w3-container" action="ExercicioExcluir_exe.php" method="post" onsubmit="return check(this.form)">
									<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Exercicio']; ?>">
									<p>
									<label class="w3-text-deep-purple"><b>Nome: </b> <?php echo $row['Nome_Exercicio']; ?> </label></p>
									<p>
									<label class="w3-text-deep-purple"><b>Descricao: </b><?php echo $row['Descricao_Exercicio']; ?></label></p>
									<p>
									<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red" >
									<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='ExercicioListar.php'"></p>
								</form>
			<?php 
							}
						}
				}
				else {
					echo "Erro executando DELETE: " . mysqli_error($conn);
				}
				echo "</div>"; 
				mysqli_close($conn);  

			?>

			</div>
		</p>
	</div>
	</div>
</body>
</html>
