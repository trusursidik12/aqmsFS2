<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-2">
    <div class="row justify-content-start">
        <div class="col-md-12 my-3">
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
                        <div id="aqm_voltage">
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
                                <span id="pumpState"><i class="fas fa-spinner fa-spin"></i></span>
                                <span id="pumpTimer" class="small"><i class="fas fa-spinner fa-spin"></i></span>
                                <button type="button" id="switch_pump" class="btn btn-sm btn-info" data-intro="Mengubah pompa aktif">

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
                    <div id="particulate">
                        <?php foreach ($particulates as $particulate) : ?>
                            <div class="my-1 mx-n4 shadow px-3 py-2 rounded" style="background-color:RGBA(28,183,160,0.6);">
                                <span class="py-0 font-weight-bold"><?= $particulate->caption_id ?></span>
                                <div class="m-0 d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h3 class="h1 mr-1" id="value_<?= $particulate->code ?>">0</h3>
                                        <small><?= $particulate->default_unit ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h3 class="h6 mr-1" id="value_<?= $particulate->code ?>_flow"></h3>
                                        <small>l/mnt</small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            <div class="text-center rounded my-1" id="chartdiv">
            </div>
        </div>
        <div class="col-sm mx-2">
            <div class="card">
                <div class="p-2">
                    <h1 class="h5">Gas</h1>
                    <div id="gas-content">
                        <?php foreach ($gases as $gas) : ?>
                            <div class="my-1 mx-n4 shadow px-3 rounded" style="background-color:RGBA(124,122,243,0.6);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="py-0 small font-weight-bold"><?= $gas->caption_id ?></span>
                                    <span class="py-0 small font-weight-bold sensor d-none" id="svalue_<?= $gas->code ?>">0</span>
                                </div>
                                <div class="m-0 d-flex justify-content-center ">
                                    <div class="d-flex align-items-center">
                                        <h3 class="h3 mr-1" id="value_<?= $gas->code ?>">0</h3>
                                        <small><?= $gas->default_unit ?></small>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm mx-2">
            <div class="card">
                <div class="p-2">
                    <h1 class="h5">Meteorologi</h1>
                    <div id="meteorologi-content">
                        <?php foreach ($weathers as $wheather) : ?>
                            <div class="my-1 mx-n4 shadow px-3 rounded" style="max-height: 8vh;background-color:RGBA(99,173,252,0.6);">
                                <span class="py-0 small font-weight-bold"><?= $wheather->caption_id ?></span>
                                <div class="m-0 d-flex justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <h3 class="h3 mr-1" id="value_<?= $wheather->code ?>">0</h3>
                                        <small><?= $wheather->default_unit ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">


    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<style>
    #chartdiv {
        /* width: 100%; */
        min-width: 20vh;
        min-height: 20vh;
    }
</style>
<?= $this->endSection('css') ?>
<?= $this->section('js') ?>
<script src="<?= base_url('amchart/core.js') ?>"></script>
<script src="<?= base_url('amchart/charts.js') ?>"></script>
<script src="<?= base_url('amchart/themes/animated.js') ?>"></script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // create chart
        chart = am4core.create("chartdiv", am4charts.GaugeChart);
        chart.exporting.menu = new am4core.ExportMenu();
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.startAngle = -90;
        chart.endAngle = 270;

        axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.radiusValue = 360;
        axis.min = 0;
        axis.max = 360;


        axis.renderer.line.strokeWidth = 3;
        axis.renderer.line.strokeOpacity = 1;
        axis.renderer.line.stroke = am4core.color("#ffff");
        axis.renderer.inside = true;

        axis.renderer.axisFills.template.disabled = true;
        axis.renderer.grid.template.disabled = true;
        axis.renderer.ticks.template.disabled = false
        axis.renderer.ticks.template.length = 3;
        axis.renderer.ticks.template.strokeOpacity = 1;

        axis.renderer.labels.template.radius = -15;
        axis.renderer.labels.template.disabled = true;
        axis.renderer.ticks.template.disabled = true;

        function createLabel(label, deg) {
            var range = axis.axisRanges.create();
            range.value = deg;
            range.grid.disabled = true;
            range.label.text = label;
            range.label.fill = am4core.color("#fff");

        }

        createLabel("N", 0, '#ffff');
        createLabel("E", 100);
        createLabel("S", 200);
        createLabel("W", 300);

        // hands
        northHand = chart.hands.push(new am4charts.ClockHand());

        northHand.radius = am4core.percent(80);
        northHand.startWidth = 10;
        northHand.endWidth = 1;
        northHand.rotationDirection = "clockWise";
        northHand.pin.disabled = true;
        northHand.zIndex = 0;
        northHand.fill = am4core.color("#c00");
        northHand.stroke = am4core.color("#c00");
        northHand.value = 0;

        southHand = chart.hands.push(new am4charts.ClockHand());

        southHand.radius = am4core.percent(80);
        southHand.startWidth = 10;
        southHand.endWidth = 1;
        southHand.rotationDirection = "clockWise";
        southHand.pin.disabled = true;
        southHand.zIndex = 0;
        southHand.fill = am4core.color("#ffff");
        southHand.stroke = am4core.color("#ffff");
        southHand.value = 200;


    }); // end am4core.ready()
