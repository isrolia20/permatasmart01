<?php

class DashPenjual_model extends CI_Model
{
    //Only User Seller
    public function update_user_seller($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //Data Barang
    public function data_barang($user_id)
    {
        $query = "SELECT * FROM barang WHERE barang.user_id = $user_id";
        return $this->db->query($query)->result_array();
    }
    //
    public function getPendapatan($id)
    {
        $query = "SELECT SUM(detail_transaksi.total) AS pendapatan, DATE_FORMAT(detail_transaksi.tanggal_detail, '%M %Y') AS bulan
        FROM detail_transaksi
          WHERE
            detail_transaksi.penjual_id = $id AND
            detail_transaksi.status = 2              
              GROUP BY MONTH(detail_transaksi.tanggal_detail)
              HAVING SUM(detail_transaksi.total)
              ORDER BY detail_transaksi.tanggal_detail DESC
              LIMIT 1";

        $getPendapatan = $this->db->query($query)->result_array();

        return $getPendapatan;
    }

    public function getCountPendapatan($id)
    {
        $query = "SELECT COUNT(detail_transaksi.status) AS banyakTransaksi, DATE_FORMAT(detail_transaksi.tanggal_detail, '%M %Y') AS bulan
        FROM detail_transaksi
          WHERE
            detail_transaksi.status = 2 AND detail_transaksi.penjual_id = $id
              
              GROUP BY MONTH(detail_transaksi.tanggal_detail)
              HAVING COUNT(detail_transaksi.status)
              ORDER BY detail_transaksi.tanggal_detail DESC
              LIMIT 1";

        $getPendapatan = $this->db->query($query)->result_array();

        return $getPendapatan;
    }

    public function transaction($id)
    {
        $data = $this->db->query("SELECT * from detail_transaksi WHERE penjual_id = $id");
        return $data->result();
    }

    public function get_jenis()
    {
        $query = "SELECT * FROM jenis GROUP BY jenis.name";
        return $this->db->query($query)->result_array();
    }
    public function insert_barang($data)
    {
        $this->db->insert('barang', $data);
    }
    public function update_barang($where, $datas)
    {
        $this->db->where('id', $where);
        $this->db->update('barang', $datas);
    }

    //Data Riwayat Penjualan
    public function riwayat_penjualan($id)
    {
        $query = "SELECT detail_transaksi.id_detail, detail_transaksi.barang_id, detail_transaksi.name, detail_transaksi.stok, detail_transaksi.harga, detail_transaksi.image, detail_transaksi.total, detail_transaksi.status, detail_transaksi.tanggal_detail, detail_transaksi.image_bayar, detail_transaksi.penjual_id, detail_transaksi.transaksi_id, transaksi.id, transaksi.kode, transaksi.pembeli_name, transaksi.pembeli_telp, transaksi.tanggal_transaksi FROM detail_transaksi
                     JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.id WHERE detail_transaksi.penjual_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getRangeDate($date1, $date2, $id_user)
    {
        if (!empty($date1) && !empty($date2)) {
            $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.penjual_id = $id_user AND detail_transaksi.tanggal_detail BETWEEN '$date1' and '$date2'";
            return $this->db->query($query)->result();
        } else {
            $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.penjual_id = $id_user";
            return $this->db->query($query)->result();
        }
    }
}
