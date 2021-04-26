<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQM</title>
    <?php include 'inc/css.php'; ?>
</head>

<body>
    <!-- Navbar -->
    <?php include 'inc/navbar.php'; ?>

    <!-- End of Navar -->
    <div class="container-md py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 text-light">Dashboard</h1>
            <div>
                <a href="#" onclick="return location.reload();" class="btn btn-sm btn-primary" title="Refresh">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-light px-3 py-2 mb-md-0 mb-3 overflow-hidden">
                    <h1 class="h4">Detail AQMS</h1>
                    <table class="table ">
                        <tr>
                            <th>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="11" r="3"></circle>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                    </svg>
                                </span>Location
                            </th>
                            <td>DKI Jakarta</td>
                        </tr>
                        <tr>
                            <th>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="12" x2="12" y2="12.01"></line>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(45 12 12)"></path>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(-45 12 12)"></path>
                                    </svg>
                                </span>
                                Unit
                            </th>
                            <td>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>(PPM)</span>
                                    <button type="button" class="btn btn-sm btn-info">
                                        Switch
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="3" y="3" width="6" height="6" rx="1" />
                                        <rect x="15" y="15" width="6" height="6" rx="1" />
                                        <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                                        <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
                                    </svg>

                                </span>Pump
                            </th>
                            <td>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>(Pump 1)</span>
                                    <button type="button" class="btn btn-sm btn-info">
                                        Switch
                                    </button>
                                </div>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card bg-light px-3 py-2">
                    <h1 class="h4">Partikulat & Gas</h1>
                    <div class="row">
                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                            <div class="col-md-6 my-2 ">
                                <div class="bg-info rounded px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="h6">PM10</h2>
                                        <h2 class="h6">(ug/m3)</h2>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <h1 class="h1">10</h1>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                        <div class="clearfix"></div>
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <div class="col-md-3 my-2">
                                <div class="bg-info rounded px-3 py-2 overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="h6">SO2</h2>
                                        <h2 class="h6">(ug/m3)</h2>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <h1 class="h1">10</h1>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="bg-light px-3 py-2">
                        <h1 class="h4">Graphic</h1>
                        <div class="px-3 py-2 bg-light">
                            <canvas id="myChart" width="400" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'inc/js.php'; ?>
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