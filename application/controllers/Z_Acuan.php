<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Welcome_model', 'wlc');
		$this->load->model('Login_model', 'lgn');
	}
	public function index()
	{
		$this->load->view('auth/pages/login');
	}
	public function register_siswa()
	{
		$this->load->view('auth/pages/register_siswa');
	}
	public function register_tutor()
	{
		$this->load->view('auth/pages/register_tutor');
	}
	public function forgot_pw()
	{
		$this->load->view('auth/pages/forgot_password');
	}
	public function reset_pw()
	{
		$this->load->view('auth/pages/reset_password');
	}
	public function save_siswa()
	{
		$siswa = array(
			'nama_lengkap' => $this->input->post('nama', true),
			'jenis_kelamin' => $this->input->post('jk', true),
			'tempat_lahir' => $this->input->post('tempat', true),
			'tgl_lahir' => $this->input->post('tgl', true),
			'email' => $this->input->post('email', true),
			'password' => password_hash($this->input->post('pass', true), PASSWORD_BCRYPT),
			'kelas' => $this->input->post('kls', true),
			'sekolah' => $this->input->post('sekolah', true),
			'no_telp' => $this->input->post('no', true)
		);
		$email = $this->lgn->cek_data('tutor', ['email' => $this->input->post('email')])->num_rows();
		$email_siswa = $this->lgn->cek_data('siswa', ['email' => $this->input->post('email')])->num_rows();
		if ($email < 1 && $email_siswa < 1) {
			$siswa = $this->wlc->save_siswa($siswa);
			$ortu = array(
				'id_siswa' => $siswa,
				'nama_ayah' => $this->input->post('ayah', true),
				'nama_ibu' => $this->input->post('ibu', true),
				'no_telp' => $this->input->post('telpon_ortu', true),
				'pekerjaan' => $this->input->post('kerja', true),
				'alamat' => $this->input->post('alamat', true),
			);
			$siswa = $this->wlc->save_ortu($ortu);
			if ($siswa) {
				redirect('/login');
			}
		} else {
		}
	}

	public function save_tutor()
	{
		$config['upload_path'] = './assets/img/tutor/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $_FILES['foto_profil']['name'];
		$this->load->library('upload', $config);

		$tentang = array(
			'foto' => $_FILES['foto_profil']['name'],
			'nama' => $this->input->post('nama', true),
			'tempat_lahir' => $this->input->post('tempat', true),
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'pendidikan_terakhir' => $this->input->post('pendidikan', true),
			'pendidikan_sekarang' => $this->input->post('pendidikan_sekarang', true),
			'ipk_terakhir' => $this->input->post('ipk', true),
			'email' => $this->input->post('email', true),
			'password' => password_hash($this->input->post('pass', true), PASSWORD_BCRYPT),
			'no_telp' => $this->input->post('no'),
			'provinsi' => $this->input->post('prov'),
			'kabupaten' => $this->input->post('kab'),
			'alamat' => $this->input->post('alamat'),
			'tanggal_tes' => $this->input->post('tgl_tes'),
			'waktu_tes' => $this->input->post('jam_tes'),
		);

		$email = $this->lgn->cek_data('tutor', ['email' => $this->input->post('email')])->num_rows();
		$email_siswa = $this->lgn->cek_data('siswa', ['email' => $this->input->post('email')])->num_rows();
		if ($email < 1 && $email_siswa < 1) {
			$tutor = $this->wlc->save_tutor($tentang);
			if (!$this->upload->do_upload('foto_profil')) {
				echo $this->upload->display_errors();
				die();
			} else {
				redirect('/login');
			}
		} else {
			echo "email sudah ada";
		}
	}
	function save_tentang_tutor()
	{
		$config_tutor['upload_path'] = './assets/img/sertif_tutor/';
		$config_tutor['allowed_types'] = 'gif|jpg|png|jpeg';
		$config_tutor['overwrite'] = TRUE;
		$this->load->library('upload', $config_tutor);
		for ($i = 0; $i < count($_FILES['sertif']['name']); $i++) {
			$_FILES['file']['name'] = $_FILES['sertif']['name'][$i];
			$_FILES['file']['type'] = $_FILES['sertif']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['sertif']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['sertif']['error'][$i];
			$_FILES['file']['size'] = $_FILES['sertif']['size'][$i];
			$this->upload->do_upload('file');
		}
		if (!$this->upload->do_upload('file')) {
			echo $this->upload->display_errors();
			die();
		}
		$deskripsi = array(
			// 'id_tutor'=> id tutor,
			'deskripsi' => $this->input->post('diri'),
			'latar_belakang' => $this->input->post('latar'),
			'cara_mengajar' => $this->input->post('metode'),
			'minat_mengajar' => $this->input->post('minat'),
			'sertifikat' => (!empty($_FILES['sertif']['name'])) ? implode(',', $_FILES['sertif']['name']) : NULL,
		);

		$ttutor = $this->wlc->save_tentang_tutor($deskripsi);
		if ($ttutor > 0) {
			redirect('/dashboard');
		}
	}
	function login()
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
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}
}
