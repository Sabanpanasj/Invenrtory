<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    // Save new product record
    public function saverecords($data)
    {
        return $this->db->insert('inventory', $data);
    }

    // Get a product by its ID
    public function get_product_by_id($id)
    {
        return $this->db->get_where('inventory', ['id' => $id])->row_array();
    }

    // Update product data
    public function updateData($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('inventory', $data);
    }

    // Delete a product item
    public function delete_item($id)
    {
        return $this->db->delete('inventory', ['id' => $id]);
    }
}
