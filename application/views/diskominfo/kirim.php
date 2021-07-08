<div class="container">
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
</div>

<!--  -->