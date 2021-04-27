<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 text-light"><?= lang('Global.Calibration') ?></h1>
        <div>
            <button class="btn btn-sm btn-primary">
                <?= lang('Global.Purge Open') ?>
            </button>
            <button class="btn btn-sm btn-danger">
                <?= lang('Global.Purge Close') ?>
            </button>
        </div>
    </div>
    <div class="row">
        <?php for ($i = 1; $i <= 6; $i++) : ?>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h1 class="h4">SO2</h1>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="mr-3">
                                <a href="<?= base_url('calibration/zero/1') ?>" class="btn btn-sm btn-info">Zero <?= lang('Global.Calibration') ?></a>
                            </span>
                            <span>
                                <a href="<?= base_url('calibration/span/1') ?>" class="btn btn-sm btn-info">Span <?= lang('Global.Calibration') ?></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->
<?= $this->endSection() ?>