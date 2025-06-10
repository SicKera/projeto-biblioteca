<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleVerificar.css">
    <title>Lista de Livros</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastrar Usuário</a></li>
                <li><a href="listaUsuarios.php">Lista de Usuários</a></li>
            </ul>
        </nav>
    </header>
    <main>
        
        <section>

            <?php
include("../conexao/conexao.php");

// Consulta ao banco de dados
$sql = "SELECT * FROM cadastro_livros";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Titulo</th><th>Autor</th><th>Gênero</th><th>Ano</th></tr>";

    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Autor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Ano']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum livro cadastrado!";
}
?>


        </section>
    </main>
</body>
</html>