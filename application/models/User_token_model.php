<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_token_model extends CI_Model
{
    public function insertToken($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }
}
