<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Cadastro</title>
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
        <section>
            <form action="atualizarCadastro.php" method="post">
                <label>Digite seu e-mail:</label>
                <input type="email" name="email" id="email" required>
                <button type="submit">Buscar</button>
            </form>
        </section>
        <?php
        
        if(isset($_POST["email"])) {
            $email = $_POST["email"];


        include("../conexao/conexao.php");

        // Consulta SQL para buscar os dados do usuário pelo e-mail cadastrado
        $sql = "SELECT * FROM cadastro_usuario WHERE email_usuario = ?";

        // Prepara a consulta
        $stmt = $conn->prepare($sql);

        // Vincula o parâmetro(email) à consulta
        $stmt->bind_param("s", $email);

        // Executa a consulta
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verifica se encontrou algum resultado
        if($result->num_rows > 0) {
            // Obter os dados do usuario
            $row = $result->fetch_assoc();

            // Exibir formulário de atualização com os dados atuais
            echo '<section>
                <form action="atualizarCadastro.php" method="post">
                    <h2>Atualizar Dados</h2>
                    
                    <input type="hidden" name="atualizar" value="1">
                    <input type="hidden" name="id" value="' . $row["id_usuario"] . '">
                    
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="' . $row["nome_usuario"] . '" required>

                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" value="' . $row["email_usuario"] . '" required>
                    
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" value="' . $row["cidade_usuario"] . '" required>
                    
                    <label for="idade">Idade:</label>
                    <input type="text" name="idade" id="idade" value="' . $row["idade_usuario"] . '" required>
                    
                    <input type="submit" value="Atualizar Cadastro">
                </form>
            </section>';

        }else{
            echo"<p>Usuário não encontrado. Verifique o email informado.</p>";
        }

        // Fecha a consulta e a conexão
        $stmt->close();
        $conn->close();
        }
        ?>

        <?php
        // Verificar se o formulário de atualização foi enviado
        if(isset($_POST["atualizar"])) {
            // Usar try-catch para tratamento de erros
            try {
                // Incluir os arquivos de conexão
                include("../conexao/conexao.php");

                // Capturar os dados do formulário
                $id = $_POST["id"];
                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $cidade = $_POST["cidade"];
                $idade = $_POST["idade"];
                
                // Consulta SQL para atualizar os dados
                $sql = "UPDATE cadastro_usuario SET nome_usuario = ?, email_usuario = ?, idade_usuario = ?, cidade_usuario = ? WHERE id_usuario = ?";

                // Preparar a consulta
                $stmt = $conn->prepare($sql);

                // Vincular os parâmetros
                $stmt->bind_param("ssssi", $nome, $email, $idade, $cidade, $id);

                // Executa a query
                $stmt->execute();

                // Verifica se a atualização foi bem-sucedida
                if($stmt->affected_rows > 0) {
                    echo"<div class='mensagem sucesso'>Cadastro atualizado com sucesso!</div>";
                } else{
                    echo "<div class='mensagem'>Nenhuma alteração foi feita ou o usuário não existe.</div>";
                }

                // Fecha a consulta e a conexão
                $stmt->close();
                $conn->close();
            } catch(PDOException $e) {
                echo "<div class='mensagem erro'>Erro ao atualizar cadastro: ". $e->getMessage() . $e->getMessage() . "</div>";
            }
        }
        ?>
            