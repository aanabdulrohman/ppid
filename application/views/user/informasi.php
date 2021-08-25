<!-- Begin Page Content -->
<div class="container-fluid"> 
<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Informasi Anda</h1>

    <div class="row justify-content-center">
        <?php if($informasi->status == 'dikirim') :?>
            <div class="col-md-9">
                <object data="<?=base_url('asset/upload/').$informasi->nama_file?>" type="application/pdf" width="100%" height="450"></object>
            </div>
            <div class="col-md-3">
                <a href="<?=base_url('user/download/').$informasi->nama_file?>" class="text-decoration-none">
                    <button class="btn btn-success btn-block">Download</button>
                </a>
                <dl class="row">
                    <dd class="col-md-6">Nama file :</dd>
                    <dd class="col-md-6"><?=$informasi->nama_file?></dd>
                    <dd class="col-md-6">Ukuran file :</dd>
                    <dd class="col-md-6"><?=$informasi->ukuran_file?> kb</dd>
                    <dd class="col-md-6">Type file :</dd>
                    <dd class="col-md-6"><?=$informasi->type_file?></dd>
                    <dd class="col-md-6">Tanggal :</dd>
                    <dd class="col-md-6"><?=$informasi->updated_pengajuan_instansi?></dd>
                </dl>
            </div>
        <?php elseif($informasi->status == 'ditolak') :?>
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-danger">
                        <p class="card-text"><?=$informasi->nama_file?></p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->