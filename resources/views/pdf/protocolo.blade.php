@php
    $path = storage_path('app/public/logo-1758238578.jpg'); // caminho real da imagem
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $pathRodape = storage_path('app/public/rodape.png');
    $typeRodape = pathinfo($pathRodape, PATHINFO_EXTENSION);
    $dataRodape = file_get_contents($pathRodape);
    $base64Rodape ='data:image/' . $typeRodape . ';base64,' . base64_encode($dataRodape);
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Protocolo de Agendamento</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .titulo {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .conteudo {
            margin: 10px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 350px;
            margin-bottom: 10px;
        }

        .rodape img {
            max-width: 550px;
            margin-bottom: 10px;
            align-items:center;
            margin-top:160px;

        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ $base64 }}" alt="Logo">
        <div class="titulo">Protocolo de Agendamento</div>
    </div>

    <div class="conteudo">
        <h1>Detalhes do Agendamento</h1>

        <p><strong>Número de Protocolo:</strong> {{ $agendamento->id }}</p>
        <p><strong>Data:</strong> {{ $agendamento->data_hora }}</p>
        <p><strong>Horário:</strong> {{ $agendamento->hora }}</p>

        <h2>Dados da Pessoa</h2>
        <p><strong>Nome:</strong> {{ $agendamento->pessoa->nome }}</p>
        <p><strong>Observações:</strong> {{ $agendamento->observacoes }}</p>
        <p><strong>Telefone:</strong> {{ $agendamento->pessoa->telefone }}</p>
    </div>
 <br>
 <br>
 <br>

      <div class="rodape">
        <img src="{{ $base64Rodape }}" alt="Logo" style="align-items: center">
        
    </div>

</body>

</html>
