<?php


defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

class MY_Controller extends REST_Controller
{
    protected $role_id = null;
    protected $auth_id = null;

    public function __construct()
    {
        parent::__construct();
        if (!$this->isLoggedIn()) {
            redirect(base_url('auth'));
        }
        $this->role_id();
        $this->auth_id();
    }

    protected function role()
    {
        return $this->session->userdata('role');
    }

    protected function input_array($data = null, $method = 'POST')
    {
        $data = explode(', ', $data);

        $result = [];
        foreach ($data as $key) {
            $result[$key] = $method == 'POST' ? $this->input->post($key) : $this->input->get($key);
        }

        return $result;
    }

    protected function isLoggedIn()
    {
        // check if is login here
        return $this->session->userdata('logged_in');
    }

    protected function role_id()
    {
        $this->role_id = decode_id($this->session->userdata('role_id'));
    }

    protected function auth_id()
    {
        $this->auth_id = decode_id($this->session->userdata('id'));
    }

    protected function _display($content, $data, $data_js = [])
    {
        $content = [
            'isi' => $content,
            'js' => $this->load->view($content . '_js', $data_js, TRUE)
        ];
        $this->load->view('templates/get_template', array_merge($content, $data));
    }
}

/* End of file MY_Controller.php */
