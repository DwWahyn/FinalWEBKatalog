document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('produkChart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
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
                        title: {
                            display: true,
                            text: 'Kategori Produk',
                            font: { weight: 'bold' }
                        },
                        ticks: {
                            callback: function (value) {
                                const label = this.getLabelForValue(value);
                                return label.length > 12 ? label.substr(0, 10) + '…' : label;
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Produk',
                            font: { weight: 'bold' }
                        },
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    } else {
        console.warn("Canvas dengan ID 'produkChart' tidak ditemukan.");
    }
});
