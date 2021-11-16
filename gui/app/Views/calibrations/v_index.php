<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <form action="<?= base_url('calibrations') ?>" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4"><?= lang('Global.zero_calibrations') ?></h2>
                        <div class="form-group">
                            <label><?= lang('Global.calibrator_name') ?></label>
                            <input type="text" name="calibrator_name" placeholder="<?= lang('Global.calibrator_name') ?>" value="<?= $__this->findConfig('calibrator_name') ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?= lang('Global.zerocal_duration') ?> <small>(<?= lang('Global.Seconds') ?>)</small></label>
                            <input type="text" name="zerocal_duration" placeholder="<?= lang('Global.zerocal_duration') ?>" value="<?= $__this->findConfig('zerocal_duration') ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Started At</td>
                            <td id="zerocal_started_at"></td>
                        </tr>
                        <tr>
                            <td>Finish At</td>
                            <td id="zerocal_finished_at"></td>
                        </tr>
                        <tr>
                            <td>Remaining</td>
                            <td id="calibration Remaining"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Concentration (ppm)</th>
                            <th scope="col">Voltage</th>
                            <th scope="col">Temp (°C)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Board1 [0]</td>
                            <td id="con_membrasens_0_0">0</td>
                            <td id="volt_membrasens_0_0">0</td>
                            <td id="temp_membrasens_0_0">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [1]</td>
                            <td id="con_membrasens_0_1">0</td>
                            <td id="volt_membrasens_0_1">0</td>
                            <td id="temp_membrasens_0_1">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [2]</td>
                            <td id="con_membrasens_0_2">0</td>
                            <td id="volt_membrasens_0_2">0</td>
                            <td id="temp_membrasens_0_2">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [3]</td>
                            <td id="con_membrasens_0_3">0</td>
                            <td id="volt_membrasens_0_3">0</td>
                            <td id="temp_membrasens_0_3">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [0]</td>
                            <td id="con_membrasens_1_0">0</td>
                            <td id="volt_membrasens_1_0">0</td>
                            <td id="temp_membrasens_1_0">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [1]</td>
                            <td id="con_membrasens_1_1">0</td>
                            <td id="volt_membrasens_1_1">0</td>
                            <td id="temp_membrasens_1_1">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [2]</td>
                            <td id="con_membrasens_1_2">0</td>
                            <td id="volt_membrasens_1_2">0</td>
                            <td id="temp_membrasens_1_2">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [3]</td>
                            <td id="con_membrasens_1_3">0</td>
                            <td id="volt_membrasens_1_3">0</td>
                            <td id="temp_membrasens_1_3">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->

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
                        $("#con_membrasens_0_0").html(data.con_membrasens_0_0);
                        $("#con_membrasens_0_1").html(data.con_membrasens_0_1);
                        $("#con_membrasens_0_2").html(data.con_membrasens_0_2);
                        $("#con_membrasens_0_3").html(data.con_membrasens_0_3);
                        $("#volt_membrasens_0_0").html(data.volt_membrasens_0_0);
                        $("#volt_membrasens_0_1").html(data.volt_membrasens_0_1);
                        $("#volt_membrasens_0_2").html(data.volt_membrasens_0_2);
                        $("#volt_membrasens_0_3").html(data.volt_membrasens_0_3);
                        $("#temp_membrasens_0_0").html(data.temp_membrasens_0_0);
                        $("#temp_membrasens_0_1").html(data.temp_membrasens_0_1);
                        $("#temp_membrasens_0_2").html(data.temp_membrasens_0_2);
                        $("#temp_membrasens_0_3").html(data.temp_membrasens_0_3);
                        $("#con_membrasens_1_0").html(data.con_membrasens_1_0);
                        $("#con_membrasens_1_1").html(data.con_membrasens_1_1);
                        $("#con_membrasens_1_2").html(data.con_membrasens_1_2);
                        $("#con_membrasens_1_3").html(data.con_membrasens_1_3);
                        $("#volt_membrasens_1_0").html(data.volt_membrasens_1_0);
                        $("#volt_membrasens_1_1").html(data.volt_membrasens_1_1);
                        $("#volt_membrasens_1_2").html(data.volt_membrasens_1_2);
                        $("#volt_membrasens_1_3").html(data.volt_membrasens_1_3);
                        $("#temp_membrasens_1_0").html(data.temp_membrasens_1_0);
                        $("#temp_membrasens_1_1").html(data.temp_membrasens_1_1);
                        $("#temp_membrasens_1_2").html(data.temp_membrasens_1_2);
                        $("#temp_membrasens_1_3").html(data.temp_membrasens_1_3);
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