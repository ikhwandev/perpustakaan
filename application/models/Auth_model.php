<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{

   public function insertRegist($table,$data)
   {
        $query = $this->db->insert($table,$data);
        return $query;
   }

   public function cekLogin($table, $data)
   {
        $query = $this->db->get_where($table, ['email' => $data['email']])->row_array();
        return $query;
   }
}

