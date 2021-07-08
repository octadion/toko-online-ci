<?php

Class Fungsi {
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();  
    }

    function user_login(){
        $this->ci->load->model('akun_model');
        $user_id = decode_id($this->ci->session->userdata('id'));
        $user_data = $this->ci->akun_model->get_user($user_id)->row();
        return $user_data;
    }
}