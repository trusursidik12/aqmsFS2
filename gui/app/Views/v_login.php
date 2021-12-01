<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <form action="<?= base_url('login') ?>" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body login-card-body">
                        <form method="POST" action="<?= base_url('login') ?>" id="formLogin">
                            <input type="hidden" name="url_direction" value="<?= @$url_direction; ?>">
                            <input type="hidden" name="login" value="1">
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Ok</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $('#formLogin').submit();
</script>
<?= $this->endSection() ?>