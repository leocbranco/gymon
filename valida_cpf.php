<?php
function validaCPF($cpf) {
    // Remove possíveis máscaras
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se a quantidade de dígitos é diferente de 11
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores para verificar se o CPF é válido
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = 11 - ($d % 11);
        if ($d == 10 || $d == 11) {
            $d = 0;
        }
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}
?>
