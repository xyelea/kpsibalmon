<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Servis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Servis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Riwayat Servis
                            <div class="btn-group float-right">
                                <a href="<?php echo base_url('service/import'); ?>" class="btn btn-primary btn-sm">Import</a>
                                <a href="<?php echo base_url('service/export'); ?>" class="btn btn-success btn-sm">Export</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <b class="text-danger">Penting !</b> Baca <a href="<?= base_url('service/manual'); ?>" class="text-success"><b>Instruksi</b></a> Sebelum Import Data !

                            <?php
                            if (!empty(session()->getFlashdata('success'))) { ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty(session()->getFlashdata('info'))) { ?>
                                <div class="alert alert-info">
                                    <?php echo session()->getFlashdata('info'); ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty(session()->getFlashdata('warning'))) { ?>
                                <div class="alert alert-warning">
                                    <?php echo session()->getFlashdata('warning'); ?>
                                </div>
                            <?php } ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <!-- <th>ID</th> -->
                                            <th>Kendaraan</th>
                                            <th>No Plat</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Pengeluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($service as $key => $row) { ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>

                                                <td><?php echo $row['kendaraan_name']; ?></td>
                                                <td><?php echo $row['no_plat']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row['svc_date'])); ?></td>
                                                <td><?php echo $row['svc_desc']; ?></td>
                                                <td><?php echo "Rp. " . number_format($row['svc_price']); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>