<?php 
    //API PAGSEGURO
    $SANDBOX_ENVIRONMENT = true;

    $JS_FILE_URL = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
    if($SANDBOX_ENVIRONMENT){
        $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
        $JS_FILE_URL = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    }

    //Dados da conta do pagseguro
    $PAGSEGURO_EMAIL = 'felipe.gabriel58@gmail.com';
    $PAGSEGURO_TOKEN = '88409F4A90F94A7C8AF7A647C0F78555';
?>