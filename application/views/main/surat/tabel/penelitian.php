<style>
.validasi-error {
    color: #FF0000;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?= base_url('assets/js/admin/validasi-penelitian.js') ?>"></script>

<div class="container-fluid">
    <h1 class="h2 mb-6 text-black-10000">Arsip Surat</h1>
    <h4 class="h6 mb-2 text-gray-800">Berikut ini adalah surat-surat yang telah diterbitkan dan diarsipkan.</h4>
    <h4 class="h6 mb-2 text-gray-800">Klik "Lihat" pada kolom aksi untuk menampilkan surat.</h4>
    <br>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Arsip</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor Surat </th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = $this->db->get('arsip');
                        foreach ($query->result() as $row) {
                        ?>
                        <tr>
                            <td><?= $row->no_surat ?></td>
                            <td><?= $row->kategori ?></td>
                            <td><?= $row->judul; ?></td>
                            <td><?= $row->dibuat_pada ?></td>
                            <td>

                                <a href="<?= base_url('C_arsip/delete?no_surat=' . $row->no_surat) ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus arsip surat ini ?')"
                                    class="btn btn-danger">Hapus</a>
                                <!-- <a href="<?php echo base_url() . 'C_arsip/download/' . $row->no_surat; ?>">Download</a>"; -->
                                <a href="<?= base_url('C_arsip/download?id=' . $row->no_surat) ?>"
                                    class="btn btn-warning">Unduh</a>
                                <a href="<?= base_url('C_arsip/lihat_surat?id=' . $row->no_surat) ?>"
                                    class="btn btn-primary">Lihat>></a>

                            </td>
                        </tr>
                        <?php
                            $no = $no + 1;
                        }
                        ?>
                    </tbody>
                </table>
                <a href="<?= base_url('C_arsip/tampil_tambah_arsip') ?>" class="btn btn-success btn-sm">
                    Arsipkan Surat.
                </a>
                <br>
                </br>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="unduhModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unduh Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('printer/index') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNomerSurat">Masukkan Nomer Surat</label><span id="nomorSurat-error"
                            class="validasi-error"> </span>
                        <input type="text" placeholder="Masukkan Nomer Surat" name="nomerSurat" id="nomerSurat"
                            class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="inputNomerSurat">Masukkan Tembusan</label><span id="tembusan-error"
                            class="validasi-error"></span>
                        <input type="text" placeholder="Masukkan Tembusan 1" name="tembusan1" id="tembusan1"
                            class="form-control mb-2" />
                        <input type="text" placeholder="Masukkan Tembusan 2" name="tembusan2" id="tembusan2"
                            class="form-control mb-2 " />
                        <input type="text" placeholder="Masukkan Tembusan 3" name="tembusan3" id="tembusan3"
                            class="form-control mb-2" />
                        <input type="text" placeholder="Masukkan Tembusan 4" name="tembusan4" id="tembusan4"
                            class="form-control mb-2" />
                        <input type="text" placeholder="Masukkan Tembusan 5" name="tembusan5" id="tembusan5"
                            class="form-control mb-2" />
                        <input type="text" placeholder="Masukkan Tembusan 6" name="tembusan6" id="tembusan6"
                            class="form-control" />
                    </div>
                </div>
                <input type="hidden" name="id" class="id" readonly />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="unduh" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$("#dataTable").on("click", ".button-edit", function() {
    let id = $(this).data("id");
    $("#unduhModal").modal("show");
    $(".id").val(id);
});
</script>