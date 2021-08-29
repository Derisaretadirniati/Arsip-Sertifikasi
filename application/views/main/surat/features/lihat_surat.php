<!-- berita -->
<section class="berita" id="berita">
    <div class="container-fluid">
        <div class="row">
            <?php
            $no = 1;
            $query =  $this->db->get('arsip');

            foreach ($query->result() as $row) {
            ?>

            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kepada - <?= $row->no_surat; ?></h5>
                        <p class="card-text">Bertempat pada Kecamatan : <?= $row->kategori; ?></p>
                        <br><br>
                        <p class="card-text">Ditulis oleh : <?= $row->judul; ?></p>
                        <p class="card-text">Tempat : <?= $row->dibuat_pada; ?></p>
                    </div>
                </div>
                <center><object type="pdf" data="/uploads/layanan/berkas/ayo.pdf" width="900" height="700"></object>
                </center>
                <!-- <img src="<?= base_url(); ?>/uploads/layanan/berkas/<?= $row->berkas; ?>" alt="file berkas.."
                        class="card-img-top" width="100%" height="500px" /> -->
            </div>
            <?php
            }
            ?>
            <!-- 
            <div class="col-sm-3" id="twitter">
                <div class="card">
                    <div class="card-body">
                        <a class="twitter-timeline" data-width="400" data-height="400" data-dnt="true"
                            data-theme="light" href="https://twitter.com/kesbangkabmlg?ref_src=twsrc%5Etfw">Tweets by
                            kesbangkabmlg</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- akhir berita -->