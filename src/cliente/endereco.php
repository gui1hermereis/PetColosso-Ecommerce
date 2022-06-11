<?php
    require_once '../sql/conexao.php'; // Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não estiver logado
    }

    $logado = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar endereço - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

         <!------------- javaScript ViaCep ------------->
         <script type="text/javascript" >
            function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('rua').value=("");
                    document.getElementById('bairro').value=("");
                    document.getElementById('cidade').value=("");
                    document.getElementById('uf').value=("");
                    document.getElementById('ibge').value=("");
            }

            function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    //Atualiza os campos com os valores.
                    document.getElementById('rua').value=(conteudo.logradouro);
                    document.getElementById('bairro').value=(conteudo.bairro);
                    document.getElementById('cidade').value=(conteudo.localidade);
                    document.getElementById('uf').value=(conteudo.uf);
                    document.getElementById('ibge').value=(conteudo.ibge);
                } //end if.
                else {
                    //CEP não Encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            }
                
            function pesquisacep(valor) {

                //Nova variável "cep" somente com dígitos.
                var cep = valor.replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        document.getElementById('rua').value="...";
                        document.getElementById('bairro').value="...";
                        document.getElementById('cidade').value="...";
                        document.getElementById('uf').value="...";
                        document.getElementById('ibge').value="...";

                        //Cria um elemento javascript.
                        var script = document.createElement('script');

                        //Sincroniza com o callback.
                        script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                        //Insere script no documento e carrega o conteúdo.
                        document.body.appendChild(script);

                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            };
        </script>
        <center>
            <?php
                //Mensagem de sucesso
                if(isset($_SESSION['sucesso'])){
                    echo $_SESSION['sucesso'];
                    unset($_SESSION['sucesso']);
                }
            ?>
        </center>

        <h3 class="title">Endereço</h3>
        <!--Formulario para cadastrar novo endereço-->
        <div class="formulario">
                <center>
                <form action="../sql/cadastraendereco.php" method="POST" onsubmit="return valida( this )";>
                    <p>CEP: </p>
                        <input name="cep" type="text" id="cep" onblur="pesquisacep(this.value);" placeholder="CEP" required maxlength="8"><br><br>
                    <p>Rua: </p>
                        <input name="rua" type="text" id="rua"  required placeholder="Rua"><br><br>
                    <p>Bairro: </p>
                        <input name="bairro" type="text" id="bairro" required placeholder="Bairro"><br><br>
                    <p>Cidade: </p>
                        <input name="cidade" type="text" id="cidade" required placeholder="Cidade"><br><br>
                    <p>Estado: </p>
                        <input name="uf" type="text" id="uf" required placeholder="Estado"><br><br>
                    <p>Complemento: </p>
                        <input name="complemento" type="text" id="Complemento" placeholder="Complemento"><br><br>
                    <p>Número: </p>
                        <input name="numero" type="number" id="numero" required placeholder="Numero"><br>
                    <input name="ibge" type="hidden" id="ibge">
                    <div class="dados">
                        <button type="submit" name="submit" class="btn" title="Enviar">Enviar</button>
                    </div>
                </center>
            </form>
        </div>
        
        &nbsp;&nbsp;&nbsp;
        <a href="javascript: history.go(-2)" class="btn">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?> 
        
        <!--Codigo JavaScript-->
        <script language="javascript">
            function valida( frm ){
                var cep = frm.cep.value ;
                var numero = frm.numero.value ;
                var msg = "" ;
                if ( cep.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    cep = cep.replace( /\s/g , "" ) ;
                }	
                if ( cep.search( /[^a-z0-9]/i ) != -1 ){
                    msg += "Não é permitido caracteres especiais" ;
                    cep = cep.replace( /[^a-z0-9]/gi , "" ) ;
                }
                if ( numero.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    numero = numero.replace( /\s/g , "" ) ;
                }	
                if ( numero.search( /[^a-z0-9]/i ) != -1 ){
                    msg += "Não é permitido caracteres especiais" ;
                    numero = numero.replace( /[^a-z0-9]/gi , "" ) ;
                }
                if ( msg ){
                    alert( msg ) ;
                    frm.cep.value = cep ;
                    frm.numero.value = numero ;
                    return false ;
                }
                return true ;	
            }
        </script>

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>
    </body>
</html>