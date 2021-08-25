<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Informasi</h1>

    <div class="row">
        <div class="col-md-4 col-xs-4 col-lg-12">

            <?php if($this->session->flashdata('pesan')): ?>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori pemohon</th>
                        <th scope="col">Informasi yang dibutuhkan</th>
                        <th scope="col">Tujuan penggunaan informasi</th>
                        <th scope="col">Tujuan Instansi</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="2">Aksi</th>
                        <!-- <th scope="col">Nama</th>   -->
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 0;
                    foreach ($pemohon as $p) : {
                            $i++;
                        } ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['name']; ?></td>
                            <td><?= $p['katpem']; ?></td>
                            <td><?= $p['info']; ?></td>
                            <td><?= $p['tujuan']; ?></td>
                            <td><?= $p['nama_instansi']; ?></td>
                            <td>
                                <?php if($p['status'] == 'menunggu') :?>
                                    <span class="badge bg-warning text-light"><?=$p['status']?></span>
                                <?php elseif($p['status'] == 'ditolak') : ?>
                                    <span class="badge bg-danger text-light"><?=$p['status']?></span>
                                <?php else :?>
                                    <span class="badge bg-primary text-light"><?=$p['status']?></span>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">Disposisi</a>
                                    <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>">coba</a>
                                    <button type="button" class="btn btn-danger">Tolak</button>
                                </div> -->
                                <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>">
                                    <button class="btn btn-success" <?= (($p['status'] == 'ditolak') OR ($p['status'] == 'diproses')) ? 'disabled':''?>>Terima</button>
                                </a>
                                <a href="<?= base_url(); ?>diskominfo/tolak/<?= $p['id']; ?>">
                                    <button class="btn btn-danger" <?= (($p['status'] == 'ditolak') OR ($p['status'] == 'diproses')) ? 'disabled':''?>>Tolak</button>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php foreach ($kirimm as $k) : ?>
                <form action="<?= base_url('diskominfo'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $k['id']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $k['user_id']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="katpem" name="katpem" value="<?= $k['katpem']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= $k['info']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tujuan_ins" name="tujuan_ins" value="<?= $k['tujuan']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tujuan_ins" name="tujuan_ins" type="disable" value="<?= $k['tujuan_ins'] ?>" readonly>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
        </div>
    </div>
</div>