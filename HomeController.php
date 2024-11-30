<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
        $this->load->library('session');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function home()
    {
        $data['inventoryData'] = $this->HomeModel->getInventoryData();
        $this->load->view('pages/Home', $data);
        
    }
}
