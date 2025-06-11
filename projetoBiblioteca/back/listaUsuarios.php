<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleVerificar.css">
    <title>Lista de Usuários</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastrar Usuário</a></li>
                <li><a href="listaLivros.php">Lista de Livros</a></li>
            </ul>
        </nav>
    </header>
    <main>
        
        <section>

            <?php
                include("../conexao/conexao.php");

                // Consulta ao banco de dados
                $sql = "SELECT * FROM cadastro_usuario";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Idade</th></tr>";

                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nome_usuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email_usuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['idade_usuario']) . "</td>";
                        echo "</tr>";
                    }

                        echo "</table>";
                    } else {
                        echo "Nenhum usuário cadastrado!";
            }
        ?>


        </section>
    </main>
</body>
</html>