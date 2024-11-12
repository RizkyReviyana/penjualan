<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Penjualan extends CI_Model {

    // Fungsi untuk mendapatkan statistik penjualan
    public function statistikPenjualan() {
        $this->db->select('barang.namaBarang, SUM(penjualan.qty) AS qty');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.idBarang = penjualan.idBarang'); // Pastikan kondisi JOIN benar
        $this->db->group_by('barang.namaBarang');
        $this->db->order_by('penjualan.idBarang');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi untuk menghitung jumlah penjualan dan pendapatan
    public function jumlahPenjualan() {
        $this->db->select('count(penjualan.idPenjualan) AS jumTransaksi, SUM(barang.harga * penjualan.qty) AS jumPendapatan');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.idBarang = penjualan.idBarang'); // Pastikan kondisi JOIN benar
        $query = $this->db->get();
        return $query;
    }
}
?>
