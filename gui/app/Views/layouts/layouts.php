<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRUSUR AQMS - <?= $this->renderSection('title') ?></title>
    <?= $this->include('layouts/css') ?>
    <?= $this->renderSection('css') ?>
    <!-- Custom CSS -->
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>
    <!-- End of Navar -->
    <?= $this->renderSection('content') ?>

    <?= $this->include('layouts/js') ?>
    <?= $this->renderSection('js') ?>
    <!-- Custom JS -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'PM10',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    data: [Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50)],
                }, {
                    label: 'PM2.5',
                    strokeColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',

                    data: [Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50)],

                }, {
                    label: 'NO2',
                    pointColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    data: [Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50), Math.random(0, 50)],


                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>