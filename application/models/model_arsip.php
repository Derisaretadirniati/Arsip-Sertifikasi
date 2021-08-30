<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_arsip extends CI_Model
{
    public function index()
    {

        $data['title'] = 'Arsip | Desa XYZ';
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/tabel/surat');
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

    function hapus_surat($id)
    {
        $this->db->where('id', $id);
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

    function edit_pengajuan($data)
    {
        $this->db->set('no_surat', $data['no_surat']);
        $this->db->set('kategori', $data['kategori']);
        $this->db->set('judul', $data['judul']);
        $this->db->set('berkas', $data['berkas']);
        $this->db->where('id', $data['id']);
        $this->db->update('arsip');
    }

    public function get($id = null)
    {
        if ($id == null) {
            return $this->db->get('arsip')->result();
        } else {
            return $this->db->get_where('arsip', ['id' => $id])->result();
        }
    }

    public function update($id, $upload)
    {
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'kategori' => $this->input->post('kategori'),
            'judul' => $this->input->post('judul'),
            'berkas' => $upload['berkas']['file_name'],
        );

        $this->db->where('id', $id);
        $this->db->update('arsip', $data);
    }


    public function upload($filename)
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf';
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('berkas')) {
            $return = array('result' => 'success', 'berkas' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            $return = array('result' => 'failed', 'berkas' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
}