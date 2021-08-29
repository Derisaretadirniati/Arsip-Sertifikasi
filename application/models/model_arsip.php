<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_arsip extends CI_Model
{
    public function index()
    {

        $data['title'] = 'Arsip | Desa XYZ';
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/tabel/penelitian');
        $this->load->view('templates/surat/footer');

        if ($id = $this->input->get('tg') == 'same_user') {
            $this->load->view('templates/user/alertSameUser');
        }
    }

    function tambah_pengajuan($data)
    {
        $result = $this->db->insert('arsip', $data);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function hapus_surat($no_surat)
    {
        $this->db->where('no_surat', $no_surat);
        $this->db->delete('arsip');
        return true;
    }

    function lihat_surat($no_surat)
    {
        return $this->db->query("SELECT * FROM arsip WHERE no_surat='$no_surat'")->result_array();
    }

    public function download($no_surat)
    {
        $query = $this->db->get_where('arsip', array('no_surat' => $no_surat));
        return $query->row_array();
    }
}