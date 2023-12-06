<?php
    session_start();

    $localhost = conectar();

    $_SESSION["login"] = false;
    
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    
    $query_id = mysqli_query($conexao, "SELECT * from usuarios where email = '$email' and senha = '$senha'");
    $row = mysqli_fetch_array($query_id);

    
    if($row["ID_Usuario"] == null) {
        echo "<font color='erro'> Email ou senha incorreto(s). <br> </font>";
        mysqli_close($conexao);
        exit;
    }
    
    // // server should keep session data for AT LEAST 1 hour
    // ini_set('session.gc_maxlifetime', 10);
    // session_start();

    // echo "<h1>id: $row_id</h1>";
    // echo "<font color='green'> Cadastro feito com sucesso. <br> </font>";
    echo "1";
    $_SESSION["login"] = true;
    $_SESSION["ID_Usuario"] = $row["ID_Usuario"];
    $_SESSION["Nome"] = $row["Nome"];
    mysqli_close($conexao);
?>