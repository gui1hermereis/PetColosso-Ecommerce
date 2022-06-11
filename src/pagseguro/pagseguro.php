<?php
    require_once('../pagseguro/config.php'); //Chama pagina config
    require_once('../pagseguro/utils.php'); //Chama pagina utils
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();
    
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não estiver logado 
    }

    //Consulta o id apartir da URL em metodo POST
    $logado = $_SESSION["usuario"];

    $total = $_SESSION['total'];

    $sqlSelect1 = "SELECT * FROM clientes WHERE id_usuario = '$logado'";
    $result1 = $conexao->query($sqlSelect1);

    while($user_data = mysqli_fetch_assoc($result1)) {
        $idcli = $user_data['id_cliente'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pagamento - Pet Colosso</title>
    <link rel="stylesheet" type="text/css" href="../../css/padrao.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php 
        $params = array(//Dados da conta pagseguro
            'email' => $PAGSEGURO_EMAIL,
            'token' => $PAGSEGURO_TOKEN
        );
        $header = array();

        $response = curlExec($PAGSEGURO_API_URL."/sessions", $params, $header);
        $json = json_decode(json_encode(simplexml_load_string($response)));
        $sessionCode = $json->id;
    ?>
</head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu -->
        <?php include ('../includes/menu.php'); ?><br>

        <!--Fomulario para inserir o cartão de credito -->
        <h3 class="title">Pagamento PagSeguro</h3>
        <div class="formulario">
        
            <form role="form" action="../pagseguro/pay.php" method="POST">
                <input type="hidden" name="brand">
                <input type="hidden" name="token">
                <input type="hidden" name="senderHash">
                <input type="hidden" name="shippingCoast" value="1.00">
                <input type="hidden" name="id" value=<?php echo $idcli?>>
                <input type="hidden" name="amount" value=<?php echo $total?>>
                <?php
                    //Dados do carrinho
                    $product_ids = array();
                    $product_qnts = array();
                    $product_valores = array();

                    if(!empty($_SESSION["carrinho"])){
                        foreach ($_SESSION["carrinho"] as $key => $value) {
                            $prods_valores = $value["item_quantity"] * $value["product_price"];

                            array_push($product_ids, $value["product_id"]);
                            array_push($product_valores, $prods_valores);
                            array_push($product_qnts, $value["item_quantity"]);
                        }
                    }
                ?>

                <input type="hidden" name="idprod" value=<?php echo htmlentities(serialize($product_ids)); ?>>
                <input type="hidden" name="prodvalor" value=<?php echo htmlentities(serialize($product_valores)); ?>>
                <input type="hidden" name="prodquant" value=<?php echo htmlentities(serialize($product_qnts)); ?>>

                <center>
                    <p>Numero do cartão:</p>
                    <input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus value="4111 1111 1111 1111"/><br>
                    <p>Validade:</p>
                    <input type="tel" class="form-control" name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required value="12/2030"/><br>
                    <p>CVV:</p>
                    <input type="tel" class="form-control" name="cardCVC" placeholder="CVV" autocomplete="cc-csc" required value="123"/><br>
                    <p>Parcelas:</p>    
                    <div class="pag">
                        <select name="installments" id="select-installments" class="form-control">
                            <option selected>1</option>
                        </select><br><br>
                    </div>
                        <input type="hidden" name="installmentValue">
                    <button class="btn" type="submit">Pagar</button>
                </center>
            </form>
        </div>

        &nbsp;&nbsp;&nbsp;
       <a href="../carrinho/confirmardados.php" class="btn">Voltar</a>

    <!--Footer -->
    <?php include ('../includes/footer.php'); ?>

    <!--Codigo JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $JS_FILE_URL ?>"></script>

    <script>
        var installments = [];
    
        $("input[name='cardNumber']").keyup(function(){
            getInstallments();
        });

        $("#select-installments").change(function(){
            console.log(installments[$(this).val()-1]);
            $("input[name='installmentValue']").val(installments[$(this).val()-1].installmentAmount);
        });

        function getInstallments(){
            
            var cardNumber = $("input[name='cardNumber']").val();

            //se o número do cartão de crédito for finalizado, vai parcelar
            if(cardNumber.length != 19){
                return;
            } 

            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.replace(/ /g,''),
                success: function(json){
                    console.log(json);
                    var brand = json.brand.name;
                    $("input[name='brand']").val(brand);
                    
                    var amount = parseFloat($("input[name='amount']").val());
                    var shippingCoast = parseFloat($("input[name='shippingCoast']").val());
                    
                    //Quantidade máxima de parcela sem taxas extras (Você deve configurar no seu painel do PagSeguro com o mesmo valor)
                    var max_installment_no_extra_fees = 2;

                    PagSeguroDirectPayment.getInstallments({
                        amount: amount + shippingCoast,
                        brand: brand,
                        maxInstallmentNoInterest: max_installment_no_extra_fees,
                        success: function(response) {
                            
                        /*
                            Opções de parcelas disponíveis.
                            Aqui você tem opções de quantidade e valor
                        */
                            
                            console.log(response);
                            installments = response.installments[brand];
                            $("#select-installments").html("");
                            for(var installment of installments){
                                $("#select-installments").append("<option value='" + installment.quantity + "'>" + installment.quantity + " x R$ " + installment.installmentAmount + " - " + (installment.quantity <= max_installment_no_extra_fees? "Sem" : "Com")  + " Juros</option>");
                            }

                        }, error: function(response) {
                            console.log(response);
                        }, complete: function(response) {
                            //Chamado após sucesso ou erro
                        } 
                    });
                }, error: function(json){
                    console.log(json);
                }, complete: function(json){
                    console.log(json);
                }
            });
        }
            
        $("button").click(function(){
            var param = {
                cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
                brand: $("input[name='brand']").val(),
                cvv: $("input[name='cardCVC']").val(),
                expirationMonth: $("input[name='cardExpiry']").val().split('/')[0],
                expirationYear: $("input[name='cardExpiry']").val().split('/')[1],
                success: function(json){
                    var token = json.card.token;
                    $("input[name='token']").val(token);
                    console.log("Token: " + token);

                    var senderHash = PagSeguroDirectPayment.getSenderHash();
                    $("input[name='senderHash']").val(senderHash);
                    $("form").submit();
                }, error: function(json){
                    console.log(json);
                }, complete:function(json){
                }
            }

            PagSeguroDirectPayment.createCardToken(param);
        });

        jQuery(function($) {

            var shippingCoast = parseFloat($("input[name='shippingCoast']").val());
            var amount = parseFloat($("input[name='amount']").val());
            $("input[name='installmentValue']").val(amount + shippingCoast);

            PagSeguroDirectPayment.setSessionId('<?php echo $sessionCode;?>');

            PagSeguroDirectPayment.getPaymentMethods({
                success: function(json){

                    console.log(json);
                    getInstallments();

                }, error: function(json){
                    console.log(json);
                    var erro = "";
                    for(i in json.errors){
                        erro = erro + json.errors[i];
                    }
                    
                    alert(erro);
                }, complete: function(json){
                }
            });
            });

            $(document).ready(function() {
                function disableBack() {
                    window.history.forward()
                }
                window.onload = disableBack();
                window.onpageshow = function(e) {
                    if (e.persisted)
                        disableBack();
                }
            });
        </script>

        <?php mysqli_close($conexao); //Fecha conexao com banco de dados?>
    </body>
</html>