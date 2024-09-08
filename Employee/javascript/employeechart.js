const totalPresentDays =    totalPresentDays; 
        const totalAbsentDays =  totalAbsentDays;

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent'],
                datasets: [{
                    label: 'Attendance',
                    data: [totalPresentDays, totalAbsentDays],
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
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });