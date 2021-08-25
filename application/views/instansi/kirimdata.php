<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Informasi</h1>

    <div class="row">
        <div class="col-md-4 col-xs-4 col-lg-12">
            <?php if(validation_errors()):?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?=validation_errors()?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?=$pemohon->name?>" readonly>
                    <input type="hidden" name="pengajuan_instansi" value="<?=$pemohon->id?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?=$pemohon->katpem?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Informasi yang dibutuhkan</label>
                    <div class="col-sm-10">
                    <textarea name="" class="form-control" readonly><?=$pemohon->info?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tujuan penggunaan informasi</label>
                    <div class="col-sm-10">
                    <textarea name="" class="form-control" readonly><?=$pemohon->tujuan?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">File yang diminta</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input form-control" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="">Pilih file</label>
                        </div>
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
</div>
<!-- end container fluid -->
</div>