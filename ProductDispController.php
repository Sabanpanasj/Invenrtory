<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductDispController extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductdisplayModel'); 
		$this->check_login();
         
    }

	private function check_login() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
	public function product()
	{
		$data['inventory'] = $this->ProductdisplayModel->getinventory();
		$this->load->view('pages/product',$data);
	}

	

}
