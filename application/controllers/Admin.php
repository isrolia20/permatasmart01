<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('admin/DashAdmin_model', 'dam');
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
            $data['title'] = 'Dashboard Admin';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['transaksi'] = $this->dam->getPendapatan();
            $data['transaction'] = $this->dam->getRangeDate($date1, $date2);
            $data['countTrans'] = $this->dam->getCountPendapatan();

            // echo "<pre>";
            // print_r($data['transaction']);
            // echo "</pre>";
            // die;

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $data['title'] = 'Dashboard Admin';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['transaksi'] = $this->dam->getPendapatan();
            $data['transaction'] = $this->dam->transaction();
            $data['countTrans'] = $this->dam->getCountPendapatan();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/admin/footer', $data);
        }
    }

    //Data Users
    public function kelola_user()
    {
        $data['title'] = 'Kelola User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_users'] = $this->dam->data_user();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/admin/footer', $data);
    }
    public function inactive_data_user()
    {
        $where =  $this->input->get('id');
        $data = [
            'is_active' => 0,
        ];
        $this->dam->status_user($where, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Inactive Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/kelola_user');
    }
    public function active_data_user()
    {
        $where =  $this->input->get('id');
        $data = [
            'is_active' => 1,
        ];
        $this->dam->status_user($where, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aktivasi Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/kelola_user');
    }
    public function delete_data_user() //DELETE USER STILL COMPLEX ALGORITHM
    {
        $where =  $this->input->get('id');
        $tb['user'] = $this->db->get_where('user', ['id' => $this->input->get('id')])->row_array();

        //get gambar yang lama
        if ($tb['user']['role_id'] == 2) {
            $old_image = $tb['user']['image'];
            if ($old_image != 'default.png') {
                @unlink(FCPATH . 'assets/admin/img/profile/' . $old_image);
            }
        } else {
            $old_image = $tb['user']['image'];
            if ($old_image != 'default.png') {
                @unlink(FCPATH . 'assets/user/img/profile/' . $old_image);
            }
        }

        $this->dam->delete_user($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/kelola_user');
    }



    //Data Banner
    public function kelola_banner()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Banner';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['data_banner'] = $this->dam->data_banner();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_banner', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/banner/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '7000'; // pixel
                $config['max_height'] = '7000'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang baru
                    $data = [
                        'name' => $this->input->post('nama'),
                        'descript' => $this->input->post('deskripsi'),
                        'urutan' => $this->input->post('urutan'),
                        'image' => $this->upload->data('file_name'),
                    ];
                    $this->dam->insert_data_banner($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Banner berhasil ditambahkan !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/kelola_banner');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2 MB
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/kelola_banner');
                }
            }

            $data = [
                'name' => $this->input->post('nama'),
                'descript' => $this->input->post('deskripsi'),
                'urutan' => $this->input->post('urutan'),
            ];

            $this->dam->insert_data_banner($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Banner berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/kelola_banner');
        }
    }
    public function update_data_banner()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Banner';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['data_banner'] = $this->dam->data_banner();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_banner', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $where = $this->input->post('id');
            $tb['data_bann'] = $this->db->get_where('data_banner', ['id' => $this->input->post('id')])->row_array();

            $data = [
                'name' => $this->input->post('nama'),
                'descript' => $this->input->post('deskripsi'),
                'urutan' => $this->input->post('urutan'),
            ];

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/banner/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '7000'; // pixel
                $config['max_height'] = '7000'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['data_bann']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/banner/' . $old_image);
                    }
                    //get gambar yang baru

                    $data = [
                        'name' => $this->input->post('nama'),
                        'descript' => $this->input->post('deskripsi'),
                        'urutan' => $this->input->post('urutan'),
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dam->update_data_banner($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Banner berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/kelola_banner');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2MB
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/kelola_banner');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';


            $this->dam->update_data_banner($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Banner berhasil diedit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/kelola_banner');
        }
    }
    public function delete_data_banner()
    {
        $where = $this->input->post('id');
        $tb['data_bann'] = $this->db->get_where('data_banner', ['id' => $this->input->post('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['data_bann']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . 'assets/admin/img/banner/' . $old_image);
        }

        $this->dam->delete_data_banner($where);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Banner berhasil diedit !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>'
        );
        redirect('Admin/kelola_banner');
    }

    public function riwayat_transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //tampilkan data tanaman sesuai user
        $data['riwayat_penjualan'] = $this->dam->riwayat_penjualan();
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/riwayat_penjualan', $data);
        $this->load->view('templates/admin/footer', $data);
    }





























    public function my_profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/my_profile', $data);
        $this->load->view('templates/admin/footer', $data);
    }
    public function edit_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('templates/admin/footer', $data);
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
                    $this->dam->update_profile($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Profile berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/edit_profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 500px x 500px
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/edit_profile');
                }
            }

            //tanpa foto
            $data = [
                'name' => $this->input->post('name'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->dam->update_profile($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Profile anda sudah terupdate !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
            );
            redirect('Admin/edit_profile');
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
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/change_password', $data);
            $this->load->view('templates/admin/footer', $data);
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
                redirect('Admin/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New Password tidak boleh sama dengan Current Password ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/change_password');
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
                    redirect('Admin/change_password');
                }
            }
        }
    }
}
