<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Loja de Cursos Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ✅ Chart.js CDN adicionado -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    

    <style>
        body {
            background-color: #1e1e2f;
            color: #f0f0f0;
        }

        .navbar {
            background-color: #121a2e;
        }

        .navbar .nav-link {
            color: #f0f0f0;
        }

        .navbar .nav-link:hover {
            color: #00b4d8;
        }

        .btn-primary {
            background-color: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0096c7;
        }

        .btn-outline-secondary {
            border-color: #ccc;
            color: #ccc;
        }

        .btn-outline-secondary:hover {
            background-color: #495057;
            color: #fff;
        }

        .table {
            background-color: #2c2c3e;
            color: #fff;
        }

        .table thead {
            background-color: #343a40;
        }

        footer {
            background-color: #121a2e;
            color: #ccc;
        }

        .alert-success {
            background-color: #2e7d32;
            color: #e8f5e9;
        }

        .form-control, .form-select {
            background-color: #2c2c3e;
            border: 1px solid #555;
            color: #f0f0f0;
        }

        .form-control::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('produtos.index') }}">LojaCursosOnline</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('produtos.index') }}" class="nav-link">🏠 Home</a></li>
                <li class="nav-item"><a href="{{ route('clientes.create') }}" class="nav-link">👤 Cadastrar</a></li>

                @if(session('cliente_id'))
                    <li class="nav-item"><a href="{{ route('pedidos.index') }}" class="nav-link">🧾 Meus Pedidos</a></li>
                    <li class="nav-item"><a href="{{ route('enderecos.index') }}" class="nav-link">🏠 Meus Endereços</a></li>

                    @if(session('cliente_admin') == 1)
                        <li class="nav-item">
                            <a href="{{ route('admin.painel') }}" class="nav-link">⚙️ Painel Administrativo</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <span class="nav-link">👋 Olá, {{ session('cliente_nome') }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('cliente.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light mt-1 ms-2">Sair</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('cliente.login') }}" class="nav-link">🔐 Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    @yield('content')
</main>

<footer class="text-center py-3 mt-5 border-top">
    <p class="mb-0">© {{ date('Y') }} Loja de Cursos Online</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>
</html>
