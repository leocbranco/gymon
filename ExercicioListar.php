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

        #imagemSelecionada {
            width: 50%;
            height: auto;
        }
    </style>
</head>

<body onload="w3_show_nav('menuDisc')">
    <!-- Inclui MENU.PHP  -->
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <h1 class="w3-xxlarge">Relação de Exercícios</h1>

            <p class="w3-large">
            <p>
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

                // Verifica conexão
                $conn = mysqli_connect($dbHost, $username, $password, $dbname);

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
                $sql = "SELECT ID_Exercicio, Nome_Exercicio, Descricao_Exercicio, FotoBin FROM Exercicios";

                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='7%'>Código</th>";
                    echo "	  <th width='10%'>Nome</th>";
                    echo "	  <th>Ementa</th>";
                    echo "	  <th width='20%'>Imagem</th>";
                    echo "	  <th> </th>";
                    echo "	  <th> </th>";
                    echo "	</tr>";
                    if (mysqli_num_rows($result) > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cod = $row["ID_Exercicio"];
                            echo "<tr>";
                            echo "<td>";
                            echo $cod;
                            echo "</td><td>";
                            echo $row["Nome_Exercicio"];
                            echo "</td><td>";
                            echo $row["Descricao_Exercicio"];
                            echo "</td>";
                            if ($row['FotoBin']) { ?>
                                <td style="text-align:left">
                                    <img id="imagemSelecionada" src="data:image/png;base64,<?= base64_encode($row['FotoBin']) ?>" />
                                </td>
                                <?php
                            } else {
                                ?>
                                <td style="text-align:left">
                                    <img id="imagemSelecionada" src="imagens/imagem.png" />
                                </td>
                                <?php
                            }
                            //Atualizar e Excluir registro de disciplina
                                ?>
                                <td>
                                <a href='ExercicioAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Disciplina' width='32'></a>
                                </td>
                                <td>
                                    <a href='ExercicioExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Disciplina' width='32'></a>
                                </td>
                                </tr>
                    <?php

                        }
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . mysqli_error($conn);
                }

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