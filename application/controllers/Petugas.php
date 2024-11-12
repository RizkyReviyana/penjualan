<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index() {
        if ($this->session->userdata('level') != 'Petugas') {
            redirect('login');
        } else {
            $data['petugas'] = $this->m_user->selectPetugas()->row();
            $this->load->view('petugas/header');
            $this->load->view('petugas/home', $data);
            $this->load->view('petugas/footer');
        }
    }

    function dataPetugas()
    {
    // Cek login
    if (!$this->session->userdata('level') == 'Admin') {
        redirect('login');
    } else {
        // Ambil data admin dan petugas
        $data['admin'] = $this->m_user->selectAdmin()->row();
        $data['dataPetugas'] = $this->m_user->getPetugas()->result();
        
        // Memuat tampilan
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dataPetugas');
        $this->load->view('admin/footer');
    }
    }

}
?>
