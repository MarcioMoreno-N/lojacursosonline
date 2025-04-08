<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Loja de Cursos Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('produtos.index') }}">LojaCursosOnline</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('produtos.index') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('clientes.create') }}" class="nav-link">Cadastrar Cliente</a></li>

                @if(session('cliente_id'))
                    <li class="nav-item"><a href="{{ route('pedidos.index') }}" class="nav-link">🧾 Meus Pedidos</a></li>

                    @if(session('cliente_admin') == 1)
    <li class="nav-item">
        <a href="{{ route('admin.painel') }}" class="nav-link">⚙️ Painel Administrativo</a>
    </li>
@endif


                    <li class="nav-item">
                        <span class="nav-link">Bem-vindo, {{ session('cliente_nome') }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('cliente.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light mt-1 ms-2">Sair</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('cliente.login') }}" class="nav-link">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    @yield('content')
</main>

<footer class="text-center py-3 bg-white mt-5 border-top">
    <p class="mb-0">© {{ date('Y') }} Loja de Cursos Online</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- DEBUG: Mostrar sessão --}}
<div class="container mt-4">
    <pre class="bg-light p-3 border rounded">
        {{ print_r(session()->all(), true) }}
    </pre>
</div>

</body>
</html>
