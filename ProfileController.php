<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel'); 
        $this->load->library(['session', 'form_validation']);
        $this->check_login(); 
    }

    private function check_login() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');  
        }
    }

    public function profile()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row();

       
        $this->load->view('pages/profile', $data);
    }

    public function update()
    {
        $user_id = $this->session->userdata('user_id');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
           
            $this->session->set_flashdata('message', 'Profile update failed. Please try again.');
            $this->session->set_flashdata('type', 'error');
            redirect('profile');
        } else {
           
            $update_data = [
                'email' => $email,
                'password' => $password,
            ];

            $this->db->where('id', $user_id);
            if ($this->db->update('user', $update_data)) {
                $this->session->set_flashdata('message', 'Profile updated successfully!');
                $this->session->set_flashdata('type', 'success');
            }
            redirect('profile');
        }
    }
}
