<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel'); 
        $this->load->library('form_validation');
        $this->load->library('session'); 
        
    }

    public function login()
    {
        $this->load->view('pages/Login');
    }

    public function fetchdata()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
       
            $this->load->view('pages/Login');
        } else {
            
            $email = $this->input->post('email');
            $password = $this->input->post('password');

          
            $user = $this->LoginModel->get_user($email, $password);

            if ($user) {
                
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('email', $user->email);
                $this->session->set_userdata('logged_in', TRUE);
                 
                
     
                redirect('home');
            } else {
          
                $this->session->set_flashdata('message', 'Invalid email or password!');
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }
}
