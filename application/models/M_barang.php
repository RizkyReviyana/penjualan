<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Barang extends CI_Model {

    // Fungsi untuk mendapatkan jumlah barang dan stok
    public function jumlahBarang() {
        $this->db->select('count(namaBarang) as jumBarang, sum(stok) as jumStok');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query;
    }
    
}
function getkodeunik() {
    // Query untuk mendapatkan ID barang terakhir
    $q = $this->db->query("SELECT MAX(RIGHT(idBarang, 2)) AS idmax FROM barang");
    $kd = ""; // Kode awal
    
    if ($q->num_rows() > 0) { // Jika data ada
        foreach ($q->result() as $k) {
            // Mengambil angka ID terakhir, kemudian menambahkan 1
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

function tambah() {
    // Ambil data input dari form
    $id = $this->input->post('id');
    $nama = $this->input->post('namaBarang');
    $harga = $this->input->post('harga');
    $stok = $this->input->post('stok');
    $foto = $_FILES['foto']['name'];
    
    // Load library upload
    $this->load->library('upload');
    
    // Konfigurasi upload
    $config['upload_path'] = './assets/gambar'; // Path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; // Jenis file yang boleh diupload
    $config['file_name'] = $nama; // Nama file yang terupload nantinya
    
    // Initialize upload config
    $this->upload->initialize($config);
    
    if ($_FILES['foto']['name']) { // Jika ada file foto yang diupload
        if ($this->upload->do_upload('foto')) { // Cek apakah upload berhasil
            $gbr = $this->upload->data();
            define('WP_MEMORY_LIMIT', '256M');
            $source_url = $config['upload_path'] . '/' . $gbr['file_name'];
            // Membaca gambar dan mengurangi kualitas gambar menjadi 50%
            $image = imagecreatefromjpeg($source_url);
            imagejpeg($image, $config['upload_path'] . '/' . $gbr['file_name'], 50);
            
            // Menyusun data untuk dimasukkan ke database
            $data = array(
                'idBarang' => $id,
                'namaBarang' => $nama,
                'harga' => $harga,
                'stok' => $stok,
                'foto' => $gbr['file_name']
            );
        }
    }
    
    // Insert data barang ke database
    $this->db->insert('barang', $data);
}
function getBarang(){
    $this->db->select('*');
    $this->db->from('barang');
    $query = $this->db->get();
    return $query;
}

?>
