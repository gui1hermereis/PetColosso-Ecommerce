<?php
    require_once '../sql/conexao.php';//Chama conexão
    session_start();
    
    $extensoes_permitidas = ["jpg", "jpeg", "png"]; //Extensões permitidas no site

    //Cadastra novo produto no site
    if(isset($_FILES['arquivo'])){
        $file = $_FILES['arquivo'];

        $file_name = $file['name'];
        $type_file = $file['type'];

        if ($file['error']) {
            die("Arquivo não enviado");
        }

        //Dados recebidos do formulario
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];
        $estoque = $_POST['estoque'];
        $extensao = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $novo_nome = md5(time()).".".$extensao;
        $diretorio = "../../images/produtos/";

        if (in_array($extensao, $extensoes_permitidas)) {
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
            $result = mysqli_query($conexao, "INSERT INTO produtos (prod_nome, prod_valor, prod_estoque, prod_imagem, prod_status) VALUES ('$produto','$valor','$estoque','$novo_nome','a')");
            
            //Mensagem se cadastrado com sucesso
            echo "<script language='javascript'>";
                $_SESSION['erro'] = "<h3>Produto Cadastrado com sucesso</h3><br>";
                echo "window.location='../administrador/cadastrarprod.php'";
            echo "</script>";
        } else {
            //Mensagem caso extensão nao for permitida
            echo "<script language='javascript'>";
                $_SESSION['erro'] = "<h3>Extensão não permitida</h3><br>";
                echo "window.location='../administrador/cadastrarprod.php'";
            echo "</script>";
        }
    }
    
    mysqli_close($conexao); //Fecha conexão com banco de dados
?>