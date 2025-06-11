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
                <li><a href="verificarCadastro.php">Buscar Usuários</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <form action="" method="post">
                <input type="text" name="titulo" id="titulo" placeholder="Digite o nome do livro...">
                <input type="submit" value="Buscar">
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
                    $sql = "SELECT * FROM  cadastro_livros WHERE titulo = ?";

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
                    
                    if($resultado->num_rows > 0){
                        echo "<table border='1'>";
                        echo "<tr><th>Titulo</th><th>Autor</th><th>Gênero</th><th>Ano</th></tr>";

                        while ($row = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ano']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    }else{
                        echo "Livro inexistente!";
                    }
                }
            ?>

        </section>
    </main>
</body>
</html>