<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        $this->load->model('order_model');
    }

    public function index()
    {
        $product = $this->db->query("SELECT * FROM product where status_post = 'published' ")->num_rows();
		$user = $this->db->query("SELECT * FROM user where deleted_at is null ")->num_rows();
        $order = $this->db->query("SELECT * FROM orders where deleted_at is null ")->num_rows();
        $completed = $this->db->query("SELECT * FROM orders where deleted_at is null and status = 'completed' ")->num_rows();
        $good = $this->db->query("SELECT * FROM product where status_post = 'published' and status_barang = 'baik' ")->num_rows();
        $earning = $this->db->query("SELECT sum(grand_total) as total FROM orders where payment_status = 'settlement'  ")->row()->total;
        $data = $this->order_model->get_data();
		// $x = json_encode($data);
        $this->_display('admin/dashboard/index', [
            'menu_active' => 'dashboard',
            'title' => 'Dashboard',
            // 'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'product' => $product,
            'user' => $user,
            'order' => $order,
            'earning' => $earning,
            'completed' => $completed,
            'good' => $good,
            'x' => $data,
        ]);
    }

    public function logout()
    {
        $id_user = decode_id($this->session->userdata('id'));
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect(base_url('auth'), 'refresh');
    }
    public function grafik(){
     

        $data = $this->db->select("count(id) as total_penjualan, DATE_FORMAT(order_date, '%M, %Y') AS datetime, sum(grand_total) as total")
        ->group_by('datetime')
        ->get_where('orders', [
            // 'product_id' => $product_id,
            'orders.deleted_at' => null,
        
        ])->result();

    $result = [];
    foreach ($data as $data) {
        $result[] = [
            $total[] = $data->total_penjualan,
            $tgl[] = $data->datetime,
           
        ];
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
    }
}
