<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['akun_model', 'auth_model']);
    }

    public function index()
    {
        $this->_display('admin/setting/setting', [
            'menu_active' => 'pengaturan',
            'title' => 'Setting',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }
    public function get_setting(){
        // $id = decode_id($this->session->userdata('id'));
        $set = $this->db->select('*')->get('setting')->row();
                $result = [
                    'id' => encode_id($set->id),
                    'store_name' => $set->store_name,
                    'location' => $set->location,
                    'address' => $set->address,
                    'no_telp' => $set->no_telp,
                    
                ];
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    
    }
    public function save()
    {
        if($this->input->post('id') != null || $this->input->post('id') != ''){
            $id = decode_id($this->input->post('id'));
            $data = [
                'store_name' => $this->input->post('store_name'),
                'location' => $this->input->post('kota'),
                'address' => $this->input->post('address'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->db->where('id', $id);
            $this->db->update('setting', $data);
        } else {
            $data = [
                'store_name' => $this->input->post('store_name'),
                'location' => $this->input->post('kota'),
                'address' => $this->input->post('address'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->db->insert('setting',$data);
        }
        $result = [
			'status' => 'success',
			'title' => 'Berhasil',
			// 'message' => $message,
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));

    }
    
}
