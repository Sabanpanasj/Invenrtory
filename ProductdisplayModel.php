<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductdisplayModel extends CI_Model
{
   
    public function getinventory()
    {
        $query = $this->db->get('inventory');
        return $query->result_array();
    }
}