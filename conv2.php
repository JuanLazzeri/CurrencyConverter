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
        $real = $_GET ["dinheiro"] ?? 0;
        $dolar = $real * $cotacao;
        $default = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
        echo "Com " . numfmt_format_currency($default, $real, "BRL"). ", você terá <strong>" . numfmt_format_currency($default, $dolar, "USD")."</strong>";
    ?>
    <p>Calculado com base na cotação atual fornecido pelo <strong>Banco Central do Brasil</strong></p>
    <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>
</body>
</html>
