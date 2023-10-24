<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Pessoas</title>
</head>
<body>
    <?php

    $conn = mysqli_connect("localhost", "root", "folgado23", "formulario");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "INSERT INTO cadastro (nome, email) VALUES ('$nome', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso.";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
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

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM cadastro WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Registro excluído com sucesso.";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Cadastro de Pessoas</h2>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="submit">Inserir</button>
    </form>

    <h2>Cadastros Efetuados</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM cadastro";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td><a href='?delete=" . $row['id'] . "'>Excluir</a> | <a href='edit.php?id=" . $row['id'] . "'>Editar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum registro encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
