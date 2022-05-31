<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landingpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin');
            } elseif ($this->session->userdata('role_id') == 2) {
                redirect('penjual');
            } elseif ($this->session->userdata('role_id') == 3) {
                redirect('pembeli');
            }
        }
        $this->load->model('pembeli/DashPembeli_model', 'dpm');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['data_banner'] = $this->dpm->data_banner();
        $data['data_product'] = $this->dpm->data_barang();

        //config
        $config['base_url'] = 'http://localhost/konter/Pembeli/index';
        $config['total_rows'] = $this->dpm->countAllProduk();
        $config['per_page'] = 8;

        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        //initilize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['data_produk'] = $this->dpm->getProduk($config['per_page'], $data['start']);

        $this->load->view('templates/landingpage/header', $data);
        $this->load->view('templates/landingpage/navbar', $data);
        $this->load->view('landingpage/index', $data);
        $this->load->view('templates/landingpage/footer', $data);
    }
}
