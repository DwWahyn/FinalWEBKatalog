document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('produkChart')?.getContext('2d');

    if (!ctx || !window.chartLabels || !window.chartData) {
        console.error("Chart data or canvas not found!");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: window.chartLabels,
            datasets: [{
                label: 'Jumlah Produk',
                data: window.chartData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(201, 203, 207, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 0,
                        callback: function (value, index, ticks) {
                            let label = this.getLabelForValue(value);
                            return label.length > 12 ? label.substr(0, 10) + '…' : label;
                        }
                    },
                    title: {
                        display: true,
                        text: 'Kategori Produk',
                        font: { weight: 'bold' }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    title: {
                        display: true,
                        text: 'Jumlah Produk',
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });
});
