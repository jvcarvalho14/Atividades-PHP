<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Biblioteca')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Biblioteca</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('dashboard') }}">Painel</a>
            <a class="nav-link" href="{{ route('livros.index') }}">Livros</a>
            <a class="nav-link" href="{{ route('leitores.index') }}">Leitores</a>
            <a class="nav-link" href="{{ route('emprestimos.index') }}">Empréstimos</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Verifique os dados informados:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>