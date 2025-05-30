<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleVerificar.css">
    <title>Buscar Livros</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastrar Usuário</a></li>
                <li><a href="verificarCadastro.php">Listas Usuários</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <form action="" method="post">
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do livro...">
                <input type="submit" value="Buscar">
            </form>
        </section>
        <section>

            <?php

                // verificar se o campo email está preenchido
                if(isset($_POST["nome"])){

                    // Exibir as informaçãoes passadas pelo forms
                    echo var_dump($_POST);
                
                    // Salva as informações de email enviada pelo forms
                    $email = $_POST["nome"];
                    
                    // Recebe as informações de conexão do DB
                    include("../conexao/conexao.php");

                    // Query de banco de dados
                    $sql = "SELECT * FROM  cadastro_livros WHERE titulo = ?";

                    // Preparar a conexão junto da consulta
                    $stmt = $conn ->prepare($sql);

                    // Validando se a conexão foi feita com sucesso
                    if($stmt){
                        // Troca a informaçõa de e-mail por '?' no $sql
                        $stmt->bind_param("s", $nome);
                    }
                    // Executar o comando
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    echo var_dump($resultado);
                    
                    if($resultado->num_rows > 0){
                        // Se o número de linhas for maior que zero
                        echo "Livro já cadastrado";
                        // Armazenar as informações dele
                        $row = $resultado->fetch_assoc();
                        echo var_dump($row);
                        // Caso o número de linhas for igual a zero
                    }else{
                        echo "Livro inexistente!";
                    }
                }
            ?>

        </section>
    </main>
</body>
</html>