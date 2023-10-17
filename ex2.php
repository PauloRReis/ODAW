<?php

function validarSenha($senhaDigitada, $senhaCifrada) {
    return password_verify($senhaDigitada, $senhaCifrada);
}

function validarLogin($usuario, $senha)
{
    $usuario = $_POST['usuario'];
    $senhaDigitada = $_POST['senha'];

    $linhas = file('autenticacao.txt', FILE_IGNORE_NEW_LINES);
    echo $linhas;
    foreach ($linhas as $linha) {
        list($usuarioArquivo, $senhaCifrada) = explode(':', $linha);
        if ($usuario == $usuarioArquivo && validarSenha($senhaDigitada, $senhaCifrada)) {
            echo "Login bem-sucedido!";
            exit();
        }
    }

  return false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>

        <br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>

        <br>

        <input type="submit" value="Entrar">
    </form>

    <a href="ex1.php">Ir para a Tela de Cadastro</a>
</body>
</html>
