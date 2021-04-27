<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 text-light">Export</h1>
        <div>
            <a href="#" onclick="return window.history.go(-1);" class="btn btn-sm btn-primary">
                <i class="fas fa-xs fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table stripped">
                            <thead>
                                <tr>
                                    <th>Station</th>
                                    <th>Timestamp</th>
                                    <th>PM10</th>
                                    <th>PM2.5</th>
                                    <th>SO2</th>
                                    <th>CO</th>
                                    <th>O3</th>
                                    <th>NO2</th>
                                    <th>HC</th>
                                    <th>VOC</th>
                                    <th>H2S</th>
                                    <th>CS2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i <= 11; $i++) : ?>
                                    <tr>
                                        <td>TRUSUR</td>
                                        <td>2021-02-11 07:30:00</td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                        <td><?= rand(0, 10) ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script>
    $('table').DataTable({
        "pageLength": 4,
        dom: 'Bfrtip',
        buttons: [{
                text: 'Excel',
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-info mb-3',
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    }
                }
            },
            {
                text: 'PDF',
                extend: 'pdf',
                className: 'btn btn-sm btn-danger mb-3',
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    }
                }
            },
        ]
    });
</script>
<?= $this->endSection() ?>