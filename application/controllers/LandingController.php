<?php

class LandingController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Landing', 'model_data');
	}
	public function index()
	{
		$data['faqs'] = $this->model_data->get_faq();
		// $this->load->view('landing_page/pages/landing-page');
		$this->load->view('home/pages/landingpage', $data);
		// echo 'asdfsadf';
	}

	public function leason()
	{
		$data['data'] = $this->model_data->get_packages();
		$this->load->view('home/pages/leason', $data);
	}

	public function payment()
	{
		$student_id = $this->session->userdata('id');
		$id = $this->model_data->get_student_id($this->session->userdata('id'));
		$data['data'] = $this->model_data->get_payment($id->student_id);
		if (!$id) {
			return redirect('/login');
		}
		$this->load->view('home/pages/payment', $data);
	}

	public function form()
	{
		if ($this->session->userdata('name') == null) {
			return redirect('/login');
		}
		$data['class'] = $this->model_data->get_class();
		$this->load->view('home/pages/form', $data);
	}

	public function leasonCheckout()
	{
		$student = $this->session->userdata('role') == 'student' ? true : false;
		if (!$student) {
			redirect('login', 'refresh');
		}
	}

	public function addTransaction()
	{
		$student = $this->session->userdata('id');
		$package_id = $this->input->post('package_id');
	}

	public function uploadReceipt()
	{
		$data = [];
		if (!empty($_FILES['receipt']['name'])) {
			$upload = $this->_do_upload();
			$data['receipt'] = $upload;
		}
		// return var_dump($data, )

		$student = $this->model_data->get_student_id($this->session->userdata('id'));
		// $receipt = $this->input->post('receipt');
		$transaction_id = $this->input->post('transaction_id');
		$this->model_data->update_receipt('transactions',  $transaction_id, $student,  $data);
		redirect('/payment', 'refresh');
	}


	private function _do_upload()
	{
		$config['upload_path']          = 'upload/img/receipt/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('receipt')) //upload and validate
		{
			$data['inputerror'][] = 'receipt';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}
}
