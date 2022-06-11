<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica a sessão 
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for administrador  
    }

    $logado = $_SESSION['nome'];

    //Realiza a busca dos dados digitados na pesquisa, se não tiver nenhuma pesquisa exibe todos registros da tabela
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM clientes WHERE id_cliente LIKE '%$data%' or id_usuario LIKE '%$data%' or cli_nome LIKE '%$data%' or cli_email LIKE '%$data%' or cli_cpf LIKE '%$data%' or cli_cel LIKE '%$data%' ORDER BY id_cliente DESC";
    }
    else
    { 
        $sql = "SELECT * FROM clientes ORDER BY id_cliente DESC";
    }
    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Administrador - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <div class="col-4">
            <?php echo "<h2>Administrador: $logado</h2>"; ?>
        </div>

        <!--Tabela de clientes cadastrados-->
        <div class="adm">
            <form>
                <input type="search" name= "search" placeholder="Pesquisar">
                <button onclick="searchData()" class="btn" title="Pesquisar">Pesquisar</button>
            </form>
        </div><br>
        <center>
            <?php
                //Mensagem de sucesso
                if(isset($_SESSION['sucesso'])){
                    echo $_SESSION['sucesso'];
                    unset($_SESSION['sucesso']);
                }
            ?>
        </center>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Acesso</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Exibe os dados de todos clientes cadastrados no site
                    if(mysqli_num_rows($result) > 0) {
                        while($user_data = mysqli_fetch_assoc($result)) {
                            //Dados dos clientes
                            $idcli = $user_data['id_cliente'];
                            $cli_nome = $user_data['cli_nome'];
                            $iduser = $user_data['id_usuario'];
                            $cli_email = $user_data['cli_email'];
                            $cli_cpf= $user_data['cli_cpf'];

                            $id_voto = $user_data['id_votacao'];

                            $sql_voto = "select votos from enquete where id_votacao = '$id_voto'";
                            $result_voto = $conexao -> query($sql_voto);
                            $row_voto = mysqli_fetch_array($result_voto);
                            $voto = $row_voto['votos'];

                            $sql_user = "select user_status,user_tipo from usuarios where id_usuario='$iduser'";
                            $result_user = $conexao -> query($sql_user);
                            $row_user = mysqli_fetch_array($result_user);
                            $status = $row_user['user_status'];
                            $tipo = $row_user['user_tipo'];

                            echo "<tr>";
                            echo "<td>$idcli</td>";
                            echo "<td>$cli_nome</td>";
                            echo "<td>$iduser</td>";
                            echo "<td>$cli_email</td>";
                            if ($cli_cpf > 0){
                                echo "<td>".$cli_cpf."</td>";
                            }else{ 
                                echo "<td>Não cadastrado</td>";
                            }
                            if ($tipo == 0){
                                echo "<td>Cliente</td>";
                            }else{ 
                                echo "<td>Admin</td>";
                            }
                            if ($status == 'a'){
                                echo "<td>Ativo</td>";
                            }else{ 
                                echo "<td>Inativo</td>";
                            }
                            echo "<td>

                            <a class='btn btn-sm btn-primary' href='../administrador/editaradm.php?id=$idcli' title='Editar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                </svg>
                            </a> 

                            <a class='btn' href='../administrador/enderecoclientes.php?id=$idcli' title='Endereço'> 
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-house' viewBox='0 0 16 16'>
                                    <path fill-rule='evenodd' d='M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z'/>
                                    <path fill-rule='evenodd' d='M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z'/>
                                </svg>
                            </a>
                            </td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<h2> &nbsp;&nbsp;&nbsp;&nbsp; Usuario não encontrado...</h2>";
                    }
                ?><br>
            </tbody>
        </table><br>

        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/cadastraradm.php" class="btn" title="Cadastrar novo">Cadastrar novo</a><br>  

        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/contaadm.php" class="btn" title="Voltar">Voltar</a>
        
        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>

        <!--Código JavaScript-->
        <script>
            var search = document.getElementById('pesquisar');

            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter") 
                {
                    searchData();
                }
            });

            function searchData()
            {
                window.location = '../administrador/administrador.php?search='+search.value;
            }
        </script>
    </body>
</html>