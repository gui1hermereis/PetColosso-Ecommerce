<?php
    session_start();

    $cep_destino = $_POST['cep']; //CEP digitado para consulta

    //Produtos do carrinho
    if(!empty($_SESSION["carrinho"])){
       $total = 0;
       foreach ($_SESSION["carrinho"] as $key => $value) {
       $total = $total + ($value["item_quantity"] * $value["product_price"]);
       }
    }
    
    //API dos correios para calcular o valor do frete
    $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
    $url .= "nCdEmpresa=";
    $url .= "&sDsSenha=";
    $url .= "&nCdServico=04510";
    $url .= "&sCepOrigem=12246260";
    $url .= "&sCepDestino=$cep_destino";
    $url .= "&nVlPeso=1";
    $url .= "&nCdFormato=1";
    $url .= "&nVlComprimento=24";
    $url .= "&nVlAltura=3";
    $url .= "&nVlLargura=16";
    $url .= "&nVlDiametro=0";
    $url .= "&sCdMaoProria=n";
    $url .= "&nVlValorDeclarado=$total";
    $url .= "&sCdAvisoRecebimento=n";
    $url .= "&StrRetorno=xml";

    $xml = simplexml_load_file($url);
    $frete =  $xml -> cServico;

    //Retorna os valores calculados pela API
    $valor = $frete -> Valor;
    $prazo = $frete -> PrazoEntrega;

    echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Mês promocional frete gratis em todos os produtos<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prazo de entrega "
    .$prazo." dias úteis</h4><br>";
?>