@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

            <!-- Contenedor de Gráficas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gráfica 1: Ventas mensuales -->
                <div class="bg-gray-700 p-6 rounded-lg" style="height: 500px;">
                    <h3 class="text-xl font-semibold mb-4">Ventas Mensuales</h3>
                    <canvas id="monthlySalesChart"></canvas>
                </div>

                <!-- Gráfica 2: Productos más vendidos -->
                <div class="bg-gray-700 p-6 rounded-lg" style="height: 500px;">
                    <h3 class="text-xl font-semibold mb-4">Productos Más Vendidos</h3>
                    <canvas id="topProductsChart"></canvas>
                </div>

                <!-- Gráfica 3: Clientes recurrentes -->
                <div class="bg-gray-700 p-6 rounded-lg" style="height: 500px;">
                    <h3 class="text-xl font-semibold mb-4">Clientes Recurrentes</h3>
                    <canvas id="recurrentCustomersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Opciones comunes para las gráficas
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Gráfica de Ventas Mensuales
        var ctx1 = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: [1200, 1900, 3000, 5000, 2400, 3200, 4100, 3700, 4800, 5200, 6100, 7000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: commonOptions
        });

        // Gráfica de Productos Más Vendidos
        var ctx2 = document.getElementById('topProductsChart').getContext('2d');
        var topProductsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D', 'Producto E'],
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: [50, 75, 30, 85, 60],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: commonOptions
        });

        // Gráfica de Clientes Recurrentes
        var ctx3 = document.getElementById('recurrentCustomersChart').getContext('2d');
        var recurrentCustomersChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Cliente A', 'Cliente B', 'Cliente C', 'Cliente D'],
                datasets: [{
                    label: 'Clientes Recurrentes',
                    data: [10, 20, 30, 40],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>
@endsection