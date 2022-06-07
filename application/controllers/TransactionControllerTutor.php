<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionControllerTutor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaction', 'model_data');
		$this->load->model('Landing', 'model_datas');
		// if ($this->session->userdata('success') != TRUE) {
		//     redirect(base_url());
		// }
	}


	// public function index()
	// {
	// 	$data['content'] = 'tutors/pages/_transaction';
	// 	$this->load->view('tutors/layouts/master', $data);
	// }

	public function index()
	{
		$data['title'] = "Jadwal";
		$data['data'] = $this->model_datas->get_schedule($this->session->userdata('tutor_id'));
		// $data['data_transaksi'] = $this->model_data->get_data_transaction();
		// $data['data_transaksitutor'] = $this->model_data->get_data_transactiontutor();
		// print_r($data['data']);
		// die;
		$data['content'] = 'tutors/pages/_transaction';
		$this->load->view('tutors/layouts/master', $data);
	}

	// function get_data_user()
	// {
	// 	$list = $this->model_data->get_datatables();
	// 	$data = array();
	// 	$no = $_POST['start'];
	// 	foreach ($list as $field) {
	// 		$no++;
	// 		$row = array();
	// 		$row[] = $no;
	// 		$row[] = $field->student_name;
	// 		$row[] = $field->package_name;
	// 		$row[] = $field->status;
	// 		// $row[] = $field->schedule;
	// 		$row[] = $field->total;
	// 		$row[] = !$field->tutor ? 'Belum dipilih' : $field->tutor;
	// 		// $row[] = $field->is_active;
	// 		if ($field->receipt) {
	// 			$row[] = "<a target='_blank' href='" . base_url('/upload/img/receipt/') . $field->receipt . "'><img width='100' height='100' src='" . base_url('/upload/img/receipt/') . $field->receipt . "' /></a";
	// 		} else {
	// 			$row[] = 'Belum Upload Bukti Pembayaran';
	// 		}
	// 		$row[] = '<td><button class="btn btn-primary btn-class" onclick="updateList(' . "'" . $field->transaction_id . "'" . ')"><i class="fas fa-edit"></i></button>
	//         <button class="btn btn-danger btn-class" onclick="deleteList(' . "'" . $field->transaction_id . "'" . ')"><i class="fa fa-trash"></i></button></td>';

	// 		$data[] = $row;
	// 	}

	// 	$output = array(
	// 		"draw" => $_POST['draw'],
	// 		"recordsTotal" => $this->model_data->count_all(),
	// 		"recordsFiltered" => $this->model_data->count_filtered(),
	// 		"data" => $data,
	// 	);
	// 	//output dalam format JSON
	// 	echo json_encode($output);
	// }

	// function get_data_package()
	// {
	// 	$output = $this->model_data->get_packages();
	// 	echo json_encode($output);
	// }


	// function get_data_student()
	// {
	// 	$output = $this->model_data->get_students();
	// 	echo json_encode($output);
	// }

	// function get_data_tutor()
	// {
	// 	$output = $this->model_data->get_tutors();
	// 	echo json_encode($output);
	// }




	// public function add()
	// {


	// 	$this->_validate();
	// 	$id = $this->model_data->get_student_id($this->session->userdata('id'));
	// 	$data = array(
	// 		'student_id' => $id,
	// 		'package_id' => $this->input->post('package_id'),
	// 		'status' => $this->input->post('status'),
	// 		'is_active' => $this->input->post('is_active'),
	// 		'receipt' => $this->input->post('receipt'),
	// 		'discount' => $this->input->post('discount'),
	// 		'total' => $this->input->post('total'),
	// 		'schedule' => $this->input->post('schedule'),
	// 	);

	// 	if (!empty($_FILES['receipt']['name'])) {
	// 		$upload = $this->_do_upload();
	// 		$data['receipt'] = $upload;
	// 	}

	// 	$insert = $this->model_data->add($data);
	// 	echo json_encode(array("status" => TRUE, 'id' => $insert));
	// }





	// public function get_id($id)
	// {
	// 	$data = $this->model_data->get_id($id);
	// 	echo json_encode($data);
	// }




	// public function add_transaction()
	// {
	// 	$package_id = $this->input->post('package_id');
	// 	$package = $this->model_data->get_by_package($package_id);
	// 	$id = $this->model_data->get_student_id($this->session->userdata('id'));
	// 	$date = date('Ymd');
	// 	$rand = rand(0, 9);
	// 	$rand = str_pad($rand, 2, 0, STR_PAD_LEFT);
	// 	$rand = $date . $rand;
	// 	// var_dump($id->student_id);
	// 	// return var_dump($package, $package_id);
	// 	$data = array(
	// 		'id' => $rand,
	// 		'student_id' => $id->student_id,
	// 		'package_id' => $package_id,
	// 		'status' => 'pending',
	// 		'is_active' => 'active',
	// 		'total' => $package->price,
	// 	);
	// 	$insert = $this->model_data->add($data);
	// 	// $student_id = 2;
	// 	// $data['data'] = $this->model_datas->get_payment($student_id);
	// 	// $this->load->view('home/pages/payment', $data);
	// 	redirect('/payment');
	// 	echo json_encode(array("status" => TRUE, 'id' => $insert));
	// }





	public function add_transaction()
	{
		$package_id = $this->input->post('package_id');
		$package = $this->model_data->get_by_package($package_id);
		$id = $this->model_data->get_student_id($this->session->userdata('id'));
		$date = date('Ymd');
		$rand = rand(0, 9);
		$rand = str_pad($rand, 2, 0, STR_PAD_LEFT);
		$rand = $date . $rand;
		// var_dump($id->student_id);
		// return var_dump($package, $package_id);
		$data = array(
			'id' => $rand,
			'student_id' => $id->student_id,
			'package_id' => $package_id,
			'status' => 'pending',
			'is_active' => 'active',
			'total' => $package->price,
		);
		// echo "<pre>";
		// print_r($data);
		// die;
		// echo "</pre>";
		$insert = $this->model_data->add($data);
		// $student_id = 2;
		// $data['data'] = $this->model_datas->get_payment($student_id);
		// $this->load->view('home/pages/payment', $data);
		if ($insert) {
			$this->session->set_flashdata('message', 'Sukses order');
			redirect('/tutor/transaction');
		} else {
			$this->session->set_flashdata('message', 'Gagal order');
			redirect('/tutor/transaction');
		}
		// echo json_encode(array("status" => TRUE, 'id' => $insert));
	}





	// public function update($id = 0)
	// {
	// 	$this->_validate();
	// 	$data = array(
	// 		'student_id' => $this->session->userdata('id'),
	// 		'package_id' => $this->input->post('package_id'),
	// 		'status' => $this->input->post('status'),
	// 		'is_active' => $this->input->post('is_active'),
	// 		'receipt' => $this->input->post('receipt'),
	// 		'discount' => $this->input->post('discount'),
	// 		'total' => $this->input->post('total'),
	// 		'schedule' => $this->input->post('schedule'),
	// 	);

	// 	if (!empty($_FILES['receipt']['name'])) {
	// 		$upload = $this->_do_upload();

	// 		//delete file
	// 		$receipt = $this->model_data->get_id($id);
	// 		if (file_exists('upload/' . $receipt->receipt) && $receipt->receipt)
	// 			unlink('upload/' . $receipt->receipt);

	// 		$data['receipt'] = $upload;
	// 	}

	// 	$this->model_data->update(array('id' => $id), $data);
	// 	echo json_encode(array("status" => TRUE));
	// }


	public function updateStatus($id = 0)
	{
		// $this->_validate();
		$id = $this->input->post('id');
		$data = array(
			// 'student_id' => $this->session->userdata('id'),
			// 'package_id' => $this->input->post('package_id'),
			'tutor_id' => $this->input->post('tutor'),
			'status' => $this->input->post('status'),
			// 'is_active' => $this->input->post('is_active'),
			// 'receipt' => $this->input->post('receipt'),
			// 'discount' => $this->input->post('discount'),
			// 'total' => $this->input->post('total'),
			// 'schedule' => $this->input->post('schedule'),
		);

		$update = $this->model_data->update(array('id' => $id), $data);
		if ($update) {
			$this->session->set_flashdata('message', 'Sukses terupdate');
			redirect('/tutor/transaction');
		} else {
			$this->session->set_flashdata('message', 'Gagal terupdate');
			redirect('/tutor/transaction');
		}
		// echo json_encode(array("status" => TRUE));
	}

	public function delete($id = 0)
	{
		$this->model_data->delete($id);
		echo json_encode(array("status" => TRUE));
	}

	// private function _do_upload()
	// {
	// 	$config['upload_path']          = 'upload/receipt';
	// 	$config['allowed_types']        = 'gif|jpg|png';
	// 	$config['max_size']             = 1000; //set max size allowed in Kilobyte
	// 	$config['max_width']            = 1000; // set max width image allowed
	// 	$config['max_height']           = 1000; // set max height allowed
	// 	$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

	// 	$this->load->library('upload', $config);

	// 	if (!$this->upload->do_upload('receipt')) //upload and validate
	// 	{
	// 		$data['inputerror'][] = 'receipt';
	// 		$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
	// 		$data['status'] = FALSE;
	// 		echo json_encode($data);
	// 		exit();
	// 	}
	// 	return $this->upload->data('file_name');
	// }

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		// if ($this->input->post('question') == '') {
		// 	$data['inputerror'][] = 'question';
		// 	$data['error_string'][] = 'question is required';
		// 	$data['status'] = FALSE;
		// }
		// if ($this->input->post('answer') == '') {
		// 	$data['inputerror'][] = 'answer';
		// 	$data['error_string'][] = 'asnwer is required';
		// 	$data['status'] = FALSE;
		// }

		// if ($data['status'] === FALSE) {
		// 	echo json_encode($data);
		// 	exit();
		// }
	}
}

/* End of file TransactionController.php */
