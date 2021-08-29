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
        $this->load->view('main/surat/tabel/penelitian');
        $this->load->view('templates/surat/footer');

        if ($id = $this->input->get('tg') == 'same_user') {
            $this->load->view('templates/user/alertSameUser');
        }
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
        $this->load->view('main/surat/tampil_about');
        $this->load->view('templates/surat/footer');
    }

    // $config['upload_path']          = './uploads/layanan/berkas/';
    // $config['allowed_types']        = 'pdf';
    // $config['max_size']             = 2048;

    // $this->load->library('upload', $config);

    // if ( ! $this->upload->do_upload('userfile'))
    // {
    //         $error = array('error' => $this->upload->display_errors());

    //         $this->load->view('upload_form', $error);
    // }
    // else
    // {
    //     $berkas = $this->upload->data();
    //     $berkas = $berkas['file_name'];
    //     $no_surat = htmlspecialchars($this->input->post('no_surat'));
    //     $kategori = htmlspecialchars($this->input->post('kategori'));
    //     $judul = htmlspecialchars($this->input->post('judul'));
    //     $dataPengajuan = array(
    //         'no_surat'      => $no_surat,
    //         'kategori'          => $kategori,
    //         'judul'            => $judul,
    //     );

    //         $data = array('upload_data' => $this->upload->data());

    //         $this->load->view('upload_success', $data);
    // }

    public function proses_tambaharsip()
    {
        if ($this->input->post('finish')) {
            $config['upload_path']          = './uploads/layanan/berkas/';
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
                redirect('C_arsip/index');
                print_r($dataPengajuan);
            }
        }
    }

    public function delete()
    {
        $no_surat = $this->input->get('no_surat');
        $this->model_arsip->hapus_surat($no_surat);
        redirect('C_arsip/index');
    }

    public function lihat_surat()
    {
        $no_surat = $this->input->get('no_surat');
        $data['title'] = ' Lihat Arsip | Desa XYZ';
        $data['arsip'] = $this->model_arsip->lihat_surat($no_surat);

        $this->load->view('templates/surat/header', $data);
        $this->load->view('main/surat/features/lihat_surat', $data);
        $this->load->view('templates/surat/footer');
    }

    public function download($no_surat)
    {
        $this->load->helper('download');
        $fileinfo = $this->model_arsip->download($no_surat);
        $file = 'uploads/layanan/berkas' . $fileinfo['berkas'];
        force_download($file, NULL);

        // $this->load->helper('download');
        // $no_surat = $this->input->get('no_surat');
        // $unduh = $this->model_arsip->download_surat($no_surat);
        // force_download('uploads/layanan/berkas/' . $unduh[0]['unduh'], null);
    }

    function file()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("uploads/layanan/berkas/" . $name);
        force_download($name, $data);
    }
}