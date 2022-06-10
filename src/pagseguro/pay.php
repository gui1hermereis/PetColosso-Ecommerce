<?php 
    require_once '../sql/conexao.php'; //chama Conexão
    session_start();

    require_once('../pagseguro/config.php'); //Chama pagina config
    require_once('../pagseguro/utils.php'); //Chama pagina utils

    //Dados do banco de dados
    $id = $_POST['id'];
    $identrega = time();
    $status = "Aguardando pagamento";
    $rastrear = md5(time());
    $idprod = unserialize($_POST['idprod']);
    $prodvalor = unserialize($_POST['prodvalor']);
    $prodquant = unserialize($_POST['prodquant']);
    $total = $_POST['amount'];

    //Dados do cliente
    $sqlcli = "SELECT * FROM clientes where id_cliente = $id";
    $resultcli = $conexao -> query($sqlcli);

    while($row = mysqli_fetch_assoc($resultcli)) {
        $nome = $row['cli_nome'];
        $email = $row['cli_email'];
    };

    $sql1 = "SELECT * FROM produtos";
    $result1 = $conexao -> query($sql1);

    while($row = mysqli_fetch_assoc($result1)) {
        $estoque = $row['prod_estoque'];
    };

    //Adiciona no banco de dados os dados da compra
    $sql_01 = "INSERT INTO entregas (id_entregas, entr_status, entr_codRastr) VALUES ('$identrega','$status', '$rastrear')";
    $result_01 = $conexao -> query($sql_01);

    $sql_02 = "INSERT INTO vendas (vnd_valor, id_cliente, id_entregas) VALUES ('$total', $id, $identrega)";
    $result_02 = $conexao -> query($sql_02);

    $sql = "SELECT id_vendas FROM vendas ORDER BY id_vendas DESC LIMIT 1 ";
    $result = $conexao -> query($sql);

    while($row = mysqli_fetch_assoc($result)) {
        $idvendas = $row['id_vendas'];
    };
    
    $id_test = 0;
    foreach ($idprod as $id_produto) {
        $quantidade_test = 0;

        foreach ($prodquant as $quant_produto) {
            $valor_test = 0;

            foreach ($prodvalor as $valor_produtos) {
                if ($id_test == $quantidade_test) {
                    if ($quantidade_test == $valor_test){ 
                    $sql_03 = "INSERT INTO itens_vendas (id_vendas, id_prod, itv_quant, itv_valor) VALUES ('$idvendas', '$id_produto', '$quant_produto', '$valor_produtos')";
                    $result_03 = $conexao -> query($sql_03);

                    $sql1 = "SELECT * FROM produtos  WHERE id_prod = $id_produto";
                    $result = $conexao -> query($sql1);
                
                    while($row = mysqli_fetch_assoc($result)) {
                        $estoque = $row['prod_estoque'];
                    };

                    $sql_04 = "UPDATE produtos SET prod_estoque = $estoque - $quant_produto WHERE id_prod = $id_produto ";
                    $result_04 = $conexao -> query($sql_04);
                    }
                }
                $valor_test++;
            }
            $quantidade_test++;
        }
        $id_test++;
    }
    
    $creditCardToken = htmlspecialchars($_POST["token"]);
    $senderHash = htmlspecialchars($_POST["senderHash"]);

    $itemAmount = number_format($_POST["amount"], 2, '.', '');
    $shippingCoast = number_format($_POST["shippingCoast"], 2, '.', '');
    $installmentValue = number_format($_POST["installmentValue"], 2, '.', '');
    $installmentsQty = $_POST["installments"];

    //Dados que serão enviados para o site do pagseguro
    $params = array(
        'email'                     => $PAGSEGURO_EMAIL,  
        'token'                     => $PAGSEGURO_TOKEN,
        'creditCardToken'           => $creditCardToken,
        'senderHash'                => $senderHash,
        'receiverEmail'             => $PAGSEGURO_EMAIL,
        'paymentMode'               => 'default', 
        'paymentMethod'             => 'creditCard', 
        'currency'                  => 'BRL',
        // 'extraAmount'               => '1.00',
        'itemId1'                   => $idvendas,
        'itemDescription1'          => 'PHP Test',  
        'itemAmount1'               => $itemAmount,  
        'itemQuantity1'             => 1,
        'reference'                 => 'REF1234',
        'senderName'                => 'Chuck Norris',
        'senderCPF'                 => '54793120652',
        'senderAreaCode'            => 12,
        'senderPhone'               => '999999999',
        'senderEmail'               => "$email",
        'shippingAddressStreet'     => 'Address',
        'shippingAddressNumber'     => '1234',
        'shippingAddressDistrict'   => 'Bairro',
        'shippingAddressPostalCode' => '58075000',
        'shippingAddressCity'       => 'João Pessoa',
        'shippingAddressState'      => 'PB',
        'shippingAddressCountry'    => 'BRA',
        'shippingType'              => 1,
        'shippingCost'              => $shippingCoast,
        'maxInstallmentNoInterest'      => 2,
        'noInterestInstallmentQuantity' => 2,
        'installmentQuantity'       => $installmentsQty,
        'installmentValue'          => $installmentValue,
        'creditCardHolderName'      => 'Chuck Norris',
        'creditCardHolderCPF'       => '54793120652',
        'creditCardHolderBirthDate' => '01/01/1990',
        'creditCardHolderAreaCode'  => 12,
        'creditCardHolderPhone'     => '999999999',
        'billingAddressStreet'     => 'Address',
        'billingAddressNumber'     => '1234',
        'billingAddressDistrict'   => 'Bairro',
        'billingAddressPostalCode' => '58075000',
        'billingAddressCity'       => 'João Pessoa',
        'billingAddressState'      => 'PB',
        'billingAddressCountry'    => 'BRA'
    );

    $header = array('Content-Type' => 'application/json; charset=UTF-8;');
    $response = curlExec($PAGSEGURO_API_URL."/transactions", $params, $header);
    $json = json_decode(json_encode(simplexml_load_string($response)));

    header ("location: ../paginas/agradecimento.php");//Redireciona para pagina de agradecimento

    unset( $_SESSION['carrinho'] );//Destroi o carrinho
?>