</script>


<script>
    var northHand, chart, axis;

    function rotateCompass(value) {
        axis.min = 0;
        axis.max = 360;
        northHand.value = value;
        northHand.animate({
            property: "value",
            to: value
        }, 1000, am4core.ease.cubicOut);
        southHand.value = 200 + value;
        southHand.animate({
            property: "value",
            to: 200 + value
        }, 1000, am4core.ease.cubicOut);
    }
    $(document).ready(function() {
        var begin = 1;
        setInterval(() => {
            $.ajax({
                url: '<?= base_url('measurementlog') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        data?.logs.map(function(value, index) {
                            try {
                                $(`#value_${value.code}`).html(cleanStr(value?.value));
                                $(`#svalue_${value.code}`).html(cleanStr(value?.sensor_value));
                            } catch (err) {
                                console.error(err);
                            }
                            if (value?.code == 'wd') {
                                try {
                                    rotateCompass(parseInt(cleanStr(value?.value)) * 10 / 9);
                                } catch (er) {
                                    console.error(er);
                                }
                            }

                        });
                        try {
                            let pump_state = data?.config?.pump_state;
                            let curent = new Date(data?.config?.now);
                            let pump_last = new Date(data?.config?.pump_last);
                            let pump_interval = data?.config?.pump_interval;
                            let pump_state_time = (curent - pump_last) / 1000;
                            let remaining = (pump_interval * 60) - pump_state_time;
                            let h = Math.floor(remaining / 3600);
                            let m = Math.floor((remaining - (h * 3600)) / 60);
                            let s = Math.floor(remaining % 60);
                            let pumpTimer = `${h}:${m}:${s}`;
                            if (pumpTimer == `0:0:0` || (parseInt(h) <= 0 && parseInt(m) <= 0 && parseInt(s) <= 0)) {
                                $('#switch_pump').click();
                            }
                            $('#pumpTimer').html(pumpTimer);
                            $('#pumpState').html(`(Pump ${Math.floor(parseInt(pump_state)+1)})`)
                        } catch (err) {
                            console.log(err)
                        }
                    }

                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }, 1000);
    });
</script>
<script>
    function cleanStr(str) {
        try {
            if (str === undefined || str === null) {
                return `0`;
            }
        } catch (err) {
            return `0`;
        }
        return str;
    }
</script>
<script>
    var x = 1;
    var show = true;
    $('#aqm_voltage').click(function() {
        x++;
        if (x > 3) {
            if (show) {
                $('.sensor').removeClass('d-none');
            } else {
                $('.sensor').addClass('d-none');
            }
            show = !show;
            x = 1;
        }
    })
</script>
<script>
    $("#switch_pump").click(function() {
        $.ajax({
            type: 'POST',
            url: '/switch/pump',
        })
    })
</script>
<?= $this->endSection() ?>