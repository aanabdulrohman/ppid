<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 text-center">Ajukan Permintaan</h1>


    <div class="row">
        <div class="col-lg-8">

            <?= $this->session->flashdata('pesan'); ?>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>


            <form action="<?= base_url('user'); ?>" method="post">
                <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('id'); ?>">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Kategori Pemohon</label>
                    <div class="col-sm-10"> <select class="form-control" name="katpem" id="katpem">
                            <option selected value="">Select Menuu</option>
                            <?php foreach ($katpem as $k) : ?>
                                <option selected value="<?= $k['id']; ?>"><?= $k['katpem']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Informasi yang dibutuhkan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="info" id="info">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Tujuan Penggunaan Informasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tujuan" id="tujuan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tujuan Instansi</label>
                    <div class="col-sm-10"><select class="form-control" name="tujuan_ins" id="tujuan_ins">
                            <option selected value="">Select Menu</option>
                            <?php foreach ($nama_instansi as $t) : ?>
                                <option selected value="<?= $t['id']; ?>"><?= $t['nama_instansi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button class="btn btn-primary" type="submit">Kirim Data</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->