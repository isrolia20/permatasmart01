<?php

class Message_model extends CI_Model
{
    public function getMessage($id = null)
    {
        if ($id === null) {
            return $this->db->get('pesan')->result_array();
        } else {
            return $this->db->get_where('pesan', ['id_pesan' => $id])->result_array();
        }
    }
    public function deleteMessage($id)
    {
        $this->db->delete('pesan', ['id_pesan' => $id]);
        return $this->db->affected_rows();
    }
    public function createMessage($data)
    {
        $this->db->insert('pesan', $data);
        return $this->db->affected_rows();
    }
    public function updateMessage($data, $id)
    {
        $this->db->update('pesan', $data, ['id_pesan' => $id]);
        return $this->db->affected_rows();
    }
}
