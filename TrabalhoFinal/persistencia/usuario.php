<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 3500);
error_reporting(E_ALL);
ini_set('display_erros','On');

if(!isset($_POST['op'])){
    die("Acesso não autorizado!!");
}

header("Access-Control-Allow-Origin: *"); // Permite solicitações de qualquer origem
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeçalhos permitidos

include("conexao.php");
$localhost = conectar();

$d1 = 'site_receitas';
if($_POST['op'] == "0"){ //SELECT
    $sql = "SELECT * FROM usuarios";
    $r1 = $localhost->query($sql);
    $res = array();
    while($row = $r1->fetch_array()){
        $rs = array($row[0], $row[1], $row[2], $row[3], $row[4]);
        $res["".$row[0]] = $rs;
    }
    $localhost->close();
    $json = json_encode($res);
    die($json);

}elseif($_POST['op'] == "1"){ //INSERT
    $d = explode("^", $_POST["dados"]);
    $sql = "INSERT INTO usuarios(nome, email, senha, sobrenome) VALUES ('".$d[0]."','".$d[1]."', '".$d[2]."' , '".$d[3]."')";
    $localhost->query($sql);

    $r1 = $localhost->query("SELECT LAST_INSERT_ID()");
    $r = $r1 -> fetch_array();
    $idINS = $r[0];
    $localhost->close();

    die($idINS."^".$d[0]."^".$d[1]."^".$d[2]."^".$d[3]);
}elseif($_POST['op'] == "2"){
    $d = explode("^", $_POST["dados"]);
    $sql = " SELECT * FROM usuarios WHERE email='".$d[0]."' AND senha='".$d[1]."' ";
    $r1 = $localhost->query($sql);
    $res = array();
    while($row = $r1->fetch_array()){
        $rs = array($row[0], $row[1], $row[2], $row[3], $row[4]);
        $res["".$row[0]] = $rs;
    }
    $localhost->close();
    $json = json_encode($res);
    die($json);

}

$localhost->close();
?>