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
                            Manual Servis
                        </div>
                        <div class="card-body">
                            ikuti Format Penulisan Seperti di gambar :
                            <div>
                                <img src="<?= base_url(); ?>/uploads/example.png" alt=""></div>
                        </div>


                        <div class="container">
                            <b> Keterangan :</b> <br>
                            Kolom A = ID Kendaraan (Bisa di lihat di Manajemen Kendaraan) <br>
                            Kolom B = Tanggal Servis <br>
                            Kolom C = Deksripsi <br>
                            Kolom D = Pengeluaran
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>