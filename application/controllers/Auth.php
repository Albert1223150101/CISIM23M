<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');        
        $this->load->library('form_validation'); // Load form validation library
    }
    
    public function register() {
        $this->load->view('templates/header');
        $this->load->view('auth/register');
        $this->load->view('templates/footer');
    }

    public function process_register() { // Corrected method name
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]'); // Corrected syntax
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]'); // Changed min_length to 6
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];

            if ($this->user_model->insert_user($data)) { // Corrected model name
                $this->session->set_flashdata('success', 'Pendaftaran Berhasil');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Pendaftaran Gagal'); // Changed 'success' to 'error'
                redirect('auth/register');
            }
        }
    }
}