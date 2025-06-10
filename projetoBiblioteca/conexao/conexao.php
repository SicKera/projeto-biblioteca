<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "biblioteca";

//Criando Conexão
$conn = new mysqli($serverName, $userName, $password, $dbName, port:3307);

//Validação de Conexão
if ($conn->connect_error){
    echo "Conexão Falhou";
}else{
    // echo"Conexão feita com sucesso";
}


?>