<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TutorController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('Tutor', 'model_data');
		// if ($this->session->userdata('success') != TRUE) {
		//     redirect(base_url());
		// }
	}


	public function index()
	{
		$data['content'] = 'admin/pages/_tutor';
		$this->load->view('admin/layouts/master', $data);
	}

	function get_data_user()
	{
		$list = $this->model_data->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			// $row[] = $field->id;            
			$row[] = $field->email;
			$row[] = $field->name;
			$row[] = $field->address;
			$row[] = $field->sex;
			$row[] = $field->profession;
			if ($field->avatar)
				$row[] = '<a href="' . base_url('upload/' . $field->avatar) . '" target="_blank"><img src="' . base_url('upload/' . $field->avatar) . '" class="img-responsive" style="width: 50px;" /></a>';
			else
				$row[] = '(No avatar)';
			$row[] = $field->tutor_act;
			if ($field->file_pdf)
				$row[] = '<a href="' . base_url('upload/file_pdf/' . $field->file_pdf) . '" target="_blank">' . $field->file_pdf  . '</a>';
			else
				$row[] = '(No File)';
			$row[] = $field->is_available == 'available' ? '<div class="badge badge-success">Tersedia</div>' : '<div class="badge badge-light">Tidak Tersedia</div>';
			if ($this->session->userdata("role") == "admin") {
				$row[] = '<td><button class="btn btn-primary btn-class" onclick="updateList(' . "'" . $field->tutor_id . "'" . ')"><i class="fas fa-edit"></i></button>
				<button class="btn btn-danger btn-class" onclick="deleteList(' . "'" . $field->tutor_id . "'" . ')"><i class="fa fa-trash"></i></button></td>';
			} else {
				$row[] = 'No Action';
			}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_data->count_all(),
			"recordsFiltered" => $this->model_data->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000; //set max size allowed in Kilobyte
		$config['max_width']            = 1000; // set max width image allowed
		$config['max_height']           = 1000; // set max height allowed
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('avatar')) //upload and validate
		{
			$data['inputerror'][] = 'avatar';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}


	public function add()
	{
		$this->_validate();
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('pass', true), PASSWORD_BCRYPT),
			'role' => $this->input->post('role'),
			'is_active' => $this->input->post('is_active'),
			'created_at' =>  mdate('%Y-%m-%d %H:%i:%s', now()),

		);
		if (!empty($_FILES['avatar']['name'])) {
			$upload = $this->_do_upload();
			$data['avatar'] = $upload;
		}

		$insert = $this->model_data->add($data);
		echo json_encode(array("status" => TRUE));
	}
	public function get_id($id)
	{
		$data = $this->model_data->get_id($id);
		echo json_encode($data);
	}
	public function update($id)
	{
		$this->_validate_sec();
		$data['content'] = 'admin/pages/_user';
		$this->load->view('admin/layouts/master', $data);
		$data = array(
			// 'username' => $this->input->post('username'),
			// 'email' => $this->input->post('email'),
			'is_active' => $this->input->post('is_active'),
		);

		if (!empty($_FILES['avatar']['name'])) {
			$upload = $this->_do_upload();

			//delete file
			$avatar = $this->model_data->get_id($id);
			if (file_exists('upload/' . $avatar->avatar) && $avatar->avatar)
				unlink('upload/' . $avatar->avatar);

			$data['avatar'] = $upload;
		}

		$this->model_data->update(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function delete($id)
	{
		$this->model_data->delete($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('username') == '') {
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'username is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('email') == '') {
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'asnwer is required';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_sec()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('is_active') == '') {
			$data['inputerror'][] = 'is_active';
			$data['error_string'][] = 'is_active is required';
			$data['status'] = FALSE;
		}


		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function profile()
	{
		if ($this->session->userdata('role') == 'student') {
			$data['content'] = 'admin/pages/_profile_student';
		} else if ($this->session->userdata('role') == 'tutor') {
			$data['content'] = 'admin/pages/_profile_tutor';
		} else if ($this->session->userdata('role') == 'admin') {
			$data['data'] = $this->model_data->get_admin_data(
				$this->session->userdata('user_id')
			);
			$data['test'] = 'asdfasdfasd';
			$data['content'] = 'admin/pages/_profile_admin';
		} else {
			$data['content'] = 'admin/pages/_profile_student';
		}
		$this->load->view('admin/layouts/master', $data);
	}
}

/* End of file TutorController.php */
