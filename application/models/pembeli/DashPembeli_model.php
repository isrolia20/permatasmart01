<?php

class DashPembeli_model extends CI_Model
{

    public function update_user_pembeli($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //Data Banner
    public function data_banner()
    {
        $query = "SELECT * FROM data_banner ORDER BY data_banner.id ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Tanaman
    public function data_barang()
    {
        $query = "SELECT * FROM barang ORDER BY barang.id ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Cart
    public function data_cart($id)
    {
        $query = $this->db->where('id', $id)->limit(1)->get('barang');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    //Data Checkout
    public function data_checkout()
    {
        $query = "SELECT * FROM transaksi
                    JOIN detail_transaksi ON transaksi.id = detail_transaksi.transaksi_id GROUP BY transaksi.kode";
        return $this->db->query($query)->result_array();
    }

    //Batal System
    public function system_batal($id)
    {
        $query = "SELECT detail_transaksi.barang_id, detail_transaksi.name, detail_transaksi.stok FROM detail_transaksi WHERE detail_transaksi.transaksi_id = $id";
        return $this->db->query($query)->result_array();
    }

    //Detail Transaksi
    public function detail_trans($id)
    {
        $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.transaksi_id = '$id' ORDER BY detail_transaksi.id_detail DESC";
        return $this->db->query($query)->result_array();
    }

    //Per Transaksi
    public function per_trans($id)
    {
        $query = "SELECT * FROM detail_transaksi
                    JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.id WHERE detail_transaksi.id_detail = '$id'";
        return $this->db->query($query)->row_array();
    }

    //Upload Bukti Bayar
    public function upload_bukti($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('transaksi', $data);
    }

    //Data Seller Only
    public function seller_only($id)
    {
        $query = "SELECT * FROM user WHERE user.id = '$id'";
        return $this->db->query($query)->row_array();
    }

    public function getRangeDate($date1, $date2, $id_user)
    {
        if (!empty($date1) && !empty($date2)) {
            $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.penjual_id AND detail_transaksi.tanggal_detail BETWEEN '$date1' and '$date2'";
            return $this->db->query($query)->result();
        } else {
            $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.penjual_id";
            return $this->db->query($query)->result();
        }
    }

    public function getBaseSearch($datainput, $limit, $start)
    {
        $query = "SELECT * FROM barang WHERE barang.name = '$datainput' ORDER BY barang.id LIMIT $limit";
        return $this->db->query($query)->result_array();
    }





    // ------------------------ Camel Case typing -------------------------

    //Data All Produk
    public function getAllProduk()
    {
        return $this->db->get('barang')->result_array();
    }

    //Data Produk
    public function getProduk($limit, $start)
    {
        return $this->db->get('barang', $limit, $start)->result_array();
    }

    //count All Produk
    public function countAllProduk()
    {
        return $this->db->get('barang')->num_rows();
    }
}
