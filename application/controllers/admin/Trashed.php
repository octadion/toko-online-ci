<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trashed extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trashed_model');
        $this->load->model('order_model');
        // $params = array('server_key' => 'SB-Mid-server-lllM3XwrxvDj1C78-55QT6Aq', 'production' => false);
		// $this->load->library('veritrans');
		// $this->veritrans->config($params);
        check_admin();
    }

    function get_ajax() {
        $list = $this->trashed_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->order_date;
            $row[] = indo_currency($item->total_price);
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $this->status_color($item->status);
            $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
            $status_cancel = 'cancelled';
            $status_confirm = 'confirmed';
            $row[] = '
           
           
                <a class="btn btn-sm btn-primary restore" href="#restore" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" >
                    <i class="fa fa-fw fa-refresh mr-5"></i>Restore
                </a>
                
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->trashed_model->count_all(),
                    "recordsFiltered" => $this->trashed_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function status_color($status){
        if($status == 'completed'){
            return '<span class="badge badge-success">Completed</span>';
        }
        else if($status == 'created'){
            return '<span class="badge badge-warning">Created</span>';
        }
        else if($status == 'cancelled'){
            return '<span class="badge badge-danger">Cancelled</span>';
        }
        else if($status == 'confirmed'){
            return '<span class="badge badge-primary">Confirmed</span>';
        }
        else if($status == 'delivered'){
            return '<span class="badge badge-primary">Delivered</span>';
        }
    }
    function paymentstatus_color($status){
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
        $this->_display('admin/trashed/index', [
            'menu_active' => 'trashed',    
            'title' => 'Trashed',
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
        // $check = $this->unit_model->check_duplicate_unit_id($post["id"]);
        // if(!$check){
            $data = $this->trashed_model->del($post["id"]);
            $error = $this->db->error();
            if($error['code'] != 0){
                echo "error";
            } else {
                echo 'true';
            }
            // echo $data;
            

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

    public function restore(){
        $post = $this->input->post(null, TRUE);
        $data = $this->trashed_model->restore($post);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }
}
