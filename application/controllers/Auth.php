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
        check_already_login();
        $this->load->view('auth/login', $data, FALSE);
    }

    public function create(){
        $data = [];
        $this->load->view('auth/register', $data, FALSE);
    }

    public function validate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->Auth_model->validate($email, $password);
    }

    public function register()
    {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $phone = $this->input->post('phone');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->Auth_model->register($first_name, $last_name, $phone, $email, $alamat, $password);
        // if($this->db->affected_rows()>0){
        // $this->session->set_flashdata('success','Data berhasil disimpan');
        // }
        redirect('auth');
    }

    public function logout()
    {
        $id_user = decode_id($this->session->userdata('id'));
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect(base_url('auth'), 'refresh');
    }
}

/* End of file Auth.php */
