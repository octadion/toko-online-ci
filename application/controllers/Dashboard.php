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
		// $sekolah = $this->db->query("SELECT * FROM sekolah where aktif = '1' ")->num_rows();
        $this->_display('admin/dashboard/index', [
            'menu_active' => 'dashboard',
            'title' => 'Dashboard',
            // 'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'product' => $product,
            'user' => $user,
        ]);
    }
}
