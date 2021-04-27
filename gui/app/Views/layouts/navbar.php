<nav class="sticky-top shadow-lg navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-md">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('/img/logo.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="Logo TRUSUR">
            TRUSUR
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= @strtolower($__routename) == 'dashboard' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url() ?>">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= @strtolower($__routename) == 'configuration' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('configurations') ?>"><?= lang('Global.Configuration') ?></a>
                </li>
                <li class="nav-item <?= @strtolower($__routename) == 'parameter' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('parameters') ?>">Parameter</a>
                </li>
                <li class="nav-item <?= @strtolower($__routename) == 'calibration' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('calibrations') ?>"><?= lang('Global.Calibration') ?></a>
                </li>
                <li class="nav-item <?= @strtolower($__routename) == 'export' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('exports') ?>"><?= lang('Global.Export') ?></a>
                </li>
            </ul>
            <div class="d-flex justify-content-end align-items-center my-2 ml-md-0">
                <span class="small text-dark mr-1" id="date"></span> <!-- Date -->
                <div id="connect">
                    <span class="badge badge-sm badge-danger" title="Internet Not Connected">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wifi-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                            <path d="M9.172 15.172a4 4 0 0 1 5.656 0"></path>
                            <path d="M6.343 12.343a7.963 7.963 0 0 1 3.864 -2.14m4.163 .155a7.965 7.965 0 0 1 3.287 2"></path>
                            <path d="M3.515 9.515a12 12 0 0 1 3.544 -2.455m3.101 -.92a12 12 0 0 1 10.325 3.374"></path>
                            <line x1="3" y1="3" x2="21" y2="21"></line>
                        </svg>
                    </span>
                </div>
                <div class="ml-1">
                    <?php if (@session()->get('web_lang') == 'en') : ?>
                        <a href="<?= base_url('lang/id') ?>" class="btn btn-sm btn-primary" title="Translate to Indonesia">
                            <img src="<?= base_url('/img/us.svg') ?>" height="20vh" width="20vw">
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url('lang/en') ?>" class="btn btn-sm btn-primary" title="Terjemahkan ke Bahasa Inggris">
                            <img src="<?= base_url('/img/id.svg') ?>" height="20vh" width="20vw">
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</nav>