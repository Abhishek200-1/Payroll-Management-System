// Ensure the document is ready before running the script
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                label: 'Attendance',
                data: [presentPercentage, absentPercentage],
                backgroundColor: [
                    '#28a745',
                    '#dc3545',
                ],
                borderColor: [
                    '#fff',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            let label = tooltipItem.label || '';
                            if (label) {
                                label += ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                            return label;
                        }
                    }
                },
                legend: {
                    display: true
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        }
    });
});
