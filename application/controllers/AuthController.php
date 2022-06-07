<?php
class AuthController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('role') == 'admin') redirect('/');
		$this->load->model('Auth', 'auth');
		$this->form_validation->set_message('required', '{field} harap diisi terlebih dahulu.');
	}

	public function index()
	{

		if ($this->session->userdata('email')) {
			return redirect('/');
		}

		$this->load->view('auth/pages/login');
	}

	public function loginAdmin()
	{

		if ($this->session->userdata('email')) {
			return redirect('/');
		}
		$this->load->view('auth/pages/login_admin');
	}

	public function registerStudent()
	{

		if ($this->session->userdata('email')) {
			return redirect('/');
		}
		$this->load->view('auth/pages/register_siswa');
	}

	public function registerTutor()
	{

		if ($this->session->userdata('email')) {
			return redirect('/');
		}
		$this->load->view('auth/pages/register_tutor');
	}

	public function save_tutor()
	{
		$user = array(
			'email'  => $this->input->post('email'),
			'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
			// 'avatar' => $_FILES['avatar']['name'],
			'is_active' => 'active',
			'role' => 'tutor',
		);



		$email = $this->auth->authTutor(['email' => $this->input->post('email')])->num_rows();

		if ($email < 1) {
			$insertUser = $this->auth->saveUser($user);

			// $tutor = $this->wlc->save_tutor($additional_data);
			// if (!$this->upload->do_upload('foto_profil')) {
			// 	echo $this->upload->display_errors();
			// 	die();
			// } else {
			// 	redirect('/login');
			// }
			// cek jika ada file
			$upload_image = $_FILES['file_pdf']['name'];
			if ($upload_image) {
				$config['upload_path'] = './upload/file_pdf';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '2048';  //2MB max
				$config['max_width'] = '7000'; // pixel
				$config['max_height'] = '7000'; // pixel

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_pdf')) {
					//get file yang baru
					$additional_data = array(
						'user_id' => $insertUser,
						'name' => $this->input->post('name', true),
						'address' => $this->input->post('address', true),
						'sex' => $this->input->post('sex', true),
						'phone_number' => $this->input->post('phone_number', true),
						'bio' => $this->input->post('bio', true),
						'profession' => $this->input->post('profession', true),
						'level' => $this->input->post('level', true),
						'schedule' => $this->input->post('schedule', true),
						'is_active' => 'inactive',
						'is_available' => 'available',
						'file_pdf' => $this->upload->data('file_name'),
					);

					// print_r($additional_data . "Ada file");
					// die;

					$insertStudent = $this->auth->saveTutor($additional_data);

					if ($insertStudent == false) {
						echo $this->upload->display_errors();
						die();
					} else {
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2 MB
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
					redirect('login');
				}
			}

			$additional_data = array(
				'user_id' => $insertUser,
				'name' => $this->input->post('name', true),
				'address' => $this->input->post('address', true),
				'sex' => $this->input->post('sex', true),
				'phone_number' => $this->input->post('phone_number', true),
				'bio' => $this->input->post('bio', true),
				'profession' => $this->input->post('profession', true),
				'level' => $this->input->post('level', true),
				'schedule' => $this->input->post('schedule', true),
				'is_active' => 'inactive',
				'is_available' => 'available',
			);

			// print_r($additional_data . 'Tidak ada file');
			// die;

			$insertStudent = $this->auth->saveTutor($additional_data);

			if ($insertStudent == false) {
				echo $this->upload->display_errors();
				die();
			} else {
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('message', 'Email sudah terdaftar');
			redirect('/register/tutor');
		}
	}

	public function save_student()
	{
		$user = array(
			'email'  => $this->input->post('email', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
			// 'avatar' => $_FILES['avatar']['name'],
			'is_active' => 'active',
			'role' => 'student',
		);

		$email = $this->auth->authStudent(['email' => $this->input->post('email')])->num_rows();
		if ($email < 1) {
			$insertUser = $this->auth->saveUser($user);
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
			$insertStudent = $this->auth->saveStudent($additional_data);
			// if (!$this->upload->do_upload('avatar')) {
			if (false) {
				echo $this->upload->display_errors();
				die();
			} else {
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('message', 'Email sudah terdaftar');
			redirect('/register/siswa');
		}
	}

	public function login2()
	{

		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$role = $this->input->post('role', true);
		if ($role === "tutor") {
			$email = $this->lgn->cek_data('tutor', ['email' => $email])->row_array();
			if ($email !== NULL) {
				if (password_verify($password, $email['password'])) {
					$session = array(
						'id' => $email['id'],
						'nama' => $email['nama'],
						'role' => "tutor"
					);
					$this->session->set_userdata($session);
					redirect('/dashboard/tutor');
				} else {
					$this->session->set_flashdata('message_siswa', 'Password yang anda masukkan salah');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('message_tutor', 'Email tidak terdaftar sebagai tutor');
				redirect('login');
			}
		} else {
			$email_siswa = $this->lgn->cek_data('siswa', ['email' => $email])->row_array();
			if ($email_siswa !== NULL) {
				if (password_verify($password, $email_siswa['password'])) {
					$session = array(
						'id' => $email_siswa['id'],
						'nama' => $email_siswa['nama_lengkap'],
						'role' => "siswa"
					);
					$this->session->set_userdata($session);
					redirect('/');
				} else {
					$this->session->set_flashdata('message_siswa', 'Password yang anda masukkan salah');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('message_siswa', 'Email tidak terdaftar sebagai siswa');
				redirect('login');
			}
		}

		$user = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
		$pass = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
		// $user = $this->input->post('username',TRUE);
		// $pass = $this->input->post('password',TRUE);
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('salah', validation_errors());
			redirect(base_url());
		} else {
			$cekAdmin = $this->m_login->authAdmin($user, $pass);

			if ($cekAdmin->num_rows() > 0) {
				$data = $cekAdmin->row_array();
				$this->session->set_userdata('success', TRUE);
				if ($data['level'] == 'Admin') {
					$this->session->set_userdata('name', $data['nama_petugas']);
					$this->session->set_userdata('kode', $data['kode_petugas']);
					$this->session->set_userdata('level', 'admin');
					// $object = array(
					// 	'tgl_update' => date('Y-m-d h:i:s'),
					// 	'teknisi' => $data['nama_petugas'],
					// 	'activity' => 'Login'
					// );
					// $this->m_login->log($object);
					redirect('service');
				} else {

					$this->session->set_userdata('name', $data['nama_petugas']);
					$this->session->set_userdata('kode', $data['kode_petugas']);
					$this->session->set_userdata('level', 'user');
					$object = array(
						'tgl_update' => date('Y-m-d h:i:s'),
						'teknisi' => $data['nama_petugas'],
						'activity' => 'Login'
					);
					// $this->m_login->log($object);
					redirect('service');
				}
			} else {
				$cekUser = $this->m_login->authUser($user, $pass);
				if ($cekUser->num_rows() > 0) {
					$data = $cekUser->row_array();
					$this->session->set_userdata('success', TRUE);
					$this->session->set_userdata('name', $data['nama_teknisi']);
					$this->session->set_userdata('kode', $data['kode_teknisi']);
					$this->session->set_userdata('keterangan', $data['keterangan']);
					$this->session->set_userdata('level', 'teknisi');
					// $object = array(
					// 	'tgl_update' => date('Y-m-d h:i:s'),
					// 	'teknisi' => $data['nama_teknisi'],					
					// 	'activity' => 'Login'
					// );
					// $this->m_login->log($object);
					redirect('service');
				} else {
					echo $this->session->set_flashdata('msg', 'Username atau Password tidak valid');
					redirect(base_url());
				}
			}
		}
	}

	public function auth_user()
	{
		$email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
		$role = $this->input->post('role', true);

		//Validation
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', validation_errors());
			redirect('login');
		} else {
			if ($role === 'tutor') {
				$tutor_data = $this->auth->authTutor(['email' => $email])->row_array();
				// print_r();
				// die;
				if ($tutor_data['tutor_act'] != "inactive") {
					if ($tutor_data !== NULL) {
						if (password_verify($password, $tutor_data['password'])) {
							$session = array(
								'id' => $tutor_data['id'],
								'name' => $tutor_data['name'],
								'email' => $tutor_data['email'],
								'role' => $tutor_data['role'],
								'tutor_id' => $tutor_data['tutor_id'],
							);
							$this->session->set_userdata($session);
							redirect('/tutor');
						} else {
							$this->session->set_flashdata('message', 'Password yang anda masukkan salah');
							redirect('login');
						}
					} else {
						$this->session->set_flashdata('message', 'Email tidak terdaftar sebagai tutor');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', 'Tutor belum diaktifkan');
					redirect('login');
				}
			} else if ($role === 'siswa') {
				$student_data = $this->auth->authStudent(['email' => $email])->row_array();
				if ($student_data !== NULL) {
					if (password_verify($password, $student_data['password'])) {
						$session = array(
							'id' => $student_data['id'],
							'name' => $student_data['name'],
							'role' => $student_data['role'],
							'level' => $student_data['level'],
						);
						$this->session->set_userdata($session);
						redirect('/');
					} else {
						$this->session->set_flashdata('message', 'Password yang anda masukkan salah');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', 'Email tidak terdaftar sebagai siswa');
					redirect('login');
				}
			}
		}
	}
	public function auth_admin()
	{
		$email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

		//Validation
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', validation_errors());
			redirect('login');
		} else {
			$admin_data = $this->auth->authAdmin(['email' => $email])->row_array();
			if ($admin_data !== NULL) {
				if (password_verify($password, $admin_data['password'])) {
					$session = array(
						'admin_id' => $admin_data['admin_id'],
						'user_id' => $admin_data['user_id'],
						'nama' => $admin_data['name'],
						'role' => $admin_data['role']
					);
					$this->session->set_userdata($session);
					redirect('/admin');
				} else {
					$this->session->set_flashdata('message', 'Password yang anda masukkan salah');
					redirect('admin/login');
				}
			} else {
				$this->session->set_flashdata('message', 'Email tidak terdaftar sebagai Admin');
				redirect('admin/login');
			}
		}
	}

	public function logout()
	{

		$this->session->sess_destroy();
		redirect('login');
	}
}
