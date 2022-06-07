<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Model
{

	public function authStudent($data)
	{
		$this->db->select('*, students.id AS student_id');
		$this->db->from('students');
		$this->db->join('users', 'users.id = user_id');
		$this->db->where($data);
		return $this->db->get();
	}

	public function authTutor($data)
	{
		$this->db->select('*, tutors.id AS tutor_id, tutors.is_active AS tutor_act');
		$this->db->from('tutors');
		$this->db->join('users', 'users.id = user_id');
		$this->db->where($data);
		return $this->db->get();
	}

	public function authAdmin($data)
	{
		$this->db->select('*, admins.id AS admin_id');
		$this->db->from('admins');
		$this->db->join('users', 'users.id = user_id');
		$this->db->where($data);
		return $this->db->get();
	}

	function saveUser($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	function saveTutor($data)
	{
		$this->db->insert('tutors', $data);
		return $this->db->insert_id();
	}

	function saveStudent($data)
	{
		$this->db->insert('students', $data);
		return $this->db->insert_id();
	}

	function save_tentang_tutor($data)
	{
		$this->db->insert('tentang_tutor', $data);
		return $this->db->affected_rows();
	}
}

/* End of file Auth.php */
