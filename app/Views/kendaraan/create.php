<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Kendaraan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kendaraan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // $inputs = session()->getFlashdata('inputs');
                    $errors = session()->getFlashdata('errors');
                    if (!empty($errors)) { ?>
                        <div class="alert alert-danger" role="alert">
                            Whoops! Ada kesalahan saat input data, yaitu:
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php echo form_open_multipart('kendaraan/store'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Kategori', 'Kategori');
                                        echo form_dropdown('category_id', $categories, old('category_id'), ['class' => 'form-control']);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Name');
                                        $kendaraan_name = [
                                            'type'  => 'text',
                                            'name'  => 'kendaraan_name',
                                            'id'    => 'kendaraan_name',
                                            'value' => old('kendaraan_name'),
                                            'class' => 'form-control',
                                            'placeholder' => 'Model Kendaraan'
                                        ];
                                        echo form_input($kendaraan_name);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Nomor Registrasi');
                                        $no_plat = [
                                            'type'  => 'text',
                                            'name'  => 'no_plat',
                                            'id'    => 'no_plat',
                                            'value' => old('no_plat'),
                                            'class' => 'form-control',
                                            'placeholder' => 'Nomor Plat Kendaraan'
                                        ];
                                        echo form_input($no_plat);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Status', 'Status');
                                        echo form_dropdown('kendaraan_status', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactive'], old('kendaraan_status'), ['class' => 'form-control']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Image');
                                        echo form_upload('kendaraan_image', '', ['class' => 'form-control']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('kendaraan'); ?>" class="btn btn-outline-info">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>