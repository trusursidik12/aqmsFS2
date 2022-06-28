<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-1">
    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center align-sm-items-start">
                    <div id="location">
                        <div id="aqm_voltage">
                            <?php if (!$is_cems) : ?>
                                <span class="icon" style="display:inline-block;position:relative;top:-5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="11" r="3"></circle>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                    </svg>
                                </span>
                                <h2 class="h4" style="display:inline-block;" data-intro="<?= lang('Global.intro_aqms_location') ?>" style="cursor: pointer;" unselectable="on" onselectstart="return false;" onmousedown="return false;"><?= @$stationname ?></h2>
                            <?php endif ?>
                            <h2 class="h6 text-dark" id="date"></h2>
                        </div>

                    </div>
                    <div>
                        <div id="unit" class="my-1 d-flex flex-column flex-md-row justify-content-between align-md-items-center">
                            <div class="mr-3">
                                <span class="icon" style="display:inline-block;position:relative;top:-5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="12" x2="12" y2="12.01"></line>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(45 12 12)"></path>
                                        <path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(-45 12 12)"></path>
                                    </svg>
                                </span>
                                <h7 style="display:inline-block;"><b><?= lang('Global.Unit') ?></b></h7>
                            </div>
                            <div>
                                <span id="unit-content" style="font-weight:bolder;font-size:18px;">(µg/m3)</span>
                                <button type="button" class="btn btn-sm btn-info" id="btn-unit" data-intro="<?= lang('Global.intro_change_unit') ?>">
                                    <?= lang('Global.Switch') ?>
                                </button>
                            </div>
                        </div>
                        <?php if ($pump_interval > 0) : ?>
                            <div id="pump" class="my-1 d-flex flex-column flex-md-row justify-content-between align-md-items-center">
                                <div class="mr-3">
                                    <span class="icon" style="display:inline-block;position:relative;top:-5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="3" width="6" height="6" rx="1" />
                                            <rect x="15" y="15" width="6" height="6" rx="1" />
                                            <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                                            <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
                                        </svg>
                                    </span>
                                    <h7 style="display:inline-block;"><b><?= lang('Global.Pump') ?></b></h7>
                                </div>
                                <div>
                                    <span id="pumpState" style="font-weight:bolder;font-size:20px;"><i class="fas fa-spinner fa-spin"></i></span>
                                    <span id="pumpTimer" class="small" style="font-weight:bolder;font-size:18px;"><i class="fas fa-spinner fa-spin"></i></span>
                                    <button type="button" id="switch_pump" class="btn btn-sm btn-info" data-intro="<?= lang('Global.intro_change_pump') ?>">

                                        <?= lang('Global.Switch') ?>
                                    </button>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$is_cems) : ?>
            <div class="col-sm mx-2">
                <?php if (count($particulates) > 0) : ?>
                    <h1 class="h4 text-light" data-intro="Partikulat"><?= lang('Global.Particulate') ?></h1>
                    <div id="particulate">
                        <?php foreach ($particulates as $particulate) : ?>
                            <div class="my-1 mx-n2 shadow px-3 py-2 rounded" style="border:5px solid RGBA(28,183,160,0.6);background-image: url(../img/black_metal_texture.png);">
                                <span class="h6 py-0 font-weight-bold text-light"><?= $particulate->caption_id ?></span>
                                <div class="m-0 d-flex justify-content-between">
                                    <div class="d-flex align-items-center text-light">
                                        <h3 class="h1 mr-1 text-light" id="value_<?= $particulate->code ?>">0</h3>
                                        <p><?= $particulate->default_unit ?></p>
                                    </div>
                                    <div class="d-flex align-items-center" style="color:#FFFF00">
                                        <h3 class="h5 mr-1" id="value_<?= $particulate->code ?>_flow" style="color:#FFFF00"></h3>
                                        l/mnt
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif ?>

                <div class="text-center rounded my-1" id="chartdiv">
                </div>
            </div>
        <?php endif ?>
        <div class="col-sm mx-2">
            <?php if (!$is_cems) : ?>
                <h1 class="h4 text-light" data-intro="Gas"><?= lang('Global.Gases') ?></h1>
            <?php endif ?>
            <div id="gas-content">
                <?php foreach ($gases as $gas) : ?>
                    <div class="my-1 mx-n2 shadow px-3 rounded" style="border:5px solid RGBA(124,122,243,0.6);background-image: url(../img/black_metal_texture.png);">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 py-0 font-weight-bold text-light"><?= $gas->caption_id ?></span>
                            <span class="py-0 small font-weight-bold sensor d-none text-light" id="svalue_<?= $gas->code ?>">0</span>
                        </div>
                        <div class="m-0 d-flex justify-content-center">
                            <div class="d-flex align-items-center">
                                <h3 class="h3 mr-1 text-light" id="value_<?= $gas->code ?>">0</h3>
                                &nbsp;&nbsp;<p class="switch-unit" style="color:#FFFF00"><?= $gas->default_unit ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--div class="card mt-1">
                <div class="p-2">
                    <h1 class="h5" data-intro="Tekanan Gas"><?= lang('Global.GasesPressure') ?></h1>
                    <div id="gas-content">
                        <?php foreach ($flow_meters as $f_meter) : ?>
                            <div class="my-1 mx-n4 shadow px-3 rounded" style="background-color:RGBA(124,122,243,0.6);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="py-0 font-weight-bold"><?= $f_meter->caption_id ?></span>
                                    <span class="py-0 small font-weight-bold sensor d-none" id="svalue_<?= $f_meter->code ?>">0</span>
                                </div>
                                <div class="m-0 d-flex justify-content-center ">
                                    <div class="d-flex align-items-center">
                                        <h3 class="h3 mr-1" id="value_<?= $f_meter->code ?>">0</h3>
                                        <small><?= $f_meter->default_unit ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div-->
        </div>
        <?php if (!$is_cems) : ?>
            <div class="col-sm mx-2">
                <h1 class="h4 text-light" data-intro="Cuaca"><?= lang('Global.Meteorology') ?></h1>
                <div id="meteorologi-content">
                    <?php foreach ($weathers as $wheather) : ?>
                        <div class="my-1 mx-n2 shadow px-3 rounded" style="border:5px solid RGBA(99,173,252,0.6);background-image: url(../img/black_metal_texture.png);">
                            <span class="h6 font-weight-bold text-light"><?= $wheather->caption_id ?></span>
                            <div class="m-0 d-flex justify-content-center text-light">
                                <div class="d-flex align-items-center">
                                    <h3 class="h4 mr-1 text-light" id="value_<?= $wheather->code ?>">0</h3>
                                    <?= $wheather->default_unit ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif ?>
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
        min-width: 35vh;
        min-height: 35vh;
    }
