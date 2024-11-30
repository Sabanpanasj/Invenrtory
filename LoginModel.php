<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

  
    public function get_user($email, $password)
    {
      
        $this->db->where('email', $email);
        $this->db->where('password', $password); 
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false; 
        }
    }
}
