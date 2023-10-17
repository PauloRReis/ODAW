<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário PHP</title>
</head>
<body>

<?php
$nome = $email = $senha = $mensagem = $sexo = $hobbies = "";

$nomeErr = $emailErr = $senhaErr = $sexoErr = "";

function validarEntrada($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nome"])) {
        $nomeErr = "Nome é obrigatório";
    } else {
        $nome = validarEntrada($_POST["nome"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "E-mail é obrigatório";
    } else {
        $email = validarEntrada($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de e-mail inválido";
        }
    }

    if (empty($_POST["senha"])) {
        $senhaErr = "Senha é obrigatória";
    } else {
        $senha = validarEntrada($_POST["senha"]);
    }

    if (empty($_POST["sexo"])) {
        $sexoErr = "Sexo é obrigatório";
    } else {
        $sexo = validarEntrada($_POST["sexo"]);
    }

    if (!empty($_POST["hobbies"])) {
        $hobbies = $_POST["hobbies"];
    }

    if (empty($nomeErr) && empty($emailErr) && empty($senhaErr) && empty($sexoErr)) {
        echo '<script>alert("Formulário enviado com sucesso!\n\nNome: ' . $nome . '\nE-mail: ' . $email . '\nSexo: ' . $sexo . '");</script>';
    }
}
?>

<h2>Formulário de Exemplo</h2>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Nome: <input type="text" name="nome">
    <span class="error"><?php echo $nomeErr;?></span>
    <br><br>

    E-mail: <input type="text" name="email">
    <span class="error"><?php echo $emailErr;?></span>
    <br><br>

    Senha: <input type="password" name="senha">
    <span class="error"><?php echo $senhaErr;?></span>
    <br><br>

    Sexo:
    <input type="radio" name="sexo" value="masculino">Masculino
    <input type="radio" name="sexo" value="feminino">Feminino
    <span class="error"><?php echo $sexoErr;?></span>
    <br><br>

    Hobbies:
    <input type="checkbox" name="hobbies[]" value="esporte">Esporte
    <input type="checkbox" name="hobbies[]" value="leitura">Leitura
    <input type="checkbox" name="hobbies[]" value="viagem">Viagem
    <br><br>

    <input type="submit" name="submit" value="Enviar">
    <input type="reset" name="reset" value="Limpar">
</form>

<a href="ex2Login.php">
    <button type="button">Ir para a Página de Login</button>
</a>

</body>
</html>
