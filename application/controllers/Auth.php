<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            //astagfirullah ternyata bisa digunain pas pakek form 403 Access Forbidden kodingan kek gini :(
            if ($this->session->userdata('role_id') == 1) {
                redirect('Admin');
            } elseif ($this->session->userdata('role_id') == 2) {
                redirect('Penjual');
            } elseif ($this->session->userdata('role_id') == 3) {
                redirect('Pembeli');
            }
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/auth/footer', $data);
        } else {
            $this->_login();
        }
    }



    //fungsi login
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // echo '<pre>';
        // print_r($user);
        // die;
        // echo '</pre>';

        //jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek passwordnya
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('Penjual');
                    } else {
                        redirect('Pembeli');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        Password salah !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Email belum diaktifkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                Email belum terdaftar !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Auth');
        }
    }



    public function registration()
    {
        // ========================================
        if ($this->session->userdata('email')) {
            //astagfirullah ternyata bisa digunain pas pakek form 403 Access Forbidden kodingan kek gini :(
            if ($this->session->userdata('role_id') == 1) {
                redirect('Admin');
            } elseif ($this->session->userdata('role_id') == 2) {
                redirect('Penjual');
            } elseif ($this->session->userdata('role_id') == 3) {
                redirect('Pembeli');
            }
        }
        // ========================================

        if ($this->input->post('role_id') == 2) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
                'is_unique' => '%s sudah didaftarkan',
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
            $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|min_length[6]|matches[password1]');
            $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim|min_length[10]|max_length[14]|numeric');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
            $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Registrasi';
                $data['role_id'] = $this->db->get('user_role')->result_array();
                $this->load->view('templates/auth/header', $data);
                $this->load->view('auth/registrasi', $data);
                $this->load->view('templates/auth/footer', $data);
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => 'default.png',
                    'password' => password_hash(htmlspecialchars($this->input->post('password1')), PASSWORD_DEFAULT),
                    'no_telp' => htmlspecialchars('62' . $this->input->post('no_telp')),
                    'alamat' => htmlspecialchars($this->input->post('alamat')),
                    'role_id' => htmlspecialchars($this->input->post('role_id')),
                    'is_active' => 1,
                    'date_created' => time(),
                    'no_rekening' => htmlspecialchars($this->input->post('no_rekening')),
                    'nama_bank' => htmlspecialchars($this->input->post('nama_bank')),
                ];
                $true = $this->db->insert('user', $data);

                // siapkan tokenisasi

                // $token = base64_encode(random_bytes(32));
                // $user_token = [
                //     'email' => $email,
                //     'token' => $token,
                //     'date_created' => time(),
                // ];
                // $true = $this->db->insert('user', $data);
                // $this->db->insert('user_token', $user_token);


                // $this->_sendEmail($token, 'verify');

                if ($true == true) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success mx-5" role="alert">
                    Akun anda sudah terdaftar!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                    );
                    redirect('Auth');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mx-5" role="alert">
                    Maaf Akun anda gagal didaftarkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                    );
                    redirect('Auth');
                }
            }
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
                'is_unique' => '%s sudah didaftarkan',
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
            $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|min_length[6]|matches[password1]');
            $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim|min_length[10]|max_length[14]|numeric');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Registrasi';
                $data['role_id'] = $this->db->get('user_role')->result_array();
                $this->load->view('templates/auth/header', $data);
                $this->load->view('auth/registrasi', $data);
                $this->load->view('templates/auth/footer', $data);
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => 'default.png',
                    'password' => password_hash(htmlspecialchars($this->input->post('password1')), PASSWORD_DEFAULT),
                    'no_telp' => htmlspecialchars('62' . $this->input->post('no_telp')),
                    'alamat' => htmlspecialchars($this->input->post('alamat')),
                    'role_id' => htmlspecialchars($this->input->post('role_id')),
                    'is_active' => 1,
                    'date_created' => time(),
                    'no_rekening' => htmlspecialchars($this->input->post('no_rekening')),
                    'nama_bank' => htmlspecialchars($this->input->post('nama_bank')),
                ];
                $true = $this->db->insert('user', $data);

                // siapkan tokenisasi

                // $token = base64_encode(random_bytes(32));
                // $user_token = [
                //     'email' => $email,
                //     'token' => $token,
                //     'date_created' => time(),
                // ];
                // $true = $this->db->insert('user', $data);
                // $this->db->insert('user_token', $user_token);


                // $this->_sendEmail($token, 'verify');

                if ($true == true) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success mx-5" role="alert">
                    Akun anda sudah terdaftar!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                    );
                    redirect('Auth');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mx-5" role="alert">
                    Maaf Akun anda gagal didaftarkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                    );
                    redirect('Auth');
                }
            }
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'aglonema.company@gmail.com',
            'smtp_pass' => '12345678abcde',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);

        $this->email->initialize($config);
        $this->email->from('aglonema.company@gmail.com', 'Aglonema Company');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk verifikasi akun anda : <a href="' . base_url() . 'Auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan akun anda sekarang sebelum 24 jam</a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link berikut untuk reset password : <a href="' . base_url() . 'Auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset sekarang password anda sebelum 24 jam</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }





    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' Akun anda telah aktif<br>Mohon login!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                    </div>');
                    redirect('Auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token aktivasi anda telah kadaluarsa!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                    </div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token aktivasi anda tidak valid!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, Email salah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>        
            </div>');
            redirect('Auth');
        }
    }






    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s Tidak valid karena tidak sesuai format email !',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth/auth_footer', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time(),
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tolong check email anda untuk me-reset password!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
                redirect('Auth/forgot_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar atau belum teraktivasi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
                redirect('Auth/forgot_password');
            }
        }
    }





    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_userdata('reset_email', $email);
                $this->change_password();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal, Token anda salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal, Email anda salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
            redirect('Auth');
        }
    }





    public function change_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('Auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', [
            'required' => '%s tidak boleh kosong',
            'matches' => '%s tidak sama dengan Konfirm Password !',
            'min_length' => '%s singkat minimal 6 karakter !',
        ]);
        $this->form_validation->set_rules('password2', 'Konfirm Password', 'trim|required|min_length[6]|matches[password1]', [
            'required' => '%s tidak boleh kosong',
            'matches' => '%s tidak sama dengan Password !',
            'min_length' => '%s singkat minimal 6 karakter !',
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth/auth_header', $data);
            $this->load->view('auth/change_password');
            $this->load->view('templates/auth/auth_footer', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah berhasil diganti, Mohon login!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                </div>');
            redirect('Auth');
        }
    }


    //untuk logout
    public function logout()
    {
        // $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success mx-4" role="alert">
            Berhasil logout!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>'
        );
        redirect('Auth');
    }
}
