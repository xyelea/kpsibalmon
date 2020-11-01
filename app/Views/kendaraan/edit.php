<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Kendaraan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Kendaraan</li>
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
                    // $input_category_id = $inputs[‘category_id’] == null ? ” : $inputs[‘category_id’];
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
                    <div class="card">
                        <?php echo form_open_multipart('kendaraan/update'); ?>
                        <div class="card-header">Form Edit Kendaraan</div>
                        <div class="card-body">
                            <!--  -->
                            <?php echo form_hidden('kendaraan_id', $kendaraan['kendaraan_id']);
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo form_label('Image', 'Image'); ?>
                                        <br>
                                        <img src="<?php echo base_url('uploads/' . $kendaraan['kendaraan_image']) ?>" class="img-fluid">
                                        <br>
                                        <br>
                                        <?php echo form_label('Ganti Image', 'Ganti Image'); ?>
                                        <?php echo form_upload('kendaraan_image', $kendaraan['kendaraan_image']); ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo form_label('Category', 'Category'); ?>
                                        <?php echo form_dropdown('category_id', $categories, $kendaraan['category_id'], ['class' => 'form-control']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Name', 'Name'); ?>
                                        <?php echo form_input('kendaraan_name', $kendaraan['kendaraan_name'], ['class' => 'form-control', 'placeholder' => 'Model']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('No Plat kendaraan', 'No Plat Kendaraan'); ?>
                                        <?php echo form_input('no_plat', $kendaraan['no_plat'], ['class' => 'form-control', 'placeholder' => 'No Plat Kendaraan']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo form_label('Status', 'Status'); ?>
                                        <?php echo form_dropdown('kendaraan_status', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactieve'], $kendaraan['kendaraan_status'], ['class' => 'form-control']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('kendaraan'); ?>" class="btn btn-outline-info">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>