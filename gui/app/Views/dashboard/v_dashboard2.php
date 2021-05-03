<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-2">
    <div class="row justify-content-start">
        <div class="col-md-12 mb-2">
            <div class="card bg-light px-3 py-0 mb-md-0 mb-3 overflow-hidden">
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
                        <div class="">
                            <h2 class="h3" data-intro="Lokasi AQMS">DKI Jakarta
                                <!-- Date -->
                            </h2>
                            <h2 class="h6 text-dark" id="date"></h2>
                        </div>

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
        <div class="col-sm mx-2">
            <div class="card">
                <div class="p-2">
                    <h1 class="h5">Partikulat</h1>
                    <div class="my-1 mx-n4 shadow px-3 py-2 rounded" style="background-color:RGBA(28,183,160,0.6);">
                        <span class="py-0 font-weight-bold">PM10</span>
                        <div class="m-0 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h3 class="h1 mr-1">10</h3>
                                <small>µg/m<sup>3</sub></small>
                            </div>
                            <div class="d-flex align-items-center">
                                <h3 class="h6 mr-1">2.0</h3>
                                <small>l/mnt</small>
                            </div>
                        </div>
                    </div>
                    <div class="my-1 mx-n4 shadow px-3 py-2 rounded" style="background-color:RGBA(28,183,160,0.6);">
                        <span class="py-0 font-weight-bold">PM2.5</span>
                        <div class="m-0 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h3 class="h1 mr-1">10</h3>
                                <small>µg/m<sup>3</sub></small>
                            </div>
                            <div class="d-flex align-items-center">
                                <h3 class="h6 mr-1">2.0</h3>
                                <small>l/mnt</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4">
                <img src="https://www.nicepng.com/png/full/32-321434_compass-rose-002-by-prettywitchery-on-deviantart-need.png" alt="" width="130vw" class="img img-fluid">
            </div>
        </div>
        <div class="col-sm mx-2">
            <div class="card">
                <div class="p-2">
                    <h1 class="h5">Gas</h1>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <div class="my-1 mx-n4 shadow px-3 rounded" style="background-color:RGBA(124,122,243,0.6);">
                            <span class="py-0 small font-weight-bold">WS-<?= $i ?></span>
                            <div class="m-0 d-flex justify-content-center">
                                <div class="d-flex align-items-center">
                                    <h3 class="h3 mr-1">10</h3>
                                    <small>µg/m<sup>3</sub></small>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="col-sm mx-2">
            <div class="card">
                <div class="p-2">
                    <h1 class="h5">Meteorologi</h1>
                    <?php for ($i = 1; $i <= 7; $i++) : ?>
                        <div class="my-1 mx-n4 shadow px-3 rounded" style="max-height: 8vh;background-color:RGBA(99,173,252,0.6);">
                            <span class="py-0 small font-weight-bold">SO-<?= $i ?></span>
                            <div class="m-0 d-flex justify-content-center">
                                <div class="d-flex mt-n2 align-items-center">
                                    <h3 class="h4 mr-1">10</h3>
                                    <small>µg/m<sup>3</sup></small>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
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