<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
    // get admin session login
    public function getUser($table, $session)
    {
        $query = $session['user'] = $this->db->get_where($table, ['email' =>
        $this->session->userdata('email')])->row_array();
        return $query;
    }

    //Update Profile Akun
    function UpdateUserProfile($table, $data)
    {
        $this->db->set('name', $data);
        $this->db->where('email', $data['email']);
        $this->db->update($table, $data);
    }

    // get admin menu
    public function userMenu($table)
    {
        $query = $this->db->get($table)->result_array();
        return $query;
    }

    // input admin menu
    public function insertMenu($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    // update admin menu
    public function updateMenu($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id', $data['id']);
        $this->db->update($table, $data);
    }

    // hapus admin menu
    public function hapusMenu($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id', $data['id']);
        $this->db->delete($table, $data);
    }

    // get admin sub menu
    public function usersubMenu($table)
    {
        $query = "SELECT * FROM `$table` AS sub
                 LEFT JOIN `user_menu` AS m
                 ON sub.`menu_id` = m.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    //Inset submenu
    public function InsertsubModel($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    //Update submenu
    public function UpdatesubMenu($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id_sub_menu', $data['id_sub_menu']);
        $this->db->update($table, $data);
    }

    // Hapus submenu
    public function HapussubMenu($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id_sub_menu', $data['id_sub_menu']);
        $this->db->delete($table, $data);
    }


    //get role menu
    public function userRole($table)
    {
        $query = $this->db->get($table)->result_array();
        return $query;
    }

    //insert role menu
    public function insertRole($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    //hapus role menu
    public function hapusRole($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id', $data['id']);
        $this->db->delete($table, $data);
    }
    //update role menu
    public function updateRole($table, $data)
    {
        $this->db->get($table);
        $this->db->where('id', $data['id']);
        $this->db->update($table, $data);
    }

    // get role_access menu
    public function userMenuID($table)
    {
        $query = $this->db->get_where($table, ['id !=' => 1])->result_array();
        return $query;
    }

    //get user role id
    public function userRoleID($table, $data)
    {
        $query = $this->db
            ->select('*')
            ->get_where($table, ['id' => $data])
            ->row_array();
        return $query;
    }

    // change access role
    public function changeAccess($table, $data)
    {
        $query = $this->db->get_where($table, $data);

        if ($query->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        return $query;
    }

    // change password
    function ChangePassword($table, $data)
    {
        $this->db->set('password', $data['password']);
        $this->db->where('email', $data['email']);
        $this->db->update($table, $data);
    }
}