</style>
<?= $this->endSection('css') ?>
<?= $this->section('js') ?>
<script src="<?= base_url('amchart/core.js') ?>"></script>
<script src="<?= base_url('amchart/charts.js') ?>"></script>
<script src="<?= base_url('amchart/themes/animated.js') ?>"></script>
<script>
    am4core.ready(function() {

        am4core.useTheme(am4themes_animated);

        chart = am4core.create("chartdiv", am4charts.GaugeChart);
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
        var beginUnit = 1;
        setInterval(() => {
            $.ajax({
                url: '<?= base_url('measurementlog') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        data.logs.map(function(value, index) {
                            try {
                                let param_value = cleanStr(value.value);
                                let molecular_mass = cleanStr(value.molecular_mass);
                                let p_type = value.p_type
                                if (p_type == 'gas') {
                                    switch (beginUnit) {
                                        case 2:
                                            param_value = calculatePpm(param_value, molecular_mass);
                                            break;
                                        case 3:
                                            param_value = calculatePpm(param_value, molecular_mass) * 1000;
                                            break;
                                        case 1:
                                        default:
                                            break;
                                    }
                                }
                                $(`#value_${value.code}`).html(param_value);
                                $(`#svalue_${value.code}`).html(cleanStr(value.sensor_value) + " Volt");
                                // console.log('value_' + value.code + ' = ' + param_value);
                            } catch (err) {
                                console.error(err);
                            }
                            if (value.code == 'wd') {
                                try {
                                    rotateCompass(parseInt(cleanStr(value.value)) * 10 / 9);
                                } catch (er) {
                                    console.error(er);
                                }
                            }

                        });
                        try {
                            let pump_state = data.config.pump_state;
                            let curent = new Date(data.config.now);
                            let pump_last = new Date(data.config.pump_last);
                            let pump_interval = data.config.pump_interval;
                            let pump_state_time = (curent - pump_last) / 1000;
                            let remaining = (pump_interval * 60) - pump_state_time;
                            let h = Math.floor(remaining / 3600);
                            let m = Math.floor((remaining - (h * 3600)) / 60);
                            let s = Math.floor(remaining % 60);
                            let pumpTimer = `${h}:${m}:${s}`;
                            if (pumpTimer == `0:0:0` || parseInt(h) < 0 || parseInt(m) < 0 || parseInt(s) < 0) {
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
        $('#btn-unit').click(function(e) {
            beginUnit++;
            if (beginUnit > 3) {
                beginUnit = 1;
            }
            switch (beginUnit) {
                case 2: //ppm
                    $('#unit-content').html(`(ppm)`);
                    unit = `ppm`;
                    break;
                case 3: //ppb
                    $('#unit-content').html(`(ppb)`);
                    unit = `ppb`;
                    break;
                case 1: //micro
                default:
                    $('#unit-content').html(`(µg/m<sup>3</sup>)`);
                    unit = `µg/m<sup>3</sup>`;
                    break;
            }
            $('.switch-unit').html(unit)

        });

        function calculatePpm(ug, molecular_mass) {

            try {
                ug = parseFloat(ug);
                molecular_mass = parseFloat(molecular_mass);
                let value = (ug * 24.45) / (1000 * molecular_mass);
                return `${value}`.substr(0, 5);
            } catch (err) {
                toastr.error(err);
                return 0;
            }
        }

        // function calculatePpb(ug, molecular_mass) {
        //     try {
        //         ug = parseFloat(ug);
        //         molecular_mass = parseFloat(molecular_mass);
        //         let value = (ug * 24.45) / molecular_mass;
        //         return Math.round(value);
        //     } catch (err) {
        //         toastr.error(err);
        //         return 0;
        //     }

        // }
    });
</script>
<script>
    function cleanStr(str) {
        try {
            if (str === undefined || str === null || str === "") {
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