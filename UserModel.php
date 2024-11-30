<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
   
    public function getUserById($user_id) {
        return $this->db->get_where('user', ['id' => $user_id])->row_array();
    }

    public function updateUser($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }

    
}
