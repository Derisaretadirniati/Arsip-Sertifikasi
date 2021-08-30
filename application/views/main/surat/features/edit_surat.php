<div class="container-fluid">
    <!-- Page Heading -->

    <h1 class="h3 mb-6 text-gray-800">Arsip Surat >> Unggah</h1>
    <h1 class="h6 mb-2 text-gray-800">Unggah surat yang telah terbit pada form ini untuk diarsipkan.</h1>
    <h1 class="h6 mb-2 text-gray-800">Catatan:</h1>
    <h1 class="h6 mb-2 text-gray-800"> - Gunakan file berformat PDF</h1>
    <br>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Masukkan Data:</h6>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <?php foreach ($dataSurat as $row) : ?>
                        <?= $this->session->flashdata('message') ?>
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat</label>
                            <input type="id" name="no_surat" id="no_surat" value="<?= $row->no_surat ?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="<?= $row->kategori ?>"><?= $row->kategori ?></option>
                                <option value="undangan">Undangan</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="nota dinas">Nota Dinas</option>
                                <option value="pemberitahuan">Pemberitahuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" value="<?= $row->judul ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas">File Surat</label>
                            <input type="file" name="berkas" id="berkas" value="<?= $row->berkas ?>"
                                class="form-control">
                        </div>
                        <br>
                        <a href="<?= base_url('C_arsip/lihat') ?>" class="btn btn-security">
                            << Kembali </a>
                                <button type="submit" name="finish" id="finish" value="Finish"
                                    class="btn btn-success">Sukses</button>
                </div>
                <?php endforeach ?>
                </form>
            </div>
        </div>
    </div>