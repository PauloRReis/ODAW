<?php

    $contador = file_get_contents('contador.txt');
    $contador++;
    file_put_contents('contador.txt', $contador);
    echo "Está pagina foi visitada $contador vezes. <br>" 

?>