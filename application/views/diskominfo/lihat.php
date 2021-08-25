<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Lihat File PDF</h1>

    <div class="row">
        <div class="col-md-9">
            <object data="<?=base_url('asset/upload/').$file->nama_file?>" type="application/pdf" width="100%" height="450"></object>
        </div>
        <div class="col-md-3">
            <a href="<?=base_url('diskominfo/update_feedback/').$file->id.'/'.$file->nama_file?>" class="text-decoration-none">
                <button class="btn btn-success btn-block" <?=($file->feedback !== null) ? 'disabled':''?>>Kirim ke user</button>
            </a>
            <dl class="row">
                <dd class="col-md-6">Nama file :</dd>
                <dd class="col-md-6"><?=$file->nama_file?></dd>
                <dd class="col-md-6">Ukuran file :</dd>
                <dd class="col-md-6"><?=$file->ukuran_file?> kb</dd>
                <dd class="col-md-6">Type file :</dd>
                <dd class="col-md-6"><?=$file->type_file?></dd>
                <dd class="col-md-6">Tanggal :</dd>
                <dd class="col-md-6"><?=$file->updated_pengajuan_instansi?></dd>
            </dl>
        </div>
    </div>
</div>
</div>