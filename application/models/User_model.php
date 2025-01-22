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
}
