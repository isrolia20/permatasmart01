<?php

class Transaction extends CI_Model
{

	var $table = 'transactions'; //nama tabel dari database	
	var $column_order = array('transaction_id', 'student_name', 'package_name', 'status', 'total', 'tutor');
	var $column_search = array('transaction_id', 'student_name', 'package_name', 'status', 'total', 'tutor');
	// var $column_order = array('transaction_id', 'student_name', 'package_name', 'status', 'schedule', 'total', 'tutor');
	// var $column_search = array('transaction_id', 'student_name', 'package_name', 'status', 'schedule', 'total', 'tutor');
	var $order = array('transactions.id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->select('*,tutors.name AS tutor ,transactions.id AS transaction_id, students.name AS student_name, packages.name AS package_name, students.id AS student_id, packages.id AS package_id');

		$this->db->join('tutors', 'tutors.id = tutor_id', 'left');
		$this->db->join('students', 'students.id = transactions.student_id');
		$this->db->join('packages', 'packages.id = transactions.package_id');
		// $this->db->join('schedules', 'schedules.id = packages.schedule_id');
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

	public function get_packages()
	{
		$this->db->from('packages');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_students()
	{
		$this->db->from('students');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tutors()
	{
		$this->db->from('tutors');
		$query = $this->db->get();
		return $query->result();
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
		$this->db->select('*,transactions.id AS transaction_id, students.name AS student_name, packages.name AS package_name, students.id AS student_id, packages.id AS package_id');

		$this->db->join('students', 'students.id = transactions.student_id');
		$this->db->join('packages', 'packages.id = transactions.package_id');
		$this->db->where('transactions.id', $id);
		$query = $this->db->get();
		return $query->row();
	}


	public function get_student_id($id)
	{
		$this->db->select('*, students.id AS student_id');
		$this->db->from('students');
		$this->db->join('users', 'users.id = students.user_id');
		$this->db->where('users.id', $id);
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

	public function get_by_package($id)
	{
		$this->db->select('*, packages.name AS package, leasons.name AS leason, features.name AS feature');
		$this->db->from('packages');
		$this->db->join('leasons', 'leasons.package_id = packages.id', 'left');
		$this->db->join('features', 'features.package_id = packages.id', 'left');
		$this->db->where('packages.id', $id);

		$query = $this->db->get();
		return $query->row();
	}






	// -================== v ==================-
	public function get_data_transaction()
	{
		$this->db->select('*,tutors.name AS tutor ,transactions.id AS transaction_id, students.name AS student_name, packages.name AS package_name, students.id AS student_id, packages.id AS package_id');
		$this->db->from($this->table);
		$this->db->join('tutors', 'tutors.id = tutor_id', 'left');
		$this->db->join('students', 'students.id = transactions.student_id');
		$this->db->join('packages', 'packages.id = transactions.package_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	// -================== v ==================-
	public function get_data_transactiontutor()
	{
		$query = "SELECT tutors.id, tutors.name FROM tutors ORDER BY tutors.id ASC";
		return $this->db->query($query)->result_array();
	}
}
