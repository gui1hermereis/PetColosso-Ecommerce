<?php
    //Banco de dados
    $servername = "127.0.0.1";
    $database = "petcolosso";
    $username = "petcolosso";
    $password = "PetcolossoBD";

    //Cria conexão
    $conexao = new mysqli($servername,$username,$password,$database);

    //Verifica conexão
    if (!$conexao) {
        die("falha na conexão: " . mysqli_connect_error());
    }
?>
