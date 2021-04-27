<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRUSUR AQMS<?= @$__modulename ? ' - ' . $__modulename : null ?></title>
    <?= $this->include('layouts/css') ?>
    <?= $this->renderSection('css') ?>
    <!-- Custom CSS -->
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>
    <!-- End of Navar -->
    <?= $this->renderSection('content') ?>

    <?= $this->include('layouts/js') ?>
    <?= $this->renderSection('js') ?>
</body>

</html>