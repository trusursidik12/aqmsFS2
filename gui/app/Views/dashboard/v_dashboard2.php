<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 text-light">Dashboard</h1>
        <div>
            <button class="btn btn-sm btn-success" id="btn-play" type="button" title="Play Slider">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-play" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 4v16l13 -8z"></path>
                </svg>
            </button>
            <button class="btn btn-sm btn-danger" id="btn-pause" type="button" title="Pause Slider">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-pause" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="6" y="5" width="4" height="14" rx="1"></rect>
                    <rect x="14" y="5" width="4" height="14" rx="1"></rect>
                </svg>

            </button>
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
        <div class="col-md-12 mb-3">
            <div class="card bg-light px-3 py-2 mb-md-0 mb-3 overflow-hidden">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center align-sm-items-start">
                    <div id="location">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="11" r="3"></circle>
                                <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                            </svg>
                        </span>
                        <?= lang('Global.Location') ?>
                        <h2 class="h3" data-intro="Lokasi AQMS">DKI Jakarta</h2>
                    </div>
                    <div>
                        <div id="unit" class="my-2 d-flex flex-column flex-md-row justify-content-between align-md-items-center">
                            <div class="mr-5">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="12" x2="12" y2="12.01"></line>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(45 12 12)"></path>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(-45 12 12)"></path>
                                    </svg>
                                </span>
                                <?= lang('Global.Unit') ?>
                            </div>
                            <div>
                                <span>(PPM)</span>
                                <button type="button" class="btn btn-sm btn-info" data-intro="Mengubah satuan parameter">
                                    <?= lang('Global.Switch') ?>
                                </button>
                            </div>
                        </div>
                        <div id="pump" class="my-2 d-flex flex-column flex-md-row justify-content-between align-md-items-center">
                            <div class="mr-5">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="3" y="3" width="6" height="6" rx="1" />
                                        <rect x="15" y="15" width="6" height="6" rx="1" />
                                        <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                                        <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
                                    </svg>
                                </span>
                                <?= lang('Global.Pump') ?>
                            </div>
                            <div>
                                <span>(Pump 1)</span>
                                <span id="pumpTimer" class="small">06:00:00</span>
                                <button type="button" class="btn btn-sm btn-info" data-intro="Mengubah pompa aktif">
                                    <?= lang('Global.Switch') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div id="carouselSlider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card bg-light px-3 py-2">
                                    <h1 class="h4" data-intro="Data Partikulat & Gas"> <?= lang('Global.ParticulatesGases') ?>
                                    </h1>
                                    <div class="row">
                                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                                            <div class="col-md-6 my-2 ">
                                                <div class="bg-info rounded px-3 py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="h6">PM10</h2>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h1 class="h3">10</h1>
                                                            <h2 class="h6">(ug/m3)</h2>
                                                        </div>
                                                        <div>
                                                            <h1 class="h3">3</h1>
                                                            <h2 class="h6">(l/mnt)</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                        <div class="clearfix"></div>
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <div class="col-md-4 my-2">
                                                <div class="bg-info rounded px-3 py-2 overflow-hidden">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="h6">SO2</h2>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="text-right">
                                                            <h1 class="h3"><?= rand(0, 50) ?></h1>
                                                            <h2 class="h6">(ug/m3)</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card bg-light px-3 py-2">
                                    <h1 class="h4" data-intro="Data Meteorology"> <?= lang('Global.Meteorology') ?>
                                    </h1>
                                    <div class="row">
                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <div class="col-md-3 my-2 ">
                                                <div class="bg-success rounded px-3 py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="h6">Temperatur</h2>
                                                        <h2 class="h6">°</h2>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <h1 class="h1"><?= rand(15, 36) ?></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card">
                        <div class="bg-light px-3 py-2">
                            <h1 class="h4"><?= lang('Global.Graphic') ?></h1>
                            <div class="px-3 py-2 bg-light">
                                <canvas id="myChart" width="150" height="130"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
<script>
    /* Carousel Options */
    $('.carousel').carousel({
        interval: 5000,
        /* Slide everfy 5s */
        pause: "hover",
        /* Pause on Hover */
    })
</script>
<script>
    function play() {
        $('.carousel').carousel('cycle');
        $('#btn-play').hide();
        $('#btn-pause').show();
    }

    function pause() {
        $('.carousel').carousel('pause');
        $('#btn-pause').hide();
        $('#btn-play').show();
    }
    $(document).ready(function() {
        $('#btn-play').hide();
        $('#btn-play').click(function() {
            play();
        });
        $('#btn-pause').click(function() {
            pause();
        });
        $('#carouselSlider').hover(function() {
            pause();
        });
        $('#carouselSlider').mouseleave(function() {
            play();
        });
    });
</script>
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
<?= $this->endSection() ?>