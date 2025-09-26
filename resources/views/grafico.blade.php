<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Atendimentos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h2>Pessoas atendidas por dia da semana (Tempo Real)</h2>
<canvas id="graficoAtendimentos" width="800" height="400"></canvas>

<script>
const ctx = document.getElementById('graficoAtendimentos').getContext('2d');
let grafico = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        datasets: [{
            label: 'Pessoas Atendidas',
            data: [0,0,0,0,0,0,0],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true, precision: 0 } }
    }
});

// Função para buscar dados via AJAX
async function atualizarGrafico() {
    const res = await fetch("{{ route('grafico.dados') }}");
    const data = await res.json();
    grafico.data.labels = data.labels;
    grafico.data.datasets[0].data = data.totais;
    grafico.update();
}

// Atualiza a cada 5 segundos
atualizarGrafico();
setInterval(atualizarGrafico, 5000);
</script>
</body>
</html>
