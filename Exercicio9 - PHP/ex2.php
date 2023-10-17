<html>

<?php

    function inverterNome($nome){
        $nomeSeparado = explode(' ', $nome);
        $nomeInvertido = $nomeSeparado[count($nomeSeparado) - 1];
        for ($i = count($nomeSeparado) - 2; $i >= 0; $i--) {
            $nomeInvertido .= ' ' . $nomeSeparado[$i];
        }
        return $nomeInvertido;
    }

    $nomeCompleto = 'Paulo Ricardo dos Reis';
    echo 'Nome completo: ' . $nomeCompleto . '<br>';
    echo 'Nome invertido: ' .inverterNome($nomeCompleto) . '<br>';
    echo 'Nome ao contrario: ' .strrev($nomeCompleto) . '<br>';

?>

</html>