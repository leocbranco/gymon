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
    <?php require 'menu.php'; ?>
    <?php require 'cfg.php'; ?>

    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <h1 class="w3-xxlarge">Cadastro de Exercícios</h1>

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

                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-theme">
                        <h2>Informe os dados do novo Exercicio</h2>
                    </div>
                    <form class="w3-container" action="ExercicioCriar_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                            <tr>
                                <td style="width:50%;">
                                    <p>
                                        <label class="w3-text-deep-purple"><b>Nome</b></label>
                                        <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." required>
                                    </p>
                                    <p>
                                        <label class="w3-text-deep-purple"><b>Descrição</b></label>
                                        <textarea class="w3-input w3-border w3-light-grey " name="Ementa" rows="5" title="Texto Descritivo" required></textarea>
                                    </p>
                                </td>
                                <td style="text-align:center">
                                    <p>
                                        <label class="w3-text-deep-purple"><b>ImagemSelecionada: </b></label>
                                        <p><img id="imagemSelecionada" src="assets/imagem.png" /></p>
                                    </p>
                                    <p>
                                        <label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
                                        <input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
                                    </p>
                                </td>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Registrar" class="w3-btn w3-theme">
                                    <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='.'">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
            </p>
        </div>
</body>

</html>