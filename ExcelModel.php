<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExcelModel extends CI_Model
{


public function UploadExcel($data) {
		$this->db->insert('inventory', $data);
	}
	public function getExcelData() {
		$query = $this->db->get('inventory');
		return $query->result();
	}
    public function batchInsert($data) {
        $this->db->insert_batch('inventory', $data);
    }
}
