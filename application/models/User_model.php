<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
    // get user session login
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

    // change password
    function ChangePassword($table, $data)
    {
        $this->db->set('password', $data['password']);
        $this->db->where('email', $data['email']);
        $this->db->update($table, $data);
    }
}
