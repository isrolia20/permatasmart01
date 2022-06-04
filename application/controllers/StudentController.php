<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StudentController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('Student', 'model_data');
		// if ($this->session->userdata('success') != TRUE) {
		//     redirect(base_url());
		// }
	}


	public function index()
	{
		$data['content'] = 'admin/pages/_student';
		$this->load->view('admin/layouts/master', $data);
	}

	public function addStudent()
	{
		$data['content'] = 'admin/pages/_add_student';
		$this->load->view('admin/layouts/master', $data);
	}

	public function save_student()
	{
		// $config['upload_path'] = 'assets/img/student/';
		// $config['allowed_types'] = 'gif|jpg|png|jpeg';
		// $config['overwrite'] = TRUE;
		// $config['file_name'] = $_FILES['avatar']['name'];
		// $this->load->library('upload', $config);

		$user = array(
			'email'  => $this->input->post('email', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
			'is_active' => 'active',
			'role' => 'student',
		);




		$email = $this->model_data->get_user(['email' => $this->input->post('email')])->num_rows();
		if ($email < 1) {
			if (!empty($_FILES['avatar']['name'])) {
				$upload = $this->_do_upload();
				$user['avatar'] = $upload;
			}
			$insertUser = $this->model_data->add('users', $user);


			$additional_data = array(
				'user_id' => $insertUser,
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'sex' => $this->input->post('sex'),
				'phone_number' => $this->input->post('phone_number'),
				'parent' => $this->input->post('parent'),
				'phone_number_parent' => $this->input->post('phone_number_parent'),
				'bio' => $this->input->post('bio'),
				'school' => $this->input->post('school'),
				'level' => $this->input->post('level'),
				'class' => $this->input->post('class'),
			);

			$insertStudent = $this->model_data->add('students', $additional_data);
			if ($insertStudent) {
				$this->session->set_flashdata('message', 'Sukses terinput');
				redirect('/admin/student');
			} else {
				$this->session->set_flashdata('message', 'Gagal terinput');
				redirect('/admin/student');
			}
		} else {
			$this->session->set_flashdata('message', 'Email sudah terdaftar');
			redirect('/admin/student');
		}
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
				$row[] = '<a href="' . base_url('upload/img/student/' . $field->avatar) . '" target="_blank"><img src="' . base_url('upload/img/student/' . $field->avatar) . '" class="img-responsive" style="width: 50px;" /></a>';
			else
				$row[] = '(No avatar)';
			$row[] = $field->school;

			$row[] = '<td><button class="btn btn-primary btn-class" onclick="updateList(' . "'" . $field->student_id . "'" . ')"><i class="fas fa-edit"></i></button>
				<button class="btn btn-danger btn-class" onclick="deleteList(' . "'" . $field->student_id . "'" . ')"><i class="fa fa-trash"></i></button></td>';


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
		$config['upload_path']          = 'upload/img/student/';
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
			'password' => password_hash('siswasiswa', PASSWORD_BCRYPT),
			'role' => 'student',
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
			'sex' => $this->input->post('gender'),
			'phone_number' => $this->input->post('phone_number'),
			'school' => $this->input->post('school'),
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

		$this->_validate();
		$data_student = $this->model_data->get_id($id);
		$student_id = $data_student->student_id;
		$user_id = $data_student->user_id;
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
			'sex' => $this->input->post('gender'),
			'phone_number' => $this->input->post('phone_number'),
			'school' => $this->input->post('school'),
		);

		$this->model_data->update('students', array('id' => $student_id), $additional_data);
		echo json_encode(array("status" => TRUE));
	}
	public function delete($id)
	{
		$id = $this->model_data->delete($id);
		echo json_encode(array("status" => TRUE, "id" => $id));
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
