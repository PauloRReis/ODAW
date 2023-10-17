<?php

if (isset($_COOKIE['nome'])) {
    echo 'Olá ' . $_COOKIE['nome'] . ', seja bem-vindo de volta!<br>';
} else {
    setcookie('nome', 'Paulo', time() + 7200);
    echo 'Olá visitante, esperamos que goste do nosso site!<br>';
}

?>