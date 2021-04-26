<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    function get_ajax() {
        $list = $this->category_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->category_name;
            // add html for action
            $row[] = '<button id="upd'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-kategori_judul="'.$item->category_name.'" data-toggle="modal" data-target="#modal-popin" class="edit_kategori btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->category_model->count_all(),
                    "recordsFiltered" => $this->category_model->count_filtered(),
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
        $this->_display('admin/category/k_data', [
            'menu_active' => 'category',    
            'title' => 'Category',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    function get_kategori_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->category_model->get_kategori_all();
    }

    public function add()
    {
        $item = new stdClass();
		$item->id = null;
        $item->kategori_nama = null;

        $this->_display('kategori/form/k_form', [
            'menu_active' => 'kategori',
            'title' => 'Tambah Kategori',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'page' => 'add',
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $query = $this->category_model->get($id);
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('kategori/form/k_form', [
                'menu_active' => 'kategori',
                'title' => 'Tambah Kategori',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                'page' => 'edit',
                'item' => $item,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('kategori')."';</script>";
        }
    }

    public function check_kategori(){
        $post = $this->input->post(null, TRUE);
		$data = $this->category_model->check_duplicate_category_id($post["category_id"]);
		// $error = $this->db->error();
		// if($error['code'] != 0){
        if($data){
			echo "true";
		} else {
			echo "false";
		}
        // echo $data;
		// echo "<script>window.location='".site_url('kategori')."';</script>";
        // $this->output->set_output($id);
	}

    public function del(){
        $post = $this->input->post(null, TRUE);
        $check = $this->category_model->check_duplicate_category_id($post["id"]);
        if(!$check){
            $data = $this->category_model->del($post["id"]);
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

		// echo "<script>window.location='".site_url('kategori')."';</script>";
        // $this->output->set_output($id);
	}

    public function process(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
		if($post['page'] == 'add'){
			$data = $this->category_model->add($post);
		} else if($post['page'] == 'edit'){
			$data = $this->category_model->edit($post);
		} 
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
        // echo json_encode($data);
		// redirect('kategori');
    }

    public function kategori_validation(){
        $category = $this->input->post('kategori_judul', TRUE);
        if($this->category_model->check_duplicate_category($category)){
            // return false;
            echo 'false';
        } else{
            // return true;
            echo 'true';
        }

    }
}
