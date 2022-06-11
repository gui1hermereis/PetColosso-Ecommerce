<?php
    require_once '../sql/conexao.php';//Chama conexão
    session_start();

    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador, se nao for proibe a entrada
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");   
    }

    if(!empty($_GET['id_prod'])) {
        $id = $_GET['id_prod'];
        
        //Seleciona do banco de dados os produtos selecionados por ordem de id
        $sqlSelect = "SELECT * FROM produtos WHERE id_prod=$id";
        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            //Deleta os produtos que o administrador clicar
            $sqlDelete = "UPDATE produtos SET prod_status = 'i' WHERE id_prod=$id";
            $resultDelete = $conexao->query($sqlDelete);

            //Mensagem de sucesso
            echo "<script language='javascript'>";
                $_SESSION['msg'] = "<h5>Produto desativado com sucesso<br> ID do produto: ".$id."</h5>";
                echo "window.location='../administrador/produtosadm.php'";//Redirecionamento
            echo "</script>";
        }
    }

    mysqli_close($conexao); //Fecha conexão com banco de dados
?>