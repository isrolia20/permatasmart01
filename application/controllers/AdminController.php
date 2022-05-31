<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('Admin', 'model_data');
		if ($this->session->userdata('role') != 'admin') {
			redirect(base_url());
		}
	}


	public function index()
	{
		$data['content'] = 'admin/pages/_admin';
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
			$row[] = $field->email;
			$row[] = $field->name;
			$row[] = $field->address;
			$row[] = $field->phone_number;
			if ($field->avatar)
				$row[] = '<a href="' . base_url('upload/img/admin/' . $field->avatar) . '" target="_blank"><img src="' . base_url('upload/img/admin/' . $field->avatar) . '" class="img-responsive" style="width: 50px;" /></a>';
			else
				$row[] = '(No avatar)';
			$row[] = $field->privilege;

			$row[] = '<td><button class="btn btn-primary btn-class" onclick="updateList(' . "'" . $field->admin_id . "'" . ')"><i class="fas fa-edit"></i></button>
				<button class="btn btn-danger btn-class" onclick="deleteList(' . "'" . $field->admin_id . "'" . ')"><i class="fa fa-trash"></i></button></td>';


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
		$config['upload_path']          = 'upload/img/admin/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
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
			'email' => $this->input->post('email'),
			'password' => password_hash('adminadmin', PASSWORD_BCRYPT),
			'role' => 'admin',
			'is_active' => 'active',
			'created_at' =>  mdate('%Y-%m-%d %H:%i:%s', now()),

		);


		if (!empty($_FILES['avatar']['name'])) {
			$upload = $this->_do_upload();
			$data['avatar'] = $upload;
		}

		$insert_id = $this->model_data->add('users', $data);

		$additional_data = array(
			'name' => $this->input->post('name'),
			'user_id' => $insert_id,
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'privilege' => $this->input->post('privilege'),
		);
		$this->model_data->add('admins', $additional_data);
		echo json_encode(array("status" => TRUE));
	}
	public function get_id($id)
	{
		$data = $this->model_data->get_id($id);
		echo json_encode($data);
	}
	public function update($id)
	{
		$data_admin = $this->model_data->get_id($id);
		$admin_id = $data_admin->admin_id;
		$user_id = $data_admin->user_id;
		$this->_validate();
		$data = array(
			'email' => $this->input->post('email'),
			'updated_at' =>  mdate('%Y-%m-%d %H:%i:%s', now()),
		);

		if (!empty($_FILES['avatar']['name'])) {
			$upload = $this->_do_upload();

			//delete file
			$avatar = $this->model_data->get_id($id);
			if (file_exists('upload/' . $avatar->avatar) && $avatar->avatar)
				unlink('upload/' . $avatar->avatar);

			$data['avatar'] = $upload;
		}
		$this->model_data->update('users', array('id' => $user_id), $data);

		$additional_data = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'privilege' => $this->input->post('privilege'),
		);

		$this->model_data->update('admins', array('id' => $admin_id), $additional_data);
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
}

/* End of file UserController.php */
