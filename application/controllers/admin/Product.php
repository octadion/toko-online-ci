<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->model('foto_model');
       
    }

    function get_ajax() {
        $list = $this->product_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode;
            $row[] = $item->name;
            // $row[] = $item->first_name.' '.$item->last_name;
            
            $row[] = $item->category_name;
            $row[] = $item->weight.' '.$item->unit_name;
            // $row[] = $item->weight;
            $row[] = indo_currency($item->price);
            $row[] = $item->stock;
            $row[] = $this->status_color($item->status_barang);
            // add html for action
            $status_barang = $item->status_barang == 'baik' ? 'rusak' : 'baik';
            $row[] = '
                <div class="btn-group" role="group">
                    <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                        <a class="dropdown-item btn-foto" href="'.site_url('admin/product/detail/'.$item->id).'" data-id="'.$item->id.'">
                            <i class="fa fa-fw fa-eye mr-5"></i>Detail
                        </a>
                        <a class="dropdown-item change-status_barang" href="#edit_status_barang" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-status_barang="'.$status_barang.'">
                            <i class="fa fa-fw fa-refresh mr-5"></i>Change to '. ucfirst($item->status_barang == 'baik' ? 'rusak' : 'baik') .'
                        </a>
                        <a class="dropdown-item btn-foto" href="#tambah_photo" id="'.$item->id.'" data-id="'.$item->id.'" data-toggle="modal" data-target="#modal-popin">
                            <i class="fa fa-fw fa-image mr-5"></i>Image
                        </a>
                        <a class="dropdown-item btn-edit" href="'.site_url('admin/product/edit/'.$item->id).'" data-id="'.encode_id($item->id).'">
                            <i class="fa fa-fw fa-pencil mr-5"></i>Edit
                        </a>
                    </div>
                </div>
                <button id="'.$item->id.'" data-id="'.$item->id.'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
            ';
            // $row[] = '<a href="'.site_url('berita/edit/'.$item->id).'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
            //         <button id="'.$item->id.'" data-id="'.$item->id.'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->product_model->count_all(),
                    "recordsFiltered" => $this->product_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function status_color($status_barang){
        if($status_barang == 'baik'){
            return '<span class="badge badge-success">Baik</span>';
        }
        else if($status_barang == 'rusak'){
            return '<span class="badge badge-danger">Rusak</span>';
        }
    }

    public function index()
    {
        $this->_display('admin/product/data/product_data', [
            'menu_active' => 'product',
            'title' => 'Product',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    function get_berita_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->berita_model->get_berita_all();
    }

    public function add()
    {
        $item = new stdClass();
		$item->id = null;
        $item->barcode = null;
        $item->name = null;
        // $item->status = null;
        $item->category_id = null;
        $item->unit_id = null;
        $item->price = null;
        $item->weight = null;
        $item->description = null;
        $item->short_desc = null;
        $item->status_barang = null;
        $item->status_post = null;
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        // $photo = $this->photo_model->get_view()->result();

        $this->_display('admin/product/form/product_form', [
            'menu_active' => 'product',
            'title' => 'Add Product',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'page' => 'add',
            'item' => $item,
            'category' => $category,
            'unit' => $unit,
            
        ]);
    }

    public function edit($id)
    {
        $query = $this->product_model->get($id);
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('admin/product/form/product_form', [
                'menu_active' => 'product',
                'title' => 'Edit Product',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                'page' => 'edit',
                'item' => $item,
                'category' => $category,
                'unit' => $unit,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('admin/product')."';</script>";
        }
    }
    public function detail($id = null)
    {
        $this->db->select('product.*,  category.category_name, unit.unit_name');
        $this->db->join('category', 'product.category_id = category.id', 'left');
         $this->db->join('unit', 'product.unit_id = unit.id', 'left');
        $this->db->where([
            'product.deleted_at' => null,
            'product.id' => $id,
        ]);
        $this->db->from('product');
        $data = $this->db->get()->row();
        
        if (!$data || $id == null) {
            echo 'data tidak ditemukan';
            die;
        }
        $query = $this->product_model->get($id);
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        $foto = $this->db->get_where('product_photo', ['produk_id' => $id])->result();
        
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('admin/product/detail/product_detail', [
                'menu_active' => 'product',
                'title' => 'Detail Product',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                // 'page' => 'edit',
                'item' => $item,
                'category' => $category,
                'unit' => $unit,
                'foto'=>$foto,
                'data'=>$data,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('admin/product')."';</script>";
        }
    }

    public function edit_status_barang(){
        $post = $this->input->post(null, TRUE);
        $data = $this->product_model->edit_status_barang($post);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }

    public function del(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
		$data = $this->product_model->del($post);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Data tidak dapat dihapus (sudah berelasi)');</script>";
		} else {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
        echo $data;
	}

    public function process(){
        $post = $this->input->post(null, TRUE);
        // $slug = format_url($post['title']);
		if($post['page'] == 'add'){

            // $uploads = upload_file('thumbnail', 'uploads/', true, 'jpg|png|jpeg');
            // $post['thumbnail'] = $uploads['name'];
			$data = $this->product_model->add($post);
            
		} else if($post['page'] == 'edit'){
            // $uploads = upload_file('thumbnail', 'uploads/', true, 'jpg|png|jpeg');
            // $post['thumbnail'] = $uploads['name'];
			$data = $this->product_model->edit($post);
		} 
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
        // echo json_encode($data);
		// redirect('berita');
    }

    public function upload_photo_summernote(){
        $uploads = upload_file('image', 'uploads/content/');
        echo base_url($uploads['path']);
    }

    public function barcode_validation(){
        $barcode = $this->input->post('barcode', TRUE);
        if($this->product_model->check_duplicate_barcode($barcode)){
            // return false;
            echo 'false';
        } else{
            // return true;
            echo 'true';
        }
    }
    public function upload_gambar(){
       
        sleep(2);
        $produk_id =$this->input->post('produk_id');
        print_r($produk_id);
     
        if (!empty($_FILES['file']['name'])) {
           
            $upload = upload_file('file', 'uploads/product/' . date('Y-m-d'), true, 'png|jpg|jpeg|gif', 5);
            $this->db->insert('product_photo', [
                'produk_id' => $produk_id,
                'foto_path' => $upload['path_min'],
                'foto_name' => $upload['name'],
            ]);
            // $data = $this->db->insert('product_photo', $post);
        }
        echo json_encode([
            'status' => 'success',
            'msg' => 'Berhasil mengpload gambar'
        ]);
    }
    public function hapus_data_gambar()
    {
        $id = $this->input->post('id', true);
        $this->db->where('id', $id);
        $this->db->delete('product_photo');
        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil dihapus'
        ]);
    }
    public function ajax_getAll_gambar()
    {
        $id = $this->input->get('id');
        $list = $this->foto_model->get_datatables($id);
        $data = array();
        $no = $_GET['start'];
        foreach ($list as $field) {

            $aksi = '
                <button class="btn btn-sm btn-rounded btn-alt-danger min-width-75 tombol_hapus" data-id="' . $field->id . '"><i class="fa fa-times"></i> Delete</button>               
            ';

            $gambar = '
                <img src="' . base_url($field->foto_path.'/'.$field->foto_name) . '" class="img" width="200" />
            ';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $gambar;
            $row[] = $aksi;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->product_model->count_all(),
            "recordsFiltered" => $this->product_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function tambah(){
        $data = [
                'barcode' => $this->input->post('barcode'),
            'name' => $this->input->post('name'),
            'category_id' => $this->input->post('category'),
          
            'description' => $this->input->post('description'),
            'short_desc' => $this->input->post('short_desc'),
            'price' => $this->input->post('price'),
            'weight' => $this->input->post('weight'),
            'unit_id' => $this->input->post('unit'),
        ];
        $this->db->insert('product', $data);
        // $produk_id = $this->db->insert_id();
        // sleep(2);
        // if (!empty($_FILES['file']['name'])) {
        //     $config['upload_path'] = 'uploads/product/';
        //     $config['allowed_types'] = 'jpg|png|jpeg';
        //     $config['max_size'] = 0; // 0 = no limit || default max 2048 kb
        //     $config['overwrite'] = false;
        //     $config['remove_space'] = true;
        //     $config['encrypt_name'] = true;
        //     $this->load->library('upload');

        //     $files = $_FILES;
        //     for($i=0; $i< count($files['file']['name']); $i++)
        //     {           
        //         $_FILES['file']['name']= $files['file']['name'][$i];
        //         $_FILES['file']['type']= $files['file']['type'][$i];
        //         $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
        //         $_FILES['file']['error']= $files['file']['error'][$i];
        //         $_FILES['file']['size']= $files['file']['size'][$i];    

        //         $this->upload->initialize($config);
        //         $this->upload->do_upload('file');
        //     }
        //     $zdata = ['upload_data' => $this->upload->data()]; // get data
        //     $zfile = $zdata['upload_data']['full_path']; // get file path
        //     chmod($zfile, 0777); // linux wajib
        //     $gambar = $zdata['upload_data']['file_name'];
        //     $foto_name = $this->upload->data('file_name');
        //     print_r($foto_name);
         
        //     $id =  $this->db->insert_id();
        //      // nama file            
        //     $this->db->set('produk_id', $id);
        //     // $this->db->set('foto_name', $gambar);
        //     $this->db->insert('product_photo',array('foto_name'=>$foto_name));
        //     echo json_encode([
        //         'status' => 'success',
        //         'msg' => 'Berhasil mengpload gambar'
        //     ]);
        // if (!empty($_FILES['file']['name'])) {
           
        //     $upload = upload_file('file', 'uploads/product/' . date('Y-m-d'), true, 'png|jpg|jpeg|gif', 5);
        //     print_r($upload);
        //     $this->db->insert('product_photo', [
        //         'produk_id' => $produk_id,
        //         'foto_path' => $upload['path_min'],
        //         'foto_name' => $upload['name'],
        //     ]);
          
        // }
        echo json_encode([
            'status' => 'success',
            'msg' => 'Berhasil mengpload gambar'
        ]);
    }}

