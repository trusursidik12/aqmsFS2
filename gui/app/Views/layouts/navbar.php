<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-md">
        <a class="navbar-brand" href="/">
            <img src="/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            TRUSUR
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/configuration.php">Configuration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/parameter.php">Parameter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/calibration.php">Calibration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/export.php">Export</a>
                </li>
            </ul>
            <div class="d-flex justify-content-end align-items-center my-2 ml-md-0">
                <span class="small text-dark mr-1" id="date">

                </span>
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
            </div>
        </div>
    </div>
</nav>