<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('penjual/DashPenjual_model', 'dpj');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $date1 = "";
        $date2 = "";
        if ($this->input->post('start_date') && $this->input->post('end_date') != NULL) {
            $date1 = $this->input->post('start_date');
            $date2 = $this->input->post('end_date');
            $this->session->set_userdata(array("start_date" => $date1));
            $this->session->set_userdata(array("end_date" => $date2));
        } else {
            if ($this->session->userdata('start_date') && $this->session->userdata('end_date') != NULL) {
                $date1 = $this->session->userdata('start_date');
                $date2 = $this->session->userdata('end_date');
            }
        }

        $data['from'] = $date1;
        $data['to'] = $date2;

        $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        if ($this->input->post('start_date') && $this->input->post('end_date')) {
            $data['title'] = 'Dashboard Penjual';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pendapatan'] = $this->dpj->getPendapatan($data['user']['id']);
            $data['transaksi'] = $this->dpj->getCountPendapatan($data['user']['id']);
            $data['grafik'] = $this->dpj->getRangeDate($date1, $date2, $data['user']['id']);
            // echo '<pre>';
            // print_r($data['transaksi']);
            // echo '</pre>';
            // die;
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/index', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $data['title'] = 'Dashboard Tutor';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pendapatan'] = $this->dpj->getPendapatan($data['user']['id']);
            $data['transaksi'] = $this->dpj->getCountPendapatan($data['user']['id']);
            $data['grafik'] = $this->dpj->transaction($data['user']['id']);
            // echo '<pre>';
            // print_r($data['transaksi']);
            // echo '</pre>';
            // die;
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/index', $data);
            $this->load->view('templates/penjual/footer', $data);
        }
    }

    // fungsi membuat kode pemesanan sesuai tanggal
    public function kodeDataTanaman()
    {
        $tahun = date('Y');
        $date = date('d/m/');
        $this->db->like('kode', $date);
        $this->db->like('kode', $tahun);
        $this->db->select('RIGHT(barang.kode,2) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('barang');  //cek dulu apakah ada sudah ada kode di tabel.
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = $date . $tahun . ' -BG- ' . $batas;  //format kode
        // echo '<pre>';
        // print_r($kodetampil);
        // die;
        // echo '</pre>';
        return $kodetampil;
    }

    public function kelola_produk()
    {
        $this->form_validation->set_rules('kode', 'Kode', 'required|trim|is_unique[barang.kode]', [
            'is_unique' => '%s sudah ada'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kelola Bimbel';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['getJenis'] = $this->dpj->get_jenis();
            $data['kode'] = $this->kodeDataTanaman();

            //tampilkan barang sesuai user
            $data['barang'] = $this->dpj->data_barang($data['user']['id']);
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/barang', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/barang/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '1024'; // pixel
                $config['max_height'] = '1024'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang baru
                    $data = [
                        'kode' => $this->input->post('kode'),
                        'name' => $this->input->post('nama'),
                        'image' => $this->upload->data('file_name'),
                        'jenis' => $this->input->post('jenis'),
                        'stok' => $this->input->post('stok'),
                        'harga' => $this->input->post('harga'),
                        'user_id' => $this->session->userdata('id'),
                    ];
                    $this->dpj->insert_barang($data);
                    $this->db->insert('jenis', ['name' => $this->input->post('jenis')]);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                          Barang berhasil ditambahkan !
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                      </div>'
                    );
                    redirect('Penjual/kelola_produk');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                      Ukuran melebihi batas. Maksimal 1000px x 1000px
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>');
                    redirect('Penjual/kelola_produk');
                }
            }

            $data = [
                'kode' => $this->input->post('kode'),
                'name' => $this->input->post('nama'),
                'jenis' => $this->input->post('jenis'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
                'user_id' => $this->session->userdata('id'),
            ];

            $this->dpj->insert_barang($data);
            $this->db->insert('jenis', ['name' => $this->input->post('jenis')]);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                  Barang berhasil ditambahkan !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>'
            );
            redirect('Penjual/kelola_produk');
        }
    }


    public function update_produk()
    {

        $this->form_validation->set_rules('kode', 'Kode', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');



        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kelola Produk';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['getJenis'] = $this->dpj->get_jenis();
            $data['kode'] = $this->kodeDataTanaman();

            //tampilkan barang sesuai user
            $data['barang'] = $this->dpj->data_barang($data['user']['id']);
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/barang', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $where = $this->input->post('id');
            $tb['barang'] = $this->db->get_where('barang', ['id' => $this->input->post('id')])->row_array();

            $data = [
                'kode' => $this->input->post('kode'),
                'name' => $this->input->post('nama'),
                'jenis' => $this->input->post('jenis'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
                'user_id' => $this->session->userdata('id'),
            ];

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/barang/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '1024'; // pixel
                $config['max_height'] = '1024'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['barang']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/barang/' . $old_image);
                    }
                    //get gambar yang baru

                    $data = [
                        'kode' => $this->input->post('kode'),
                        'name' => $this->input->post('nama'),
                        'jenis' => $this->input->post('jenis'),
                        'stok' => $this->input->post('stok'),
                        'harga' => $this->input->post('harga'),
                        'user_id' => $this->session->userdata('id'),
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dpj->update_barang($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                         Barang berhasil diedit !
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                     </div>'
                    );
                    redirect('Penjual/kelola_produk');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Ukuran melebihi batas. Maksimal 1000x x 1000px
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>');
                    redirect('Penjual/kelola_produk');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';


            $this->dpj->update_barang($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                 Barang berhasil diedit !
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>'
            );
            redirect('Penjual/kelola_produk');
        }
    }

    public function delete_produk()
    {
        $where = $this->input->get('id');
        $tb['barang'] = $this->db->get_where('barang', ['id' => $this->input->get('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['barang']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . 'assets/admin/img/barang/' . $old_image);
        }

        $result = $this->db->delete('barang', ['id' => $where]);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil dihapus
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>');
            redirect('Penjual/kelola_produk');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Barang gagal dihapus
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>');
            redirect('Penjual/kelola_produk');
        }
    }

    //Riwayat Penjualan
    public function riwayat_penjualan()
    {

        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Riwayat Transaksi';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            //tampilkan data tanaman sesuai user
            $data['riwayat_penjualan'] = $this->dpj->riwayat_penjualan($data['user']['id']);
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/riwayat_penjualan', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $detail = $this->db->get_where('detail_transaksi', ['id_detail' => $this->input->post('id')])->row_array();
            $data = [
                'status' => 2,
            ];
            $this->db->where('id_detail', $detail['id_detail']);
            $query = $this->db->update('detail_transaksi', $data);
            if ($query) {
                $this->db->where('id', $detail['transaksi_id']);
                $query1 = $this->db->update('transaksi', $data);
                if ($query1) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dikonfirmasi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('Penjual/riwayat_penjualan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal dikonfirmasi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('Penjual/riwayat_penjualan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal dikonfirmasi detail
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                redirect('Penjual/riwayat_penjualan');
            }
        }
    }

    public function cancel_trans()
    {
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Riwayat Penjualan';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            //tampilkan data tanaman sesuai user
            $data['riwayat_penjualan'] = $this->dpj->riwayat_penjualan($data['user']['id']);
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/riwayat_penjualan', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $detail = $this->db->get_where('detail_transaksi', ['id_detail' => $this->input->post('id')])->row_array();
            $data = [
                'status' => 3,
            ];
            $this->db->where('id_detail', $detail['id_detail']);
            $query = $this->db->update('detail_transaksi', $data);
            if ($query) {
                $this->db->where('id', $detail['transaksi_id']);
                $query1 = $this->db->update('transaksi', $data);
                if ($query1) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dibatalin
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('Penjual/riwayat_penjualan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal dibatalin
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('Penjual/riwayat_penjualan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk gagal dibatalin detail
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                redirect('Penjual/riwayat_penjualan');
            }
        }
    }

    //Profile
    public function my_profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/penjual/header', $data);
        $this->load->view('templates/penjual/sidebar', $data);
        $this->load->view('templates/penjual/navbar', $data);
        $this->load->view('penjual/my_profile', $data);
        $this->load->view('templates/penjual/footer', $data);
    }
    public function edit_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim|min_length[10]|max_length[14]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/edit_profile', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $where = $this->input->post('email');
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/profile/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '500'; // pixel
                $config['max_height'] = '500'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/profile/' . $old_image);
                    }

                    //dengan foto
                    $data = [
                        'name' => $this->input->post('name'),
                        'no_telp' => $this->input->post('no_telp'),
                        //get gambar yang baru
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dpj->update_user_seller($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Profile berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Penjual/edit_profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 500px x 500px
                    <button type="button" class="close" data-dismiss="alert"   aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Penjual/edit_profile');
                }
            }

            //tanpa foto
            $data = [
                'name' => $this->input->post('name'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->dpj->update_user_seller($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Profile anda sudah terupdate !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Penjual/edit_profile');
        }
    }
    public function change_password()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/change_password', $data);
            $this->load->view('templates/penjual/footer', $data);
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
                redirect('Penjual/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New Password tidak boleh sama dengan Current Password ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Penjual/change_password');
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
                    redirect('Penjual/change_password');
                }
            }
        }
    }
}
