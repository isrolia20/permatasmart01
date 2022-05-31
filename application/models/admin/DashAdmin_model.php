<?php

class DashAdmin_model extends CI_Model
{
    //Data User
    public function data_user()
    {
        $query = "SELECT * FROM user ORDER BY user.id ASC";
        return $this->db->query($query)->result_array();
    }
    public function status_user($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('user', $data);
    }
    public function delete_user($where)
    {
        $this->db->where('id', $where);
        $this->db->delete('user');
    }


    public function transaction()
    {
        $data = $this->db->query("SELECT * from detail_transaksi");
        return $data->result();
    }

    public function getPendapatan()
    {
        $query = "SELECT SUM(transaksi.total_transaksi) AS pendapatan, DATE_FORMAT(transaksi.tanggal_transaksi, '%M %Y') AS bulan
        FROM transaksi
          WHERE
            transaksi.status = 1
              
              GROUP BY MONTH(transaksi.tanggal_transaksi)
              HAVING SUM(transaksi.total_transaksi)
              ORDER BY transaksi.tanggal_transaksi DESC
              LIMIT 1";

        $getPendapatan = $this->db->query($query)->result_array();

        return $getPendapatan;
    }

    public function getCountPendapatan()
    {
        $query = "SELECT COUNT(transaksi.status) AS banyakTransaksi, DATE_FORMAT(transaksi.tanggal_transaksi, '%M %Y') AS bulan
        FROM transaksi
          WHERE
            transaksi.status = 1
              
              GROUP BY MONTH(transaksi.tanggal_transaksi)
              HAVING COUNT(transaksi.status)
              ORDER BY transaksi.tanggal_transaksi DESC
              LIMIT 1";

        $getPendapatan = $this->db->query($query)->result_array();

        return $getPendapatan;
    }

    //------ Get Filter sesuai tanggal syncronos
    public function getRangeDate($date1, $date2)
    {
        if (!empty($date1) && !empty($date2)) {
            $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.tanggal_detail BETWEEN '$date1' and '$date2'";
            return $this->db->query($query)->result();
        } else {
            $query = "SELECT * FROM detail_transaksi";
            return $this->db->query($query)->result();
        }
    }
    //------ Get Filter sesuai tanggal syncronos




    //Data Banner
    public function data_banner()
    {
        $query = "SELECT * FROM data_banner ORDER BY data_banner.id ASC";
        return $this->db->query($query)->result_array();
    }
    public function insert_data_banner($data)
    {
        $this->db->insert('data_banner', $data);
    }
    public function update_data_banner($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('data_banner', $data);
    }
    public function delete_data_banner($where)
    {
        $this->db->where('id', $where);
        $this->db->delete('data_banner');
    }

    //Only Profile User Admin
    public function update_profile($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //riwayat penjualan
    public function riwayat_penjualan()
    {
        $query = "SELECT * FROM detail_transaksi
                     JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.id";
        return $this->db->query($query)->result_array();
    }
}
