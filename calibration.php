<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQM</title>
    <?php include 'inc/css.php'; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include 'inc/navbar.php'; ?>

    <!-- End of Navar -->
    <div class="container-md py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 text-light">Calibration</h1>
            <div>
                <button class="btn btn-sm btn-primary">
                    Purge Open
                </button>
                <button class="btn btn-sm btn-danger">
                    Purge Close
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
                                    <a href="/calibration_gas.php" class="btn btn-sm btn-info">Zero Calibration</a>
                                </span>
                                <span>
                                    <a href="/calibration_gas.php" class="btn btn-sm btn-info">Span Calibration</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <?php include 'inc/js.php'; ?>

</body>

</html>