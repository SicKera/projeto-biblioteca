<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styleVerificar.css">
    <title>Excluir Livro</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastrar Usuário</a></li>
                <li><a href="verificarCadastro.php">Buscar Usuários</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <form action="" method="post">
                <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo do livro">
                <input type="submit" value="Excluir">
            </form>
        </section>
        <section>

            <?php

                // verificar se o campo email está preenchido
                if(isset($_POST["titulo"])){

                    // Exibir as informaçãoes passadas pelo forms
                    // echo var_dump($_POST);
                
                    // Salva as informações de email enviada pelo forms
                    $titulo = $_POST["titulo"];
                    
                    // Recebe as informações de conexão do DB
                    include("../conexao/conexao.php");

                    // Query de banco de dados
                    $sql = "DELETE FROM cadastro_livros WHERE titulo = ?";

                    // Preparar a conexão junto da consulta
                    $stmt = $conn ->prepare($sql);

                    // Validando se a conexão foi feita com sucesso
                    if($stmt){
                        // Troca a informaçõa de e-mail por '?' no $sql
                        $stmt->bind_param("s", $titulo);
                    }
                    // Executar o comando
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    // echo var_dump($resultado);
                    
                    if($stmt->affected_rows > 0){if($stmt->affected_rows > 0){
                            echo "<p>Livro excluído com sucesso!</p>";
                            } else {
                            echo "<p>Nenhum livro encontrado com o titulo informado.</p>";
                            }

                            $stmt->close();
                            } else {
                            echo "<p>Erro na preparação da consulta: " . $conn->error . "</p>";
                            }

                            $conn->close();
                }
            ?>

        </section>
    </main>
</body>
</html>