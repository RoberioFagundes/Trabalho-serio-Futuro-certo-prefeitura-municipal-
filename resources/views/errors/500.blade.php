<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro 500 - Problema no servidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-4 text-danger">Erro 500</h1>
        <p class="lead">Ocorreu um erro no servidor. Nossa equipe já foi notificada.</p>

        @if(config('app.debug'))
            <div class="alert alert-warning mt-4">
                <strong>Debug Info:</strong><br>
                {!! nl2br(e($exception->getMessage())) !!}
                <br><br>
                <small>{{ $exception->getFile() }} : {{ $exception->getLine() }}</small>
            </div>
        @endif

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Voltar para a página inicial</a>
    </div>
</body>
</html>
