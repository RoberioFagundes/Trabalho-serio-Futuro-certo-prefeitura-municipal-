<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Protocolo de Agendamento</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .titulo { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 20px; }
        .conteudo { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="titulo">Protocolo de Agendamento</div>

    <div class="conteudo">
        <p><strong>Nome:</strong> {{ $agendamento->pessoa->nome }}</p>
        <p><strong>Telefone:</strong> {{ $agendamento->pessoa->telefone }}</p>
        <p><strong>Data:</strong> {{ $agendamento->data_hora }}</p>
        <p><strong>Horário:</strong> {{ $agendamento->hora }}</p>
        <p><strong>Protocolo:</strong> #{{ $agendamento->id }}</p>
    </div>
</body>
</html>
