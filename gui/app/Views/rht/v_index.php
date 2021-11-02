<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">RH (%)</th>
                            <th scope="col">Temp(°C)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Analyzer</td>
                            <td id="rh_analyzer">0</td>
                            <td id="temp_analyzer">0</td>
                        </tr>
                        <tr>
                            <td>Main Sensor</td>
                            <td id="rh_sensor">0</td>
                            <td id="temp_sensor">0</td>
                        </tr>
                        <tr>
                            <td>Pump</td>
                            <td id="rh_pump">0</td>
                            <td id="temp_pump">0</td>
                        </tr>
                        <tr>
                            <td>PSU</td>
                            <td id="rh_psu">0</td>
                            <td id="temp_psu">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <h1 class="h4 text-light">MembraSens</h1>
    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Temp(°C)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Board1 [0]</td>
                            <td id="temp_membrasens_0_0">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [1]</td>
                            <td id="temp_membrasens_0_1">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [2]</td>
                            <td id="temp_membrasens_0_2">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [3]</td>
                            <td id="temp_membrasens_0_3">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [0]</td>
                            <td id="temp_membrasens_1_0">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [1]</td>
                            <td id="temp_membrasens_1_1">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [2]</td>
                            <td id="temp_membrasens_1_2">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [3]</td>
                            <td id="temp_membrasens_1_3">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <div class="row justify-content-start">
        <div class="col-md-6 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3">
                <span class="h5 py-0 font-weight-bold">Pressure</span>
                <div class="m-0 d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <h3 class="h1 mr-1" id="pressure">0</h3>
                        <p>MBar</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3">
                <span class="h5 py-0 font-weight-bold">Vacuum</span>
                <div class="m-0 d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <h3 class="h1 mr-1" id="vacuum">0</h3>
                        <p>MBar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        var begin = 1;
        var beginUnit = 1;
        setInterval(() => {
            $.ajax({
                url: '<?= base_url('rht/sensor_values') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        $("#rh_analyzer").html(data.rh_analyzer);
                        $("#temp_analyzer").html(data.temp_analyzer);
                        $("#rh_sensor").html(data.rh_sensor);
                        $("#temp_sensor").html(data.temp_sensor);
                        $("#rh_pump").html(data.rh_pump);
                        $("#temp_pump").html(data.temp_pump);
                        $("#rh_psu").html(data.rh_psu);
                        $("#temp_psu").html(data.temp_psu);
                        $("#temp_membrasens_0_0").html(data.temp_membrasens_0_0);
                        $("#temp_membrasens_0_1").html(data.temp_membrasens_0_1);
                        $("#temp_membrasens_0_2").html(data.temp_membrasens_0_2);
                        $("#temp_membrasens_0_3").html(data.temp_membrasens_0_3);
                        $("#temp_membrasens_1_0").html(data.temp_membrasens_1_0);
                        $("#temp_membrasens_1_1").html(data.temp_membrasens_1_1);
                        $("#temp_membrasens_1_2").html(data.temp_membrasens_1_2);
                        $("#temp_membrasens_1_3").html(data.temp_membrasens_1_3);
                        $("#vacuum").html(data.vacuum);
                        $("#pressure").html(data.pressure);
                    }

                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }, 1000);
    });
</script>
<?= $this->endSection() ?>