@extends('layout')

@section('title', 'Painel Administrativo')

@section('content')
    <div class="text-center text-light">
        <h1 class="mb-3">⚙️ Painel Administrativo</h1>
        <p class="lead">Seja bem-vindo ao painel de administração.</p>

        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
            <a href="{{ route('admin.pedidos') }}" class="btn btn-outline-info px-4 py-2 shadow-sm">
                📦 Ver Pedidos
            </a>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-success px-4 py-2 shadow-sm">
                🎓 Gerenciar Cursos
            </a>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-warning px-4 py-2 shadow-sm">
                🗂️ Categorias
            </a>
            <a href="{{ route('configuracoes_api.edit', 'cacapay') }}" class="btn btn-outline-primary px-4 py-2 shadow-sm">
                🔗 Configurar Caçapay
            </a>
        </div>
    </div>

    <hr class="my-5">

    <div class="bg-dark p-4 mt-4 rounded shadow">
        <h3 class="text-center text-light mb-4">📈 Pedidos por Mês</h3>
        <canvas id="graficoPedidos" height="100"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch("{{ url('admin/grafico-pedidos') }}")
            .then(response => response.json())
            .then(dados => {
                const labels = dados.map(item => item.mes);
                const valores = dados.map(item => item.total);

                new Chart(document.getElementById('graficoPedidos'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pedidos',
                            data: valores,
                            backgroundColor: 'rgba(0, 123, 255, 0.6)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            });
    </script>
@endsection
