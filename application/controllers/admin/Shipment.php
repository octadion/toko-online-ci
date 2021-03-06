<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shipment_model');
        $this->load->model('order_model');
        // $params = array('server_key' => 'SB-Mid-server-Ibd04nKFjjMh8kNnmH-Nr-m0', 'production' => false);
		// $this->load->library('veritrans');
		// $this->veritrans->config($params);
        check_admin();
    }

    function get_ajax() {
        $list = $this->shipment_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $item->status;
            $row[] = $item->total_qty;
            $row[] = $item->total_weight;
            // $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
            $status_cancel = 'cancelled';
            $status_confirm = 'confirmed';
            $row[] = '
                <a class="btn btn-sm btn-primary btn-foto" href="'.site_url('admin/shipment/detail/'.$item->id).'" data-id="'.$item->id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>
               
             
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->shipment_model->count_all(),
                    "recordsFiltered" => $this->shipment_model->count_filtered(),
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
        $this->_display('admin/shipment/index', [
            'menu_active' => 'shipment',    
            'title' => 'Shipment',
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
            $data = $this->shipment_model->del($post["id"]);
            $error = $this->db->error();
            if($error['code'] != 0){
                echo "error";
            } else {
                echo 'true';
            }
            // echo $data;
            
        // } else{
        //     echo 'false';
        // }

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

    public function detail($id = null)
    {
      
        $this->db->select('orders.*, order_items.product_id, order_items.qty, order_items.name, order_items.base_total,
        order_items.base_price, inventories.qty as stock, user.*');
        $this->db->join('order_items','order_items.order_id = orders.id','left');
        $this->db->join('inventories','order_items.product_id = inventories.product_id','left');
        $this->db->join('user','orders.user_id = user.id','left');
        $this->db->where([
            'orders.deleted_at' => null,
            'orders.id' => $id,
        ]);
        $this->db->from('orders');
        $data = $this->db->get()->row();
        
        if (!$data || $id == null) {
            echo 'data tidak ditemukan';
            die;
        }
        $id_user = $data->user_id;
        $this->db->select('orders.*,user.first_name,user.last_name');
        $this->db->from('orders');
        $this->db->join('user','orders.user_id = user.id','left');
        $this->db->where('user_id',$id_user);
        $this->db->order_by('id','desc');
        $order =  $this->db->get()->result();
        // $id_user = $data->user_id;
        print_r($id_user);
        $total_order = $this->db->query("SELECT * FROM orders where deleted_at is null and user_id = '$id_user'")->num_rows();

        $this->db->select('order_items.*, orders.id');
        $this->db->from('order_items');
        $this->db->join('orders','orders.id = order_items.order_id','left');
        $this->db->where('orders.user_id',$id_user);
        $this->db->group_by('order_items.product_id');
        // $this->db->order_by('id','desc');
        $total_product =  $this->db->get()->num_rows();

        $this->db->select('order_items.*, orders.id');
        $this->db->from('order_items');
        $this->db->join('orders','orders.id = order_items.order_id','left');
        $this->db->where('orders.id',$id);
        $this->db->group_by('order_items.product_id');
        // $this->db->order_by('id','desc');
        $total_tabelproduct =  $this->db->get()->num_rows();

        $this->db->select('*');
        $this->db->from('shipments');
        // $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        // $this->db->join('orders', 'orders.id = order_items.order_id', 'left');
        $this->db->where('order_id', $id);
        // $this->db->where('orders.id', $id);
        $shipment =  $this->db->get()->result();

        // $query = $this->product_model->get($id);
        // $category = $this->category_model->get_view()->result();
        // $unit = $this->unit_model->get_view()->result();
        $foto = $this->db->get_where('product_photo', ['produk_id' => $id])->result();
        
        // if($data->num_rows() > 0){
            // $item = $query->row();
            $this->_display('admin/shipment/detail/detail', [
                'menu_active' => 'shipment',
                'title' => 'Detail Shipment',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                // 'page' => 'edit',
                // 'item' => $item,
                'total_order' => $total_order,
                // 'unit' => $unit,
                'order' => $order,
                'foto'=>$foto,
                'data'=>$data,
                'tot_product'=>$total_product,
                'shipment'=>$shipment,
                // 'total' => $total,
                'total_tabelprd'=>$total_tabelproduct,
                ]);
        // }
        // else{
        //     echo "<script>alert('Data tidak ditemukan');";
		// 	echo "window.location='".site_url('admin/product')."';</script>";
        // }
    }
    public function track($id){
        $this->db->select('shipments.*,orders.shipping_courier');
        $this->db->from('shipments');
        $this->db->join('orders','orders.id = shipments.order_id','left');
        $this->db->where('orders.id',$id);
        // $this->db->order_by('id','desc');
        $track_number =  $this->db->get()->row()->track_number;
        // print_r($track_number);

            $this->db->select('shipments.*,orders.shipping_courier');
        $this->db->from('shipments');
        $this->db->join('orders','orders.id = shipments.order_id','left');
        $this->db->where('orders.id',$id);
        $shipping_courier =  $this->db->get()->row()->shipping_courier;
        // print_r($shipping_courier);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.binderbyte.com/v1/track?api_key=079f7ef284acdf18f6affe5ac4a68954348e4595d750fadbfe486ca504ceb202&courier='.$shipping_courier.'&awb='.$track_number.'',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            // echo $response;
            $array_response = json_decode($response,true);
        
        $data_track = $array_response['data'];
        $count_ray = count($array_response['data']['history']);
        $this->_display('admin/shipment/track/track', [
            'menu_active' => 'shipment',
            'title' => 'Tracking',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'hasil' => $data_track,
            'countnya' => $count_ray,
            ]);
    }
}
