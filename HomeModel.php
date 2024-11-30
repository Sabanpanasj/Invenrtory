<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    public function getInventoryData()
    {
        $this->db->select('products, quantity, price, expirationDate');
        $query = $this->db->get('inventory');
        return $query->result_array();
    }
}
