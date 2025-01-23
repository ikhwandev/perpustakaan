<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        is_logged_in();
    }

    public function index()
    {
        show_404();
    }

    public function dashboard()
    {
        $userSession = $this->session->data;
        $tampil = $this->admin_model->getUser('user', $userSession);

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
            $this->load->view('layout/admin/sidebar', $data);
            $this->load->view('layout/admin/dashboard', $data);
            $this->load->view('layout/footer');
        }
    }

    public function detail()
    {
        $userSession = $this->session->data;
        $tampil = $this->admin_model->getUser('user', $userSession);
        $data = array(
            'title' => 'My Profile',
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

    public function edit()
    {
        $userSession = $this->session->data;
        $tampil = $this->admin_model->getUser('user', $userSession);
        $data = array(
            'title' => 'My Profile',
            'name' => $tampil['name'],
            'email' => $tampil['email'],
            'role_id' => $tampil['role_id'],
            'image' => $tampil['image']
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/admin/sidebar', $data);
        $this->load->view('layout/admin/edit', $data);
        $this->load->view('layout/footer');
    }

    public function menu()
    {
        $userSession = $this->session->data;

        // set session user dan tampil data awal menu
        $tampil = $this->admin_model->getUser('user', $userSession);
        // ambil daftar menu
        $dataMenu = $this->admin_model->userMenu('user_menu');

        // validasi input menu
        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Data menu belum di input!'
        ]);

        // simpan ke array
        $data = array(
            'title' => 'Menu Management',
            'name' => $tampil['name'],
            'role_id' => $tampil['role_id'],
            'image' => $tampil['image'],
            'data_menu' => $dataMenu

        );

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/admin/sidebar', $data);
            $this->load->view('layout/admin/menu', $data);
            $this->load->view('layout/footer');
        } else {

            // insert menu baru ke model
            $this->admin_model->insertMenu('user_menu', ['menu' => $this->input->post('menu')]);
            // buat data session menu
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Menu baru tersimpan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
                </div>'
            );
            redirect('admin/menu');
        }
    }

    public function editMenu($id)
    {
        // validasi input menu
        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Data menu belum di input!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Menu belum dimasukkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('admin/menu');
        } else {
            // simpan ke array
            $data = [
                'id' => $id,
                'menu' => $this->input->post('menu')
            ];

            //update menu
            $this->admin_model->updateMenu('user_menu', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Update Data dengan nama <strong>' . $data['menu'] . ' </strong> berhasil ditambahkan!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
            );
            redirect('admin/menu');
        }
    }

    public function hapusMenu($id)
    {
        $data = [
            'id' => $id
        ];
        //delete menu
        $this->admin_model->hapusMenu('user_menu', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Hapus Data Menu berhasil!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
        );
        redirect('admin/menu');
    }

    // submenu
    public function submenu()
    {
        $userSession = $this->session->data;

        // set session user dan tampil data awal menu
        $tampil = $this->admin_model->getUser('user', $userSession);

        // ambil daftar menu
        $dataMenu = $this->admin_model->userMenu('user_menu');

        // ambil daftar sub menu
        $datasubMenu = $this->admin_model->usersubMenu('user_sub_menu');

        // simpan ke array
        $data = [
            'title' => 'Submenu Management',
            'name' => $tampil['name'],
            'role_id' => $tampil['role_id'],
            'image' => $tampil['image'],
            'data_menu' => $dataMenu,
            'subMmenu' => $datasubMenu,
        ];

        // validasi input sub menu
        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Data Title belum di input!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Data Menu belum di input!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'Data UrL belum di input!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Data Icon belum di input!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/admin/sidebar', $data);
            $this->load->view('layout/admin/submenu', $data);
            $this->load->view('layout/footer');
        } else {

            // siapkan data post user
            $val = [
                'id_sub_menu' => $this->input->post('id_sub_menu'),
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            // Query Table tambah user_sub_menu
            $data = $this->admin_model->InsertsubModel('user_sub_menu', $val);

            // Query 
            $data;
            // buat data session menu
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Sub Menu baru tersimpan!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            </div>'
            );
            redirect('admin/submenu');
        }
    }

    //update submenu
    public function UpdatesubMenu($id_sub_menu)
    {
        // validasi input sub menu
        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Data Title belum di input!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Data Menu belum di input!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'Data UrL belum di input!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Data Icon belum di input!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Submenu belum dimasukkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('admin/submenu');
        } else {

            // siapkan data post user
            $data = [
                'id_sub_menu' => $id_sub_menu,
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),   
            ];

            // Query Table tambah user_sub_menu
            $data = $this->admin_model->UpdatesubMenu('user_sub_menu', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Update Data SubMenu berhasil ditambahkan!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
            );
            redirect('admin/submenu');
        }
    }

    //hapus submenu
    public function HapussubMenu($id_sub_menu)
    {
        $data = [
            'id_sub_menu' => $id_sub_menu,
        ];
        //delete menu
        $this->admin_model->HapussubMenu('user_sub_menu', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Hapus Data SubMenu berhasil!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
        );
        redirect('admin/submenu');
    }

    // role akses tambah
    public function role()
    {
        $userSession = $this->session->data;

        // set session user dan tampil data awal menu
        $tampil = $this->admin_model->getUser('user', $userSession);

        // ambil daftar menu
        $dataMenu = $this->admin_model->userMenu('user_menu');

        // validasi input menu
        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Data Role belum di input!'
        ]);

        $userSession = $this->session->data;
        $tampil = $this->admin_model->getUser('user', $userSession);

        //ambil data role
        $dataRole = $this->admin_model->userRole('user_role');

        if ($tampil == []) {
            redirect('auth');
        } else {

            $data = array(
                'title' => 'Role',
                'name' => $tampil['name'],
                'role_id' => $tampil['role_id'],
                'image' => $tampil['image'],
                'data_menu' => $dataMenu,
                'role' => $dataRole
            );

            if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('layout/admin/sidebar', $data);
                $this->load->view('layout/admin/role', $data);
                $this->load->view('layout/footer');
            } else {

            // insert role menu ke table
            $val = [
                'role' => $this->input->post('role')
            ];
            $this->admin_model->insertMenu('user_role',$val);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Update Data dengan Role <strong>' . $val['role'] . ' </strong> berhasil ditambahkan!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
            );
            redirect('admin/role');
            }
        }
    }

    // role akses edit
    public function editRole($id)
    {
        // validasi input menu
        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Data Role belum di input!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Role belum dimasukkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('admin/role');
        } else {
            // simpan ke array
            $data = [
                'id' => $id,
                'role' => $this->input->post('role')
            ];

            //update menu
            $this->admin_model->updateRole('user_role', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Update Data dengan Role <strong>' . $data['role'] . ' </strong> berhasil ditambahkan!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
            );
            redirect('admin/role');
        }
    }

    // role akses hapus
    public function hapusRole($id)
    {
        $data = [
            'id' => $id
        ];
        //delete menu
        $this->admin_model->hapusRole('user_role', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Hapus Data Role berhasil!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>'
        );
        redirect('admin/role');
    } 

    public function roleAccess($id)
    {
        $userSession = $this->session->data;
        $tampil = $this->admin_model->getUser('user', $userSession);

        // ambil daftar menu
        $dataMenu = $this->admin_model->userMenuID('user_menu');

        //ambil data user role
        $dataRole = $this->admin_model->userRoleID('user_role', $id);

        if ($tampil == []) {
            redirect('auth');
        } else {

            $data = array(
                'id' => $id,
                'title' => 'Role Access',
                'name' => $tampil['name'],
                'role_id' => $tampil['role_id'],
                'image' => $tampil['image'],
                'data_menu' => $dataMenu,
                'role' => $dataRole
            );

            $this->load->view('layout/header', $data);
            $this->load->view('layout/admin/sidebar', $data);
            $this->load->view('layout/admin/role-access', $data);
            $this->load->view('layout/footer');
        }
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $this->admin_model->changeAccess('user_access_menu', $data);


        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Role Akses berhasil diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
        );
    }
}
