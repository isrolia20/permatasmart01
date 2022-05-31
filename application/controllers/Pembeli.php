<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembeli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('pembeli/DashPembeli_model', 'dpm');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $this->form_validation->set_rules('cari', 'Cari', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        if ($this->input->post('cari')) {
            $data['title'] = 'Home';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['data_banner'] = $this->dpm->data_banner();
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
            $data['data_produk'] = $this->dpm->getBaseSearch($this->input->post('cari'), $config['per_page'], $data['start']);
            // echo "<pre>";
            // print_r($data['data_produk']);
            // die;
            // echo "</pre>";
            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/index', $data);
            $this->load->view('templates/pembeli/footer', $data);
        } else {
            $data['title'] = 'Home';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['data_banner'] = $this->dpm->data_banner();
            // $data['data_product'] = $this->dpm->data_barang();

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

            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/index', $data);
            $this->load->view('templates/pembeli/footer', $data);
        }
    }

    // fungsi membuat kode pemesanan sesuai tanggal
    public function kodeDataTanaman()
    {
        $tahun = date('Y');
        $date = date('d/m/');
        $this->db->like('kode', $date);
        $this->db->like('kode', $tahun);
        $this->db->select('RIGHT(transaksi.kode,2) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('transaksi');  //cek dulu apakah ada sudah ada kode di tabel.
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = $date . $tahun . ' -ELC- ' . $batas;  //format kode
        // echo '<pre>';
        // print_r($kodetampil);
        // die;
        // echo '</pre>';
        return $kodetampil;
    }


    public function add_cart($id)
    {
        $cart = $this->dpm->data_cart($id);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = [
            'id' => $cart->id,
            'kode' => $cart->kode,
            'qty' => $this->input->post('stok'),
            'price' => $cart->harga,
            'name' => $cart->name,
            'image' => $cart->image,
            'penjual_id' => $cart->user_id,
            'pembeli_id' => $data['user']['id'],
            'pembeli_email' => $data['user']['email'],
            'requiredpembeli_name' => $data['user']['name'],
            'pembeli_telp' => $data['user']['no_telp'],
        ];

        // echo '<pre>';
        // print_r($cart->stok);
        // echo '</pre>';
        // die;

        $insertmin = array(
            'barang_id' => $cart->id,
            'name' => $cart->name,
            'stok' => $this->input->post('stok'),
        );

        if ($cart->stok < $data['qty']) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                    Pemesanan anda melebihi stok tersedia !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
            );
            redirect('Pembeli');
        } else {
            $query = $this->cart->insert($data);
            if ($query) {
                $query1 = $this->db->insert('barang_keluar', $insertmin);
                if ($query1) {
                    $query2 = $this->db->get_where('barang_keluar', ['barang_id' => $insertmin['barang_id']])->row_array();
                    $this->db->where('id', $query2['id']);
                    $this->db->delete('barang_keluar', $insertmin);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                            Produk gagal bertambah !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>'
                    );
                    redirect('Pembeli');
                }
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                        Produk berhasil dikeranjang !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                );
                redirect('Pembeli');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Produk gagal dikeranjang !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                );
                redirect('Pembeli');
            }
        }
    }

    public function detail_cart()
    {
        $data['title'] = "Detail Keranjang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_banner'] = $this->dpm->data_banner();
        $data['kode'] = $this->kodeDataTanaman();

        $this->load->view('templates/pembeli/header', $data);
        $this->load->view('templates/pembeli/navbar', $data);
        $this->load->view('pembeli/keranjang', $data);
        $this->load->view('templates/pembeli/footer', $data);
    }

    public function delete_cart()
    {
        $rowid = $this->input->post('rowid');
        $this->cart->remove($rowid);

        $data = [
            'barang_id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'stok' => $this->input->post('qty'),
        ];
        $query = $this->db->insert('barang_masuk', $data);
        if ($query) {
            $query1 = $this->db->get_where('barang_masuk', ['barang_id' => $data['barang_id']])->row_array();
            $this->db->where('id', $query1['id']);
            $this->db->delete('barang_masuk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk keranjang dihapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('Pembeli');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk keranjang gagal dihapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('Pembeli');
        }
    }

    public function checkout()
    {
        $data['title'] = 'Checkout';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_banner'] = $this->dpm->data_banner();
        $data['data_checkout'] = $this->dpm->data_checkout();

        // echo '<pre>';
        // print_r($data['data_checkout']);
        // die;
        // echo '</pre>';

        $data['kode'] = $this->kodeDataTanaman();

        $this->form_validation->set_rules('kode', 'Kode', 'required|trim');
        $this->form_validation->set_rules('pembeli_email', 'Email', 'required|trim');
        $this->form_validation->set_rules('pembeli_name', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/checkout', $data);
            $this->load->view('templates/pembeli/footer', $data);
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'pembeli_id' => $this->input->post('pembeli_id'),
                'pembeli_email' => $this->input->post('pembeli_email'),
                'pembeli_name' => $this->input->post('pembeli_name'),
                'total_transaksi' => preg_replace('/,.*|[^0-9]/', '', $this->input->post('total')),
            ];
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';
            $query = $this->db->insert('transaksi', $data);
            $transaksi_id = $this->db->insert_id();
            if ($query) {
                $id = $this->input->post('id');
                $name = $this->input->post('name');
                $price = $this->input->post('price');
                $qty = $this->input->post('qty');
                $seller_id = $this->input->post('penjual_id');
                $image = $this->input->post('image');
                for ($i = 0; $i < count($id); $i++) {
                    $data = [
                        'transaksi_id' => $transaksi_id,
                        'barang_id' => $id[$i],
                        'name' => $name[$i],
                        'harga' => $price[$i],
                        'stok' => $qty[$i],
                        'image' => $image[$i],
                        'penjual_id' => $seller_id[$i],
                    ];
                    $query1 = $this->db->insert('detail_transaksi', $data);
                    $this->cart->destroy();
                }
                if ($query1) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil checkout
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Pembeli/checkout');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal checkout
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Pembeli/checkout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal dicheckout
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Pembeli/checkout');
            }
        }
    }


    public function detail_transaksi($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_banner'] = $this->dpm->data_banner();
        $data['data_detail'] = $this->dpm->detail_trans($id);

        $this->load->view('templates/pembeli/header', $data);
        $this->load->view('templates/pembeli/navbar', $data);
        $this->load->view('pembeli/detail_transaksi', $data);
        $this->load->view('templates/pembeli/footer', $data);
    }


    public function bayar()
    {
        $this->form_validation->set_rules('pembeli_name', 'Name', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('pembeli_email', 'Email', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('pembeli_bank', 'Bank', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('pembeli_rekening', 'Rekening', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('pembeli_telp', 'Telepon', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Upload Bukti', 'required', [
                'required' => '*%s tidak boleh kosong',
            ]);
        }

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Bayar';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['data_banner'] = $this->dpm->data_banner();
            $data['penjual'] = $this->dpm->seller_only($this->input->post('penjual_id'));
            $data['detail'] = $this->dpm->per_trans($this->input->post('id'));

            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/bayar', $data);
            $this->load->view('templates/pembeli/footer', $data);
        } else {
            $where = $this->input->post('id');
            $total = $this->input->post('total');
            $tb['detail_transaksi'] = $this->db->get_where('detail_transaksi', ['id_detail' => $this->input->post('id_detail')])->row_array();

            $data = [
                'total' => preg_replace('/,.*|[^0-9]/', '', $total),
                'status' => 1,
                'tanggal_detail' => date('Y-m-d H:i:s'),
            ];


            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/user/img/bayar/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '100000';  //100MB max
                $config['max_width'] = '10000'; // pixel
                $config['max_height'] = '10000'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['detail_transaksi']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/user/img/bayar/' . $old_image);
                    }
                    //get gambar yang baru
                    $data = [
                        'total' => preg_replace('/,.*|[^0-9]/', '', $total),
                        'status' => 1,
                        'tanggal_detail' => date('Y-m-d H:i:s'),
                        'image_bayar' => $this->upload->data('file_name'),
                    ];
                    $this->db->where('id_detail', $this->input->post('id_detail'));
                    $query = $this->db->update('detail_transaksi', $data);

                    if ($query) {
                        $data = [
                            'pembeli_bank' => $this->input->post('pembeli_bank'),
                            'pembeli_rekening' => $this->input->post('pembeli_rekening'),
                            'pembeli_telp' => $this->input->post('pembeli_telp'),
                            'penjual_id' => $this->input->post('penjual_id'),
                            'penjual_name' => $this->input->post('penjual_name'),
                            'penjual_bank' => $this->input->post('penjual_bank'),
                            'penjual_rekening' => $this->input->post('penjual_rekening'),
                            'penjual_telp' => $this->input->post('penjual_telp'),
                            'status' => 1,
                            'tanggal_transaksi' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->where('id', $where);
                        $this->db->update('transaksi', $data);

                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success" role="alert">
                            Pesanan Dikonfirmasi !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>'
                        );
                        redirect('Pembeli/checkout');
                    } else {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger" role="alert">
                            Konfirmasi Gagal !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>'
                        );
                        redirect('Pembeli/checkout');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2MB dan dimensi 700 x 700 pixels
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Pembeli/checkout');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';

            $this->db->where('id_detail', $this->input->post('id_detail'));
            $query1 = $this->db->update('detail_transaksi', $data);



            if ($query1) {
                $data = [
                    'pembeli_bank' => $this->input->post('pembeli_bank'),
                    'pembeli_rekening' => $this->input->post('pembeli_rekening'),
                    'pembeli_telp' => $this->input->post('pembeli_telp'),
                    'penjual_id' => $this->input->post('penjual_id'),
                    'penjual_name' => $this->input->post('penjual_name'),
                    'penjual_bank' => $this->input->post('penjual_bank'),
                    'penjual_rekening' => $this->input->post('penjual_rekening'),
                    'penjual_telp' => $this->input->post('penjual_telp'),
                    'status' => 1,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'),
                ];
                $this->db->where('id', $where);
                $this->db->update('transaksi', $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data berhasil di isi namun bukti belum di upload !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Pembeli/checkout');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Gagal di upload !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Pembeli/checkout');
            }
        }
    }

    public function batal_transaksi()
    {

        // $query = $this->db->get_where('detail_transaksi', ['transaksi_id' => $this->input->post('id')])->row_array();

        // $data = [
        //     'product_id' => $brg['product_id'],
        //     'name' => $brg['nama'],
        //     'jumlah' => $brg['jumlah'],
        // ];

        // echo '<pre>';
        // print_r($brg);
        // die;
        // echo '</pre>';

        // if ($query1) {
        // $this->db->where('product_id', $brg['product_id']);
        // $query2 = $this->db->delete('barang_masuk', $brg);

        $brg = $this->dpm->system_batal($this->input->post('id'));
        $query1 = $this->db->insert_batch('barang_masuk', $brg);

        if ($query1) {
            $this->db->empty_table('barang_masuk');
            $this->db->where('transaksi_id', $this->input->post('id'));
            $query2 = $this->db->delete('detail_transaksi');
            if ($query2) {
                $this->db->where('id', $this->input->post('id'));
                $query3 = $this->db->delete('transaksi');
                if ($query3) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk sukses batal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Pembeli/checkout');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal batal
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    redirect('Pembeli/checkout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal batal (main)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                redirect('Pembeli/checkout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal batal (detail)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Pembeli/checkout');
        }
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal batal (brg-msk)
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //     </button>
        //     </div>');
        //     redirect('Buyer/checkout');
        // }

        // echo '<pre>';
        // print_r($query);
        // die;
        // echo '</pre>';
    }


























    public function my_profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_banner'] = $this->dpm->data_banner();
        $this->load->view('templates/pembeli/header', $data);
        $this->load->view('templates/pembeli/navbar', $data);
        $this->load->view('pembeli/my_profile', $data);
        $this->load->view('templates/pembeli/footer', $data);
    }

    public function edit_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['data_banner'] = $this->dpm->data_banner();
            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/edit_profile', $data);
            $this->load->view('templates/pembeli/footer', $data);
        } else {
            $where = $this->input->post('email');
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/user/img/profile/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '500'; // pixel
                $config['max_height'] = '500'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/user/img/profile/' . $old_image);
                    }

                    //dengan foto
                    $data = [
                        'name' => $this->input->post('name'),
                        'no_telp' => $this->input->post('no_telp'),
                        //get gambar yang baru
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dpm->update_user_pembeli($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Profile berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Pembeli/edit_profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 500px x 500px
                    <button type="button" class="close" data-dismiss="alert"   aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Pembeli/edit_profile');
                }
            }

            //tanpa foto
            $data = [
                'name' => $this->input->post('name'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->dpm->update_user_pembeli($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Profile anda sudah terupdate !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Pembeli/edit_profile');
        }
    }
    public function change_password()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_banner'] = $this->dpm->data_banner();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|min_length[6]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
        ]);
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
            'matches' => '%s tidak sama dengan Confirm New Password!',
        ]);
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
            'matches' => '%s tidak sama dengan New Password !',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pembeli/header', $data);
            $this->load->view('templates/pembeli/navbar', $data);
            $this->load->view('pembeli/change_password', $data);
            $this->load->view('templates/pembeli/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Current Password Salah !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                );
                redirect('Pembeli/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New Password tidak boleh sama dengan Current Password ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Pembeli/change_password');
                } else {
                    //password bener
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ubah password berhasil ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Pembeli/change_password');
                }
            }
        }
    }
}
