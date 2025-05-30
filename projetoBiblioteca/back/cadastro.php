<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleCadastrar.css">
    <title>Cadastro de Usuário</title>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="">Cadastrar Livro</a></li>
                <li><a href="verificarCadastro.php">Buscar Usuário</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="cadastro.php" method="post">
            <h2>Cadastro de Usuário</h2>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="idade">Idade:</label>
            <input type="text" name="idade" id="idade" required>

            <input type="submit" value="Cadastrar">
        </form>

        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try{
                    //Capturar um arquivo externo
                    include("../conexao/conexao.php");

                    //Variáveis usuários
                    $nome = $_POST["nome"];
                    $cidade = $_POST["cidade"];
                    $email = $_POST["email"];
                    $idade = $_POST["idade"];
                    

                    //Consulta SQL 
                    $sql = "INSERT INTO cadastro_usuario (id_usuario, nome_usuario, email_usuario, idade_usuario, cidade_usuario)  VALUES (?, ?, ?, ?, ?)";

                    //Preparar a consulta
                    $stmt = $conn->prepare($sql);

                    //Vincular as variáveis do usuário com a consulta SQL
                    $stmt->bind_param("sssss" , $id,$nome, $email, $idade, $cidade);

                    //Executar a consulta
                    $stmt->execute();

                    //Exibindo a mensagem de sucesso
                    echo "<div class = 'mensagem sucesso'> Usuário cadastrado com sucesso </div>";

                    //Encerrar a consulta SQL e Conexão com o banco de dados
                    $stmt->close();
                    $conn->close();
                }
                catch (mysqli_sql_exception $e){
                    echo "<div class = 'mensagem erro'> Erro ao cadastrar " . $e->getMessage() . "</div>";
                }
                
            }
            


        ?>

    </main>




    

    
</body>
</html>