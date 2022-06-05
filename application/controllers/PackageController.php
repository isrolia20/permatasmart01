<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PackageController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Package', 'model_data');
		// if ($this->session->userdata('success') != TRUE) {
		//     redirect(base_url());
		// }
	}


	public function index()
	{
		$data['title'] = "Paket";
		$data['data_paket'] = $this->model_data->get_data_packages();
		$data['content'] = 'admin/pages/_package';
		$this->load->view('admin/layouts/master', $data);
	}

	// function get_data_user()
	// {
	// 	$data['title'] = "Paket";
	// 	$data['data_paket'] = $this->model_data->get_data_packages();
	// 	// $data['content'] = 'admin/pages/_package';
	// 	$this->load->view('admin/layouts/header');
	// 	$this->load->view('admin/layouts/sidebar');
	// 	$this->load->view('admin/pages/_package', $data);
	// 	$this->load->view('admin/layouts/footer');
	// }

	public function add()
	{
		$admin_id = $this->session->userdata('admin_id');
		// var_dump($admin_id);
		// die;
		// $this->_validate();
		$data = array(
			'id' => $this->input->post('id'),
			'admin_id' => $admin_id,
			'name' => $this->input->post('name'),
			'slug' => url_title($this->input->post('name'), 'dash', true),
			'price' => $this->input->post('price'),
			'description' => $this->input->post('description'),
			'duration' => $this->input->post('duration'),
			'level' => $this->input->post('level'),
		);
		$insert = $this->model_data->add($data);
		if ($insert) {
			$this->session->set_flashdata('message', 'Sukses terinput');
			redirect('/admin/package');
		} else {
			$this->session->set_flashdata('message', 'Gagal terinput');
			redirect('/admin/package');
		}

		// echo json_encode(array("status" => TRUE));
	}
	// public function get_id($id)
	// {
	// 	$data = $this->model_data->get_id($id);
	// 	echo json_encode($data);
	// }

	public function update()
	{
		$id = $this->input->post('id');
		$admin_id = $this->session->userdata('admin_id');
		// $this->_validate();
		$data = array(
			'name' => $this->input->post('name'),
			'admin_id' => $admin_id,
			'slug' => url_title($this->input->post('name'), 'dash', true),
			'price' => $this->input->post('price'),
			'description' => $this->input->post('description'),
			'duration' => $this->input->post('duration'),
			'level' => $this->input->post('level'),
		);
		$update = $this->model_data->update(array('id' => $id), $data);
		if ($update) {
			$this->session->set_flashdata('message', 'Sukses terupdate');
			redirect('/admin/package');
		} else {
			$this->session->set_flashdata('message', 'Gagal terupdate');
			redirect('/admin/package');
		}
		// echo json_encode(array("status" => TRUE));
	}
	public function delete($id = 0)
	{
		$id = $this->input->post('id');
		$delete = $this->model_data->delete($id);
		if ($delete) {
			$this->session->set_flashdata('message', 'Sukses terhapus');
			redirect('/admin/package');
		} else {
			$this->session->set_flashdata('message', 'Gagal terhapus');
			redirect('/admin/package');
		}
	}

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

/* End of file PackageController.php */
