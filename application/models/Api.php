<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Model
{

    public function set_success($data)
    {
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function set_failed($data)
    {
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_status_header(503)
            ->set_output(json_encode($data));
    }
}

/* End of file Api.php */
