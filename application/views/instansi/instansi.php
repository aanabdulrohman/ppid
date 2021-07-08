<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Informasi</h1>

    <div class="row">
        <div class="col-md-4 col-xs-4 col-lg-12">

            <?= $this->session->flashdata('pesan'); ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori pemohon</th>
                        <th scope="col">Informasi yang dibutuhkan</th>
                        <th scope="col">Tujuan penggunaan informasi</th>
                        <th scope="col">Tujuan Instansi</th>
                        <!-- <th scope="col">Status</th> -->
                        <th scope="col">Aksi</th>
                        <!-- <th scope="col">Nama</th>   -->
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 0;
                    foreach ($pemohon2 as $p) : {
                            $i++;
                        } ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['name']; ?></td>
                            <td><?= $p['katpem']; ?></td>
                            <td><?= $p['info']; ?></td>
                            <td><?= $p['tujuan']; ?></td>
                            <td><?= $p['nama_instansi']; ?></td>
                            <!-- <td>
                                <a href="#"><span class="badge bg-success text-light">Sukses</span></a>
                            </td> -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <!-- <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">Disposisi</a> -->
                                    <a href="<?= base_url(); ?>diskominfo/kirim/<?= $p['id']; ?>">terima</a>
                                    <!-- <button type="button" class="btn btn-danger">Tolak</button> -->
                                </div>
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