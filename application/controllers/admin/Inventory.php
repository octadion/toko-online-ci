<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model');
        // $this->load->model('front/order_model');
        // $params = array('server_key' => 'SB-Mid-server-Ibd04nKFjjMh8kNnmH-Nr-m0', 'production' => false);
		// $this->load->library('veritrans');
		// $this->veritrans->config($params);
        check_admin();
    }

    function get_ajax() {
        $list = $this->inventory_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->name;
            $row[] = $item->barcode;
            $row[] = $item->qty;

            // add html for action
            $row[] = '<div class="btn-group" role="group">
            <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <a class="dropdown-item btn-foto" href="'.site_url('admin/product/detail/'.$item->id_product).'" data-id="'.$item->id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>
               
                <a class="dropdown-item edit" href="#edit" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-user_id="'.$this->session->userdata('id').'" data-toggle="modal" 
                data-qty="'.$item->qty.'" data-target="#modal-popin">
                    <i class="fa fa-fw fa-pencil mr-5"></i>Edit
                </a>
            </div>
        </div>
                  ';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->inventory_model->count_all(),
                    "recordsFiltered" => $this->inventory_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function status_color($status){
        if($status == 'settlement'){
            return '<span class="badge badge-success">Success</span>';
        }
        else if($status == 'pending'){
            return '<span class="badge badge-warning">Pending</span>';
        }
        else if($status == 'expire'){
            return '<span class="badge badge-danger">Expired</span>';
        }
    }

    public function index()
    {
        $this->_display('admin/inventory/index', [
            'menu_active' => 'inventory',    
            'title' => 'Inventories',
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

    public function cekstatus(){
        $order_id = $this->input->post('order_id');
        print_r($order_id);
        if($order_id){
            $this->status($order_id);
        }else{
            echo 'order id tidak ada';
        }
    }
    private function status($order_id){
        $result = $this->veritrans->status($order_id);
        $dataupdate = [
            'status' => $result->transaction_status
        ];
        $where = [
            'order_id' => $order_id
        ];
        $update = $this->payment_model->update($dataupdate, $where);
      
        $dataupdate_order = [
            'payment_status' => $result->transaction_status
        ];
        $where = [
            'id' => $order_id
        ];
        $upd_order = $this->order_model->update_pay_order($dataupdate_order, $where);
    }

    public function edit_stock(){
        $post = $this->input->post(null, TRUE);
        if($post['tipe'] == 'penyesuaian'){

			$penyesuaian = $this->inventory_model->penyesuaian($post);
            
		} else if($post['tipe'] == 'penambahan'){
            $penambahan = $this->inventory_model->penambahan($post);
        }else if($post['tipe'] == 'pengurangan'){
            $pengurangan = $this->inventory_model->pengurangan($post);
        }
    }
}
