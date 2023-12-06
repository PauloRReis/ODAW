<?php
include("conexao.php");

$localhost = conectar();        

$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$senha = md5($_POST['senha']);
$senha_confirmada = md5($_POST['senha_confirmada']);

$query_verify_email = mysqli_query($conexao, "SELECT EXISTS (SELECT 1 from usuarios WHERE email = '$email') AS row_exists");
    if($query_verify_email){
        $result = mysqli_fetch_assoc($query_verify_email);
        $value = intval($result["row_exists"]);

        if($value == 1){
            echo "<font color='erro'> Erro no cadastro (email já cadastrado). <br> </font>";
            exit;
        }
    }

$query_verify_cpf = mysqli_query($conexao, "SELECT EXISTS (SELECT 1 from usuarios WHERE cpf = '$cpf') AS row_exists");
    if($query_verify_cpf){
        $result = mysqli_fetch_assoc($query_verify_cpf);
        $value = intval($result["row_exists"]);

        if($value == 1){
            echo "<font color='erro'> Erro no cadastro (CPF já cadastrado). <br> </font>";
            exit;
        }
    }

    $query_max_id = mysqli_query($conexao,"select max(ID_Usuario) from usuarios");

    if($query_max_id){
        $row_max_id = mysqli_fetch_assoc($query_max_id);
        $max_id = intval($row_max_id["max(ID_Usuario)"]) + 1;
    }
    else{
        $max_id = 0;
    }

    $query = "INSERT INTO usuarios (ID_Usuario, nome, sobrenome, email, senha, cpf) VALUES ('$max_id', '$nome', '$sobrenome', '$email', '$senha', '$cpf');";

    echo $query;

    if(mysqli_query($conexao, $query) != false){
        echo "<font color='green'> Cadastro feito com sucesso. <br> </font>";
    }
    else{
        echo "<font color='erro'> Erro no cadastro. <br> </font>";
    }
    mysqli_close($conexao);
?>