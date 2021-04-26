<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
    }

    function get_ajax() {
        $list = $this->unit_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->unit_name;
            // add html for action
            $row[] = '<button id="upd'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-unit_judul="'.$item->unit_name.'" data-toggle="modal" data-target="#modal-popin" class="edit_unit btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->unit_model->count_all(),
                    "recordsFiltered" => $this->unit_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function status_color($status){
        if($status == 'public'){
            return '<span class="badge badge-success">Public</span>';
        }
        else if($status == 'private'){
            return '<span class="badge badge-danger">Private</span>';
        }
        else if($status == 'draft'){
            return '<span class="badge badge-primary">Draft</span>';
        }
    }

    public function index()
    {
        $this->_display('admin/unit/unit_data', [
            'menu_active' => 'unit',    
            'title' => 'Unit',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    function get_unit_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->unit_model->get_unit_all();
    }

    public function add()
    {
        $item = new stdClass();
		$item->id = null;
        $item->unit_nama = null;

        $this->_display('admin/unit/form/k_form', [
            'menu_active' => 'unit',
            'title' => 'Tambah unit',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'page' => 'add',
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $query = $this->unit_model->get($id);
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('unit/form/k_form', [
                'menu_active' => 'unit',
                'title' => 'Tambah unit',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                'page' => 'edit',
                'item' => $item,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('unit')."';</script>";
        }
    }

    public function check_unit(){
        $post = $this->input->post(null, TRUE);
		$data = $this->unit_model->check_duplicate_unit_id($post["unit_id"]);
		// $error = $this->db->error();
		// if($error['code'] != 0){
        if($data){
			echo "true";
		} else {
			echo "false";
		}
        // echo $data;
		// echo "<script>window.location='".site_url('unit')."';</script>";
        // $this->output->set_output($id);
	}

    public function del(){
        $post = $this->input->post(null, TRUE);
        $check = $this->unit_model->check_duplicate_unit_id($post["id"]);
        if(!$check){
            $data = $this->unit_model->del($post["id"]);
            $error = $this->db->error();
            if($error['code'] != 0){
                echo "error";
            } else {
                echo 'true';
            }
            // echo $data;
            
        } else{
            echo 'false';
        }

		// echo "<script>window.location='".site_url('unit')."';</script>";
        // $this->output->set_output($id);
	}

    public function process(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
		if($post['page'] == 'add'){
			$data = $this->unit_model->add($post);
		} else if($post['page'] == 'edit'){
			$data = $this->unit_model->edit($post);
		} 
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
        // echo json_encode($data);
		// redirect('unit');
    }

    public function unit_validation(){
        $judul = $this->input->post('unit_judul', TRUE);
        if($this->unit_model->check_duplicate_unit($judul)){
            // return false;
            echo 'false';
        } else{
            // return true;
            echo 'true';
        }

    }
}
