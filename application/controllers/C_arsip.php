<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_arsip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_arsip');
    }

    public function index()
    {

        $data['title'] = 'Arsip | Desa XYZ';
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/tabel/surat');
        $this->load->view('templates/surat/footer');
    }

    public function tampil_tambah_arsip()
    {
        $data['title'] = ' Tambah Arsip | Desa XYZ';
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/tambah_arsip');
        $this->load->view('templates/surat/footer');
    }

    public function About()
    {
        $data['title'] = ' About Arsip | Desa XYZ';
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/tabel/tampil_about');
        $this->load->view('templates/surat/footer');
    }

    public function proses_tambaharsip()
    {
        if ($this->input->post('finish')) {
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('berkas')) {
                echo 'error';
                echo $this->upload->display_errors();
            } else {
                $berkas = $this->upload->data();
                $berkas = $berkas['file_name'];
                $no_surat = htmlspecialchars($this->input->post('no_surat'));
                $kategori = htmlspecialchars($this->input->post('kategori'));
                $judul = htmlspecialchars($this->input->post('judul'));
                $dataPengajuan = array(
                    'no_surat'      => $no_surat,
                    'kategori'          => $kategori,
                    'judul'            => $judul,
                    'berkas' => $berkas,
                );
                $this->model_arsip->tambah_pengajuan($dataPengajuan);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, Data user berhasil ditambah !</div>');
                redirect('C_arsip/index');
                print_r($dataPengajuan);
            }
        }
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $this->model_arsip->hapus_surat($id);
        redirect('C_arsip/index', 'refresh');
    }

    public function lihat_surat()
    {
        $data['title'] = ' Lihat Arsip | Desa XYZ';
        $data['id'] = $this->input->get('id');
        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/features/lihat_surat',  $data);
        $this->load->view('templates/surat/footer');
    }

    function download($nama)
    {
        $this->load->helper('download');
        force_download('./uploads/' . $nama, NULL);
    }

    public function edit($id)
    {

        $data = array(
            'pageTitle' => 'Ubah Arsip Surat',
            'dataSurat' => $this->model_arsip->get($id),
        );

        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('judul', 'judul', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/surat/header', $data);
            $this->load->view('main/surat/features/edit_surat',  $data);
            $this->load->view('templates/surat/footer');
        } else {
            $filename = $this->input->post('no_surat') . ' - ' . $this->input->post('kategori') . ' - ' . $this->input->post('judul');

            $upload = $this->model_arsip->upload($filename);
            if ($upload['result'] == 'success') {
                $this->model_arsip->update($id, $upload);
                redirect('C_arsip');
            } else {
                echo $upload['error'];
            }
        }
    }
}