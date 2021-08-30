<section class="surat" id="surat">
    <div class="container-fluid">
        <div class="row">
            <?php
            $query = $this->db->get_where('arsip', array('id' => $id));
            foreach ($query->result() as $row) {

            ?>

            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Arsip Surat >> Lihat </h3>
                        <p class="card-text">Nomor Surat : <?= $row->no_surat; ?></p>
                        <p class="card-text">Kategori : <?= $row->kategori; ?></p>
                        <p class="card-text">Judul : <?= $row->judul; ?></p>
                        <p class="card-text">Waktu unggah : <?= $row->dibuat_pada; ?></p>
                    </div>
                </div>
            </div>
            <iframe src="<?= base_url() ?>/uploads/<?php echo $row->berkas ?>" width="100%" height="500px">
            </iframe>
            <br>
            <br>


            <a href="<?= base_url('C_arsip/index') ?>" class="btn btn-success btn-sm">
                << Kembali </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?= base_url(); ?>C_arsip/download/<?= $row->berkas ?>" class="btn btn-warning">Unduh</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?= base_url("C_arsip/edit/" . $row->id) ?>" class="btn btn-info">
                        <i class="" aria-hidden="true"></i>
                        <span>Edit / Ganti File</span>
                    </a>
                    <?php
                }
                    ?>
        </div>
    </div>
</section>