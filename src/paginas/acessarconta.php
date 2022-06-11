<?php
    session_start();
    
    //Verifica a sessão 
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm'] : '';

    //Define o direcionamento a partir do nivel de acesso e se esta logado
    if ($email != '' && $adm == 0){  
        header("Location: ../cliente/conta.php");//Redirecionamento se cliente
    } else {
        if($email != '' && $adm == 1) {
            header("Location: ../administrador/contaadm.php");//Redirecionamento se for administrador               
        }else{ 
            header("Location: ../paginas/logarcadastrar.php");//Redirecionamento se não logado                
        }   
    }
?>