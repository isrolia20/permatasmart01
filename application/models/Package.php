<?php

class Package extends CI_Model
{

	var $table = 'packages'; //nama tabel dari database
	var $column_order = array('id', 'name', 'price', 'description', 'duration', 'level');
	var $column_search = array('id', 'name', 'price', 'description', 'duration', 'level');
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		if ($this->input->post('id')) {
			$this->db->like('id', $this->input->post('id'));
		}
		if ($this->input->post('name')) {
			$this->db->like('name', $this->input->post('name'));
		}
		if ($this->input->post('price')) {
			$this->db->like('price', $this->input->post('price'));
		}

		$this->db->from($this->table);
		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function get_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($id, $data)
	{
		// $this->db->where('id',$id);
		// $this->db->update($this->table,$data);
		$this->db->update($this->table, $data, $id);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}






	// -================== v ==================-
	public function get_data_packages()
	{
		$query = "SELECT * FROM packages ORDER BY packages.name ASC";
		return $this->db->query($query)->result_array();
	}
}
