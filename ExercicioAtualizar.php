<!DOCTYPE html>
<html>

<head>
    <title>GymON</title>
    <link rel="icon" href="assets/logo-gymon.jpeg" type="image/x-icon">
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1C1C1C;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: transparent;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        }

        .form-container {
            flex: 1;
            padding: 0 10px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #800000;
        }

        input,
        textarea {
            width: calc(100% - 16px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: transparent;
            color: #fff;
            margin-bottom: 10px;
        }

        textarea {
            resize: vertical;
        }

        .btn {
            background-color: #800000;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #550000;
        }

        .btn-cancel {
            background-color: #333;
        }

        .img-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .img-preview {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }

        input[type="file"] {
            display: none;
        }

        .btn-file {
            background-color: #800000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-file:hover {
            background-color: #550000;
        }

        .btn-container {
            margin-top: 10px;
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <?php require 'cfg.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>Atualização Disciplina</h2>
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


<<<<<<< HEAD
            echo "<div>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <form action="ExercicioAtualizar_exe.php" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td style="width:50%;">
                                        <input type="hidden" name="Id" value="<?php echo $row['ID_Exercicio']; ?>">
                                        <p>
                                            <label><b>Nome</b></label>
                                            <input name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." value="<?php echo $row['Nome_Exercicio']; ?>" required>
                                        </p>
                                        <p>
                                            <label><b>Ementa</b></label>
                                            <textarea name="Ementa" rows="8" title="Texto Descritivo" required><?php echo $row['Descricao_Exercicio']; ?></textarea>
                                        </p>
                                    </td>
                                    <td style="text-align:center">
                                        <p>
                                            <label><b>Imagem</b></label>
                                            <?php
                                            if ($row['FotoBin']) {
                                            ?>
                                                <p><img class="img-preview" src="data:image/jpeg;base64,<?php echo base64_encode($row['FotoBin']); ?>" /></p>
                                            <?php
                                            } else {
                                            ?>
                                                <p><img class="img-preview" src="imagens/imagem.png" /></p>
                                            <?php
                                            }
                                            ?>
                                            <p>
                                                <label class="btn-file"><b>Selecione uma imagem</b>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
                                                    <input type="file" name="Imagem" accept="image/*"></label>
                                            </p>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>
                                            <input type="submit" value="Alterar" class="btn">
                                            <input type="button" value="Cancelar" class="btn btn-cancel" onclick="window.location.href='ExercicioListar.php'">
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
    </div>
=======
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
												<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='ExercicioListar.php'">
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
>>>>>>> 5b081a2b00e026c1d64d0aedff7679df3b6b55e4
</body>

</html>
