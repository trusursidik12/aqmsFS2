<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 text-light">Configuration</h1>
        <div>
            <a href="#" onclick="return window.history.go(-1);" class="btn btn-sm btn-primary">
                <i class="fas fa-xs fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4">Configuration Instrument</h2>
                        <div class="alert alert-info">
                            <b>PORTS:</b>
                            <p class="m-0">COM1: Lorem ipsum dolor sit.</p>
                            <p class="m-0">COM2: Lorem, ipsum.</p>
                        </div>
                        <?php for ($i = 1; $i <= 16; $i++) : ?>
                            <div class="form-group">
                                <label>Gas ADC Arduino <?= $i ?></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Port</label>
                                        <input type="text" name="port[<?= $i ?>]" placeholder="Port" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Parameter</label>
                                        <input type="text" name="parameter[<?= $i ?>]" placeholder="Parameter" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Baud Rate</label>
                                        <select name="baudrate[<?= $i ?>]" class="form-control">
                                            <option value="">Baud Rate</option>
                                            <option value="110"> 110 </option>
                                            <option value="300"> 300 </option>
                                            <option value="1200"> 1200 </option>
                                            <option value="2400"> 2400 </option>
                                            <option value="4800"> 4800 </option>
                                            <option value="9600"> 9600 </option>
                                            <option value="19200"> 19200 </option>
                                            <option value="38400"> 38400 </option>
                                            <option value="57600"> 57600 </option>
                                            <option value="115200"> 115200 </option>
                                            <option value="230400"> 230400 </option>
                                            <option value="460800"> 460800 </option>
                                            <option value="921600"> 921600 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4">Detail</h2>
                        <div class="form-group">
                            <label>Station Name</label>
                            <input type="text" name="" placeholder="Station Name" id="" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input type="text" name="" placeholder="Serial Number" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Station ID</label>
                                    <input type="text" name="" placeholder="Station ID" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="" placeholder="City" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" name="" placeholder="Province" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Full Address</label>
                            <textarea name="" rows="2" placeholder="Full Address" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="" placeholder="Longitude" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="" placeholder="Latitude" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4">Configuration Dashboard</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interval Pump <small>(minutes)</small></label>
                                    <input type="text" name="" placeholder="Interval Pump" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Collect Data Interval <small>(minutes)</small></label>
                                    <input type="text" name="" placeholder="Collect Data Interval" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Graphic Refresh Interval <small>(minutes)</small></label>
                                    <input type="text" name="" placeholder="Graphic Refresh Interval" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Labjack AIN's</label>
                                    <input type="text" name="" placeholder="Graphic Refresh Interval" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Pump Controll</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pump_controll" id="pump_controll1" value="1">
                                        <label class="form-check-label" for="pump_controll1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pump_controll" id="pump_controll2" value="0">
                                        <label class="form-check-label" for="pump_controll2">Hide</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Sampling Feature</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_sampling" id="is_sampling1" value="1">
                                        <label class="form-check-label" for="is_sampling1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_sampling" id="is_sampling2" value="0">
                                        <label class="form-check-label" for="is_sampling2">Hide</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Labjack Force</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="labjack_force_on" id="labjack_force_on1" value="1">
                                        <label class="form-check-label" for="labjack_force_on1">On</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="labjack_force_on" id="labjack_force_on2" value="0">
                                        <label class="form-check-label" for="labjack_force_on2">Off</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Calibration Menu</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="labjack_force_on" id="calibration_menu1" value="1">
                                        <label class="form-check-label" for="calibration_menu1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calibration_menu" id="calibration_menu2" value="0">
                                        <label class="form-check-label" for="calibration_menu2">Hide</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed" style="z-index: 999;right:11vw;bottom:20px;">
            <button type="submit" name="Save" class="btn btn-info" id="btn-save">Save Changes</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->
<?= $this->endSection() ?>