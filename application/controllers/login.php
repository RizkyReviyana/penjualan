<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index() {
        // Cek session untuk menentukan level user
        if ($this->session->userdata('level') == 'Admin') {
            redirect('admin', 'refresh');
        } elseif ($this->session->userdata('level') == 'Petugas') {
            redirect('petugas', 'refresh');
        } else {
            // Tampilkan halaman login jika session tidak ditemukan
            $this->load->view('login');
        }
    }

    public function login_act() {
        // Ambil data email dan password yang di-submit
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        // Cek apakah email dan password terdaftar
        $cekEmailUser = $this->m_user->getEmailUser($email);
        $cekPassUser = $this->m_user->getPassUser($password);

        // Cek method yang digunakan, hanya POST yang diterima
        if ($this->input->method() != 'post') {
            redirect('login');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Cek format email
            $this->session->set_flashdata('peringatan', 'Format email salah');
        } elseif ($cekEmailUser->num_rows() == NULL) {
            // Cek apakah email ditemukan
            $this->session->set_flashdata('peringatan', 'Email tidak ditemukan');
        } elseif ($cekPassUser->num_rows() == NULL) {
            // Cek apakah password ditemukan
            $this->session->set_flashdata('peringatan', 'Password Salah');
        } elseif ($cekEmailUser->num_rows() != NULL && $cekPassUser->num_rows() != NULL) {
            // Jika email dan password valid, set session
            foreach ($cekEmailUser->result() as $data) {
                $data_user = [
                    'id' => $data->idUser,
                    'nama' => $data->nama,
                    'email' => $data->email,
                    'level' => $data->level
                ];
                $this->session->set_userdata($data_user);

                // Redirect berdasarkan level user
                if ($data->level == "Petugas") {
                    redirect('petugas');
                } elseif ($data->level == "Admin") {
                    redirect('admin');
                }
            }
        } else {
            // Jika terjadi kesalahan lain
            $this->session->set_flashdata('peringatan', 'Password Salah');
        }

        // Jika ada error, tampilkan halaman login kembali
        $this->load->view('login');
    
    
    }
    
}
