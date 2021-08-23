<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Revenue extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('revenue_model');
        // $this->load->model('front/order_model');
        // $params = array('server_key' => 'SB-Mid-server-Ibd04nKFjjMh8kNnmH-Nr-m0', 'production' => false);
		// $this->load->library('veritrans');
		// $this->veritrans->config($params);
        check_admin();
    }

    function get_ajax() {
        $list = $this->revenue_model->get_datatables();
        $total_rev = 0;
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            // $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = DATE_FORMAT(new DateTime($item->order_date), 'd M Y');
            $row[] = $item->tot_order;
            $row[] = indo_currency($item->gross_revenue);
            $row[] = indo_currency($item->shipping);
            $row[] = indo_currency($item->net_revenue);
           
                $total_rev = $total_rev + $item->net_revenue;
                // print_r($total_rev);
                $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->revenue_model->count_all(),
                    "recordsFiltered" => $this->revenue_model->count_filtered(),
                    "data" => $data,
                    'total'    => indo_currency($total_rev, 2)
                );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax2() {
        $list = $this->revenue_model->get_datatables2();
        $total_rev = 0;
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            // $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->month;
            $row[] = $item->tot_order;
            $row[] = indo_currency($item->gross_revenue);
            $row[] = indo_currency($item->shipping);
            $row[] = indo_currency($item->net_revenue);
           
                $total_rev = $total_rev + $item->net_revenue;
                // print_r($total_rev);
                $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->revenue_model->count_all2(),
                    "recordsFiltered" => $this->revenue_model->count_filtered2(),
                    "data" => $data,
                    'total'    => indo_currency($total_rev, 2)
                );
        // output to json format
        echo json_encode($output);
    }

    public function rangeDates(){
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
    
        $return = $this->report_product_model->rangeDate($start_date,$end_date);
    
        echo json_encode($return);
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
        $this->_display('admin/revenue/index', [
            'menu_active' => 'revenue',    
            'title' => 'Revenue',
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
