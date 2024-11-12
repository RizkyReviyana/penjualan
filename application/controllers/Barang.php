<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_barang', 'm_user'));
        date_default_timezone_set('Asia/Jakarta');
    }

    // Fungsi untuk mendapatkan kode unik barang
    function getkodeunik() {
        $q = $this->db->query("SELECT MAX(RIGHT(idBarang, 2)) AS idmax FROM barang");
        $kd = ""; // Kode awal

        if ($q->num_rows() > 0) { // Jika data ada
            foreach ($q->result() as $k) {
                // Mengambil angka ID terakhir dan menambahkan 1
                $tmp = ((int)$k->idmax) + 1;
                // Format kode menjadi 2 digit
                $kd = sprintf("%02s", $tmp);
            }
        } else { // Jika data kosong, set kode awal
            $kd = "01";
        }

        $kar = "B"; // Karakter depan kodenya
        // Gabungkan karakter dengan kode yang telah dibuat
        return $kar . $kd;
    }

    // Fungsi untuk menambah barang
    function tambah() {
        if ($this->session->userdata('level') != 'Petugas') {
            redirect('login');
        } else {
            if ($this->input->method() == 'post') {
                // Menambah barang jika method POST
                $this->m_barang->tambah();
                $this->session->set_flashdata('info', 'Data berhasil ditambah');
                redirect('barang/tambah');
            } else {
                // Menyiapkan data untuk view jika bukan POST
                $data['kodeunik'] = $this->m_barang->getkodeunik();
                $this->load->view('petugas/header');
                $this->load->view('petugas/tambahBarang', $data);
                $this->load->view('petugas/footer');
            }
        }
    }
    public function barang()
{
    if ($this->session->userdata('level') != 'Petugas') {
        redirect('login');
    } else {
        $data['dataBarang'] = $this->m_barang->getBarang()->result();
        $this->load->view('petugas/header');
        $this->load->view('petugas/dataBarang', $data);
        $this->load->view('petugas/footer');
    }
}
function dataBarang()
{
    if ($this->session->userdata('level') != 'Admin') {
        redirect('login');
    } else {
        $data['admin'] = $this->m_user->selectAdmin()->row();
        $data['dataBarang'] = $this->m_barang->getBarang()->result();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/dataBarang');
        $this->load->view('admin/footer');
    }
}

}
?>
