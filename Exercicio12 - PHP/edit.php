<!DOCTYPE html>
<html>
<head>
    <title>Editar Cadastro</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "formulario";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "UPDATE cadastro SET nome='$nome', email='$email' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso.";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM cadastro WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>

    <h2>Editar Cadastro</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="nome" value="<?php echo $row['nome']; ?>" placeholder="Nome" required>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" required>
        <button type="submit" name="update">Atualizar</button>
    </form>

    <?php
        } else {
            echo "Registro não encontrado.";
        }
    } else {
        echo "ID de registro não fornecido.";
    }
    ?>

    <a href="cadastro.php">Voltar para a lista de cadastros</a>
</body>
</html>
