<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Updated Value</h1>
    </header>
   <main>
   <?php
        //API BACEN
        $inicio = date("m-d-y", strtotime("-7days"));
        $fim = date("m-d-y"); 
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'11-19-2024\'&@dataFinalCotacao=\'11-26-2024\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
        $dados = json_decode(file_get_contents($url), true);
        //var_dump($dados);
        $cotacao = $dados["value"][0]["cotacaoCompra"];
        $value = $_GET ["money"] ?? 0;
        $newvalue = $value * $cotacao;
        $default = numfmt_create("en_US", NumberFormatter::CURRENCY);

        echo "With " . numfmt_format_currency($default, $value, "USD"). ", you'll have <strong>" . numfmt_format_currency($default, $newvalue, "BRL")."</strong>";
    ?>
    <p>Calculated based on data from the <strong>Bank of Brazil</strong></p>
    <button onclick="javascript:history.go(-1)">Back</button>
    </main>
</body>
</html>