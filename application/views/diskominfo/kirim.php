<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kirim Pengajuan Informasi</h1>
        <div class="row">
            <div class="col-md-4 col-xs-4 col-lg-12">
                <form method="post" action="">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="" value="<?= $kirim->name ?>" readonly>
                        <input type="hidden" name="id_pengajuan" value="<?=$kirim->id?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Kategori Pemohon</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="" value="<?= $kirim->katpem ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Tujuan Instansi</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="" value="<?= $kirim->nama_instansi ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Informasi yang dibutuhkan</label>
                        <div class="col-sm-10">
                        <textarea  id="" class="form-control" readonly><?= $kirim->info ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Tujuan penggunaan informasi</label>
                        <div class="col-sm-10">
                        <textarea  id="" class="form-control" readonly><?= $kirim->tujuan ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="container">
            <div class="col">
                <div class="row">
                    <form action="<?= base_url('diskominfo/update'); ?>" method="post">
                        <?php foreach ($kirimm as $k) : ?>
                            <input type="hidden" name="id" value="<?= $k->id ?>">
                            <input type="text" name="user_id" value="<?= $k->user_id ?>">
                            <input type="text" name="katpem" value="<?= $k->katpem ?>">
                            <input type="text" name="info" value="<?= $k->info ?>">
                            <input type="text" name="tujuan" value="<?= $k->tujuan ?>">
                            <input type="text" name="tujuan_ins" value="<?= $k->tujuan_ins ?>">
                            <button type="submit" class="btn btn-primary">Disposisi</button>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!--  -->