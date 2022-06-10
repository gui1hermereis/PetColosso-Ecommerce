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
        $id = $_POST['id_prod'];
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];
        $estoque = $_POST['estoque'];
        $extensao = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $novo_nome = md5(time()).".".$extensao;
        $diretorio = "../../images/produtos/";

        if (in_array($extensao, $extensoes_permitidas)) {
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
            $result = mysqli_query($conexao, "UPDATE `produtos` SET `prod_nome` = '$produto',`prod_valor` = '$valor',`prod_estoque` = '$estoque',`prod_imagem` = '$novo_nome', `prod_status` = 'a' WHERE `id_prod` = '$id'");
            
            //Alert se cadastrado com sucesso
            echo "<script language='javascript'>";
                echo "alert('Produto editado com sucesso!');";
                echo "window.location='../administrador/produtosadm.php'";
            echo "</script>";
        } else {
            //Alert caso extensão nao for permitida
            echo "<script language='javascript'>";
                echo "alert('Extensão nao permitida!');";
                echo "window.location='../administrador/produtosadm.php'";
            echo "</script>";
        }
    }
    
    mysqli_close($conexao); //Fecha conexão com banco de dados
?>
