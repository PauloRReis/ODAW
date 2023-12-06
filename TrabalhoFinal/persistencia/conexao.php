<?php

    function conectar(){

        $hostname_localhost = "localhost";
        $username_localhost = "root";
        $password_localhost = "folgado23";
        $database_localhost = "site_receitas";

        $localhost = new mysqli($hostname_localhost, $username_localhost, $password_localhost, $database_localhost);

        if(mysqli_connect_errno()){
            printf("Erro na conexão com o banco de dados: %s\n", mysqli_connect_error());
            exit();
        }
        return $localhost;
    }

?>