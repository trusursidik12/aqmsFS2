<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table stripped">
                            <thead>
                                <tr>
                                    <th>ID STASIUN</th>
                                    <th>WAKTU</th>
                                    <th>NO2</th>
                                    <th>O3</th>
                                    <th>CO</th>
                                    <th>SO2</th>
                                    <th>HC</th>
                                    <th>PM2.5</th>
                                    <th>PM10</th>
                                    <th>TEKANAN</th>
                                    <th>ARAH ANGIN</th>
                                    <th>KEC. ANGIN</th>
                                    <th>TEMP</th>
                                    <th>KELEMBABAN</th>
                                    <th>SR</th>
                                    <th>RAIN INT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($parameters as $param) : ?>
                                    <tr>
                                        <th>AQMS_FS2</th>
                                        <td><?= $param['waktu'] ?></td>
                                        <td><?= $param['no2'] ?></td>
                                        <td><?= $param['o3'] ?></td>
                                        <td><?= $param['co'] ?></td>
                                        <td><?= $param['so2'] ?></td>
                                        <td><?= $param['hc'] ?></td>
                                        <td><?= $param['pm25'] ?></td>
                                        <td><?= $param['pm10'] ?></td>
                                        <td><?= $param['pressure'] ?></td>
                                        <td><?= $param['wd'] ?></td>
                                        <td><?= $param['ws'] ?></td>
                                        <td><?= $param['temperature'] ?></td>
                                        <td><?= $param['humidity'] ?></td>
                                        <td><?= $param['sr'] ?></td>
                                        <td><?= $param['rain_intensity'] ?></td>
                                    </tr>
                                <?php endforeach ?>
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