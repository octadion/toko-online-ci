<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $product = $this->db->query("SELECT * FROM product where deleted_at = null ")->num_rows();
		$user = $this->db->query("SELECT * FROM user where deleted_at = null ")->num_rows();
        $order = $this->db->query("SELECT * FROM product where deleted_at = null ")->num_rows();
        print_r($order);
        // $earning = $this->db->query("SELECT sum(base_total) FROM order_items where deleted_at = null ")->num_rows();
		// $sekolah = $this->db->query("SELECT * FROM sekolah where aktif = '1' ")->num_rows();
        $this->_display('admin/dashboard/index', [
            'menu_active' => 'dashboard',
            'title' => 'Dashboard',
            'role' => $this->session->userdata('role'),
            'order' => $order,
            // 'earning' => $earning,
            'product' => $product,
            'user' => $user,
           
        ]);
        
    }
}
