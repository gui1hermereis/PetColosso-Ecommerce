<?php
    //Desconecta quem esta logado por um botão e o redireciona
    session_start();
    session_destroy();//Destroi a sessão
    header("Location: ../paginas/acessarconta.php");//Redirecionamento
?>