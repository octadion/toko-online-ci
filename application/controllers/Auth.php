<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {
        $data = [];
        $this->load->view('auth/login', $data, FALSE);
    }

    public function validate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->Auth_model->validate($email, $password);
    }

    public function register($email, $password)
    {
        $this->Auth_model->register($email, $password);
        echo "registered";
    }

    public function logout()
    {
        $id_user = decode_id($this->session->userdata('id'));
        $this->session->sess_destroy();
        redirect(base_url('auth'), 'refresh');
    }
}

/* End of file Auth.php */
