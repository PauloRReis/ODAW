<?php
$errors = array();
$nome = $email = $senha = $idade = $esporteFavorito = '';

function validarCamposObrigatorios($campos) {
    foreach ($campos as $campo) {
        if (empty($_POST[$campo])) {
            return false;
        }
    }
    return true;
}

function cifrarSenha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $camposObrigatorios = array('nome', 'email', 'senha', 'idade', 'esporte_favorito');
    $senhaCifrada = cifrarSenha($senha);

    if (!validarCamposObrigatorios($camposObrigatorios)) {
        $errors[] = 'Todos os campos são obrigatórios';
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $idade = $_POST['idade'];
        $esporteFavorito = $_POST['esporte_favorito'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'O e-mail inserido é inválido';
        }

        if (strlen($senha) < 6) {
            $errors[] = 'A senha deve ter pelo menos 6 caracteres';
        }
    }

    if (empty($errors)) {
        echo 'Mensagem de confirmação:<br>';
        echo 'Nome: ' . $nome . '<br>';
        echo 'E-mail: ' . $email . '<br>';
        echo 'Idade: ' . $idade . '<br>';
        echo 'Esporte Favorito: ' . $esporteFavorito . '<br>';
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }

    file_put_contents('autenticacao.txt', "$nome:$senhaCifrada\n", FILE_APPEND);
    echo "Cadastro realizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário PHP</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <br>

        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email">

        <br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <br>

        <label for="idade">Idade:</label>
        <input type="text" name="idade" id="idade">

        <br>

        <label for="esporte_favorito">Esporte Favorito:</label>
        <input type="text" name="esporte_favorito" id="esporte_favorito">

        <br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>

    <a href="ex2.php">Ir para a Tela de Login</a>

</body>
</html>
