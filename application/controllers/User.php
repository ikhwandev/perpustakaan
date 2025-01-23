<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        is_logged_in();
    }

    public function index()
    {
        show_404();
    }

    public function dashboard()
    {
        $userSession = $this->session->data;
        $tampil = $this->user_model->getUser('user', $userSession);

        if ($tampil == []) {
            redirect('auth');
        } else {

            $data = array(
                'title' => 'Dashboard',
                'name' => $tampil['name'],
                'role_id' => $tampil['role_id'],
                'image' => $tampil['image']
            );
            $this->load->view('layout/header', $data);
            $this->load->view('layout/member/sidebar', $data);
            $this->load->view('layout/member/dashboard', $data);
            $this->load->view('layout/footer');
        }
    }

    // Detail User Profile
    public function detail()
    {
        $userSession = $this->session->data;
        $tampil = $this->user_model->getUser('user', $userSession);
        $data = array(
            'title' => 'MY Profile',
            'name' => $tampil['name'],
            'email' => $tampil['email'],
            'role_id' => $tampil['role_id'],
            'image' => $tampil['image']
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/member/sidebar', $data);
        $this->load->view('layout/member/detail', $data);
        $this->load->view('layout/footer');
    }

    // Edit Profile 
    public function edit()
    {
        $userSession = $this->session->data;
        $tampil = $this->user_model->getUser('user', $userSession);
        $data = array(
            'title' => 'MY Profile',
            'name' => $tampil['name'],
            'email' => $tampil['email'],
            'role_id' => $tampil['role_id'],
            'image' => $tampil['image']
        );

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim', [
            'required' => 'Data Nama Lengkap belum di input!'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/member/sidebar', $data);
            $this->load->view('layout/member/edit', $data);
            $this->load->view('layout/footer');
        } else {

            $email = $this->input->post('email');
            $name = $this->input->post('name');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //cek jenis file diupload
            if ($upload_image) {
                $config['allowed_types'] = 'img|png|jpg|svg';
                $config['max_size']     = 2000;
                $config['max_width']    = 160;
                $config['max_height']   = 160;
                $config['upload_path']  = './assets/img/profile/';

                $this->load->library('upload', $config);

                //jika tidak ada gambar
                if (!$this->upload->do_upload('image')) {


                    // jika ada gambar
                } else {
                    $old_image = $data['image'];

                    $this->upload->do_upload('image');
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                }
            }

            $value = [
                'email' => $email,
                'name' => $name
            ];

            //update user
            $this->user_model->UpdateUserProfile('user', $value);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profile baru tersimpan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                    </div>'
            );
            redirect('user/detail');
        }
    }

    // change password
    public function changepassword()
    {
        $userSession = $this->session->data;
        $tampil = $this->user_model->getUser('user', $userSession);

            $data = array(
                'title' => 'Change Password',
                'name' => $tampil['name'],
                'role_id' => $tampil['role_id'],
                'image' => $tampil['image']
            );

            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[5]|matches[new_password1]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('layout/member/sidebar', $data);
                $this->load->view('layout/member/topbar', $data);
                $this->load->view('layout/member/changepassword', $data);
                $this->load->view('layout/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                
                if (!password_verify($current_password, $tampil['password'])) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Wrong Current Password!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            </div>'
                    );
                    redirect('user/changepassword');             
                } else {
                    if ($current_password == $new_password ) {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Password must not be same as current password!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                                </div>'
                        );
                        redirect('user/changepassword');
                    } else {
                        // password Ok
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        //simpan data fetch
                        $value = [
                            'email' => $tampil['email'],
                            'password' => $password_hash
                        ];

                        $this->user_model->ChangePassword('user', $value);
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Password Changed!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                                </div>'
                        );
                        redirect('user/changepassword');
                    }
                }
            }
    }
}
