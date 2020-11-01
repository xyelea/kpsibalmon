<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detail Kendaraan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Detail Kendaraan</li>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?php echo base_url('uploads/' . $kendaraan['kendaraan_image']) ?>" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <dl class="dl-horizontal">
                                        <dt>Nomor Plat</dt>
                                        <dd><?php echo $kendaraan['no_plat']; ?></dd>
                                        <dt>Tipe Kendaraan</dt>
                                        <dd><?php echo $kendaraan['category_name']; ?></dd>
                                        <dt>Model</dt>
                                        <dd><?php echo $kendaraan['kendaraan_name']; ?></dd>
                                        <dt>Status</dt>
                                        <dd><?php echo $kendaraan['kendaraan_status']; ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('kendaraan'); ?>" class="btn btn-outline-info float-right">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>