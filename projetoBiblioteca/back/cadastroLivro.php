<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleCadastrar.css">
    <title>Cadastro de Livro</title>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="../back/cadastro.php">Cadastrar Usuário</a></li>
                <li><a href="verificarCadastro.php">Buscar Usuário</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="cadastroLivro.php" method="post">
            <h2>Cadastro de Livros</h2>

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" required>

            <label for="ano">Ano:</label>
            <input type="text" name="ano" id="ano" required>

            <label for="genero">Gênero:</label>
            <select name="genero" id="genero">
                <option value="ficcao">Ficção</option>
                <option value="romance">Romance</option>
                <option value="suspense">Suspense</option>
                <option value="policial">Policial</option>
                <option value="aventura">Aventura</option>
                <option value="tecnologia">Tecnologia</option>
                <option value="historia">História</option>
            </select>

            <label for="isbn">Codigo ISBN</label>
            <input type="text" name="isbn" id="isbn" placeholder="123-12-12345-12-1" required>

            <input type="submit" value="Cadastrar">
        </form>

        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try{
                    //Capturar um arquivo externo
                    include("../conexao/conexao.php");

                    //Variáveis usuários
                    $titulo = $_POST["titulo"];
                    $autor = $_POST["autor"];
                    $ano = $_POST["ano"];
                    $genero = $_POST["genero"];
                    $isbn = $_POST["isbn"];
                    

                    //Consulta SQL 
                    $sql = "INSERT INTO cadastro_livros (id_livro, titulo, autor, ano, genero, codigo_isbn)  VALUES (?, ?, ?, ?, ?, ?)";

                    //Preparar a consulta
                    $stmt = $conn->prepare($sql);

                    //Vincular as variáveis do usuário com a consulta SQL
                    $stmt->bind_param("ssssss" , $id,$titulo, $autor, $ano, $genero, $isbn);

                    //Executar a consulta
                    $stmt->execute();

                    //Exibindo a mensagem de sucesso
                    echo "<div class = 'mensagem sucesso'> Livro cadastrado com sucesso </div>";

                    //Encerrar a consulta SQL e Conexão com o banco de dados
                    $stmt->close();
                    $conn->close();
                }
                catch (mysqli_sql_exception $e){
                    echo "<div class = 'mensagem erro'> Erro ao cadastrar livro " . $e->getMessage() . "</div>";
                }
                
            }
            


        ?>

    </main>




    

    
</body>
</html>