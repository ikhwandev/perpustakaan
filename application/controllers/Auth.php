<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['title'] = 'LOGIN AREA';
		$this->load->view('v_login', $data);
	}


	public function registration()
	{
		$this->_ruleRegistration();

		if ($this->form_validation->run() == false) {
			$this->load->view('v_register');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name'), true),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			$token = base64_encode(random_bytes(32));

			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->load->model('auth_model');
			$this->load->model('user_token_model');

			//insert user ke db user
			$this->auth_model->insertRegist('user', $data);

			//insert token ke db user_token
			$this->user_token_model->insertToken('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata(
				'pesan_regist',
				'<div class="alert alert-success" role="alert">
					Selamat! akun anda telah di buat silahkan aktivasi akun!
				</div>'
			);
			redirect('auth');
		}
	}

	//fungsi send mail dengan PHP Mailer
	private function _sendEmail($token, $type)
	{

		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     	//Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = '';                     				//SMTP username
			$mail->Password   = '';                               		//SMTP password
			//  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


			$mail->addAddress($this->input->post('email'));     //Add a recipient

			if ($type == 'verify') {
				$mail->addReplyTo('no-reply@mail.com', 'Information');

				//Recipients
				$mail->setFrom('', 'Info Verifikasi Akun');

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Informasi Verifikasi Akun';
				$mail->Body    = 'Klik link ini untuk verifikasi akun anda : <a href ="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token)  . '" >Aktivasi</a>';
			} elseif($type == 'forgot') {
				$mail->addReplyTo('no-reply@mail.com', 'Information');

				//Recipients
				$mail->setFrom('', 'Info Reset Akun');

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Reset Password';
				$mail->Body    = 'Klik link ini untuk reset akun anda : <a href ="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token)  . '" >Reset Password</a>';
			}

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	// verifikasi user dan token
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// jika ada user regist
		if ($user) {

			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			// jika user token ada
			if ($user_token) {

				// jika user create kurang dari 24 jam
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata(
						'pesan_regist',
						'<div class="alert alert-success" role="alert">
						Email dengan nama ' . $email . ' telah diaktivasi! Silahkan login
					</div>'
					);
					redirect('auth');

					//jika create akun > 24 jam dan hapus user
				} else {

					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata(
						'pesan_regist',
						'<div class="alert alert-danger" role="alert">
						Token expired!
					</div>'
					);
					redirect('auth');
				}

				// cek token valid atau tidak
			} else {
				$this->session->set_flashdata(
					'pesan_regist',
					'<div class="alert alert-danger" role="alert">
					Aktivasi akun gagal, Token tidak valid!
				</div>'
				);
				redirect('auth');
			}

			// cek email valid atau tidak
		} else {
			$this->session->set_flashdata(
				'pesan_regist',
				'<div class="alert alert-danger" role="alert">
				Aktivasi akun gagal, email salah!
			</div>'
			);
			redirect('auth');
		}
	}

	public function login()
	{
		$data['title'] = 'LOGIN AREA';
		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			return $this->load->view('v_login', $data);
		} else {
			// validasi sukses
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->auth_model->cekLogin('user', ['email' => $email]);

			//kalo user ada
			if ($user) {

				// kalo user aktif
				if ($user['is_active'] == 1) {

					// cek form password dan db
					if (password_verify($password, $user['password'])) {
						$data = [
							'email' => $user['email'],
							'role_id' => $user['role_id']
						];

						// cek lempar halaman user atau admin
						if ($data['role_id'] == 1) {
							$this->session->set_userdata($data);
							redirect('admin/dashboard');
						} else {
							$this->session->set_userdata($data);
							redirect('user/dashboard');
						}
					} else {
						$this->session->set_flashdata(
							'pesan_regist',
							'<div class="alert alert-danger" role="alert">
							Maaf Password Anda salah!
						</div>'
						);
						redirect('auth');
					}

					// kalo user tidak aktif
				} else {
					$this->session->set_flashdata(
						'pesan_regist',
						'<div class="alert alert-danger" role="alert">
						Maaf akun anda belum di aktivasi!
					</div>'
					);
					redirect('auth');
				}

				// kalo user tidak ada
			} else {
				$this->session->set_flashdata(
					'pesan_regist',
					'<div class="alert alert-danger" role="alert">
						Maaf akun anda belum di regsitrasi!
					</div>'
				);
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata(
			'pesan_regist',
			'<div class="alert alert-success" role="alert">
			Kamu baru saja keluar dari sistem! 
		</div>'
		);
		redirect('auth');
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forgot Password';
			$this->load->view('layout/auth/forgot-password', $data);
		} else {
			// jika ada email maka cocokan dengan db
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email , 'is_active' => 1])->row_array();

			//jika user email ada bikin token
			if ($user) {
				$token = base64_encode(random_bytes(32));

				// insert tabel token
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata(
					'pesan_regist',
					'<div class="alert alert-danger" role="alert">
						Please check your email to reset password! 
					</div>'
				);
				redirect('auth');				


			// jika user email tidak ada	
			} else {
				$this->session->set_flashdata(
					'pesan_regist',
					'<div class="alert alert-danger" role="alert">
				Email belum terdaftar atau belum aktif!
			</div>'
				);
				redirect('auth/forgotPassword');
			}
		}
	}

	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		//jika user ada
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			//jika token ada
			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();


			} else {
				$this->session->set_flashdata(
					'pesan_regist',
					'<div class="alert alert-danger" role="alert">
						Reset Password Gagal, Token salah!
					</div>'
				);
				redirect('auth');
			}


		} else {
			$this->session->set_flashdata(
				'pesan_regist',
				'<div class="alert alert-danger" role="alert">
					Reset Password Gagal, Email salah!
				</div>'
			);
			redirect('auth');
		}


	}

	public function changePassword()
	{

		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[5]|matches[password1]');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Change Password';
			$this->load->view('layout/auth/change-password', $data);
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata(
				'pesan_regist',
				'<div class="alert alert-success" role="alert">
					Password berhasil di ubah, silahkan login!
				</div>'
			);
			redirect('auth');
		
		}
	}


	public function _ruleRegistration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email sudah didaftarkan'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password tidak sama',
			'min_length' => 'password terlalu pendek'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
	}

	public function blocked()
	{
		$this->load->view('v_blocked');
	}
}
