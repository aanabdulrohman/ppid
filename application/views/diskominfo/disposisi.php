<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Disposisi</h1>

    <div class="row">
        <div class="col">
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
                        <th scope="col">Kategori Permohonan</th>
                        <th scope="col">Informasi yang dibutuhkan</th>
                        <th scope="col">Tujuan penggunaan informasi</th>
                        <th scope="col">Tujuan Instasi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Button</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($instansi as $its) :?>
                    <tr>
                        <th scope="row"><?=$no++?></th>
                        <td><?=$its['name']?></td>
                        <td><?=$its['katpem']?></td>
                        <td><?=$its['info']?></td>
                        <td><?=$its['tujuan']?></td>
                        <td><?=$its['nama_instansi']?></td>
                        <td>
                        <span class="badge bg-primary text-light"><?=$its['status']?></span>
                        </td>
                        <td>
                            <a href="<?=base_url('diskominfo/lihat/').$its['id']?>"><button class="btn btn-info">Lihat</button></a>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->