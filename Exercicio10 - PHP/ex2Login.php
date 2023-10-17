<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PHP</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<?php
$usuario = $senha = "";
$usuarioErr = $senhaErr = "";

function validarEntrada($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-login"])) {

    $usuario = validarEntrada($_POST["usuario"]);
    $senha = validarEntrada($_POST["senha"]);

    $autenticacao = file("autenticacao.txt", FILE_IGNORE_NEW_LINES);
    foreach ($autenticacao as $linha) {
        list($usuarioArmazenado, $senhaArmazenada) = explode(",", $linha);
        if ($usuario == $usuarioArmazenado && password_verify($senha, $senhaArmazenada)) {
            header("Location: formulario.php");
            exit();
        } else {
            echo '<script>alert("Usuário ou senha incorretos.");</script>';
        }
    }
}
?>

<h2>Tela de Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Usuário: <input type="text" name="usuario" required>
    <br><br>

    Senha: <input type="password" name="senha" required>
    <br><br>

    <input type="submit" name="submit-login" value="Login">
</form>

</body>
</html>
