<?php

    $api_url = 'https://niloweb.com.br/transit-room/api/reg_endpoint.php';
    $imagem = 'images/libera.jpg';
    $imagemDois = 'images/block.png';
    $imagemTres = 'images/aguarde.jpg';
    

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST'
        ),
    );

    $context  = stream_context_create($options);
    $response = file_get_contents($api_url, false, $context);

    if ($response === FALSE) {
        die('Erro ao acessar a API');
    }

    $data = json_decode($response, true);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joguinho</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php
            foreach ($data as $item) {
                $res = $item['res'];
                $dia = $item['dia'];
            
                if ($res == 'B') {
                    echo "<p>Você está bloqueado(a)</p>";
                    echo "<img src='$imagemDois' alt='Minha Imagem' class='imagemResultado'>";
                } elseif ($res == 'L') {
                    echo "<p>Você está liberado(a)</p>";
                    echo "<img src='$imagem' alt='Minha Imagem' class='imagemResultado'>";
                } elseif ($res == 'A') {
                    echo "<p>Aguarde!!!</p>";
                    echo "<img src='$imagemTres' alt='Minha Imagem' class='imagemResultado'>";
                } else {
                    echo "<p>Resultado desconhecido para o dia $dia\n</p>";
                }
            }
        ?>
    </main>
    <script>
        setInterval(function() {
            location.reload();
        }, 60000); 
    </script>
</body>
</html>
