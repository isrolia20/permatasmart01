<?php

class DashboardController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Login_model', 'lgn');
		if ($this->session->userdata('role') == '') {
			redirect(base_url());
		}
	}
	public function index()
	{
		$data['content'] = 'admin/pages/_dashboard';
		$this->load->view('admin/layouts/master', $data);
	}
	// public function tutor()
	// {
	// 	$data_tutor = $this->lgn->cek_data('tentang_tutor', ['id_tutor' => $_SESSION['id']])->row_array();
	// 	if ($data_tutor !== NULL) {
	// 		redirect('/dashboard');
	// 	} else {
	// 		$this->load->view('tutor/index');
	// 	}
	// }

	// public function test()
	// {
	// 	$data['content'] = 'admin/pages/dashboard';
	// 	$this->load->view('admin/layouts/master', $data);
	// }
}
