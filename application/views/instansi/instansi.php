<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Informasi</h1>

    <div class="row">
        <div class="col-md-4 col-xs-4 col-lg-12">

            <?php if($this->session->flashdata('pesan')):?>
                <div class="alert alert-<?=$this->session->flashdata('type')?> alert-dismissible fade show" role="alert">
                    <?=$this->session->flashdata('pesan')?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kategori pemohon</th>
                        <th scope="col">Informasi yang dibutuhkan</th>
                        <th scope="col">Tujuan penggunaan informasi</th>
                        <!-- <th scope="col">Status</th> -->
                        <th scope="col">Aksi</th>
                        <!-- <th scope="col">Nama</th>   -->
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pemohon2)):?>
                        <?php $i = 0;
                        foreach ($pemohon2 as $p) : {
                                $i++;
                            } ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['katpem']; ?></td>
                                <td><?= $p['info']; ?></td>
                                <td><?= $p['tujuan']; ?></td>
                                <!-- <td>
                                    <a href="#"><span class="badge bg-success text-light">Sukses</span></a>
                                </td> -->
                                <td>
                                    <!-- <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">Disposisi</a>
                                        <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>">terima</a>
                                        <button type="button" class="btn btn-danger">Tolak</button>
                                    </div> -->
                                    <a href="<?=base_url('instansi/kirimdata/').$p['id']?>"><button class="btn btn-success">Terima</button></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else :?>
                        <tr>
                            <td colspan="5"><p class="text-center">Tidak ada daftar pengajuan informasi</p></td>
                        </tr>
                    <?php endif?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>