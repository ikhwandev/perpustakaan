<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {
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
        $this->load->view('layout/admin/sidebar', $data);
        $this->load->view('layout/admin/detail', $data);
        $this->load->view('layout/footer');  
    }

}