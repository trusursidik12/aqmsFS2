<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <form action="<?= base_url('calibrations') ?>" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4"><?= lang('Global.Calibration') ?></h2>
                        <div class="form-group">
                            <label><?= lang('Global.Station Name') ?></label>
                            <input type="text" name="nama_stasiun" placeholder="<?= lang('Global.Station Name') ?>" value="" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Station ID</label>
                                    <input type="text" name="id_stasiun" placeholder="Station ID" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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