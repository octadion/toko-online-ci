<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sale_model');
        check_admin();
    }
    public function index()
    {
        $this->_display('admin/sale/index', [
            'menu_active' => 'sale',    
            'title' => 'Sales',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    public function daily(){
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $this->_display('admin/sale/daily/index', [
            'menu_active' => 'sale',    
            'title' => 'Sales',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'report' => $this->sale_model->daily_report($tanggal, $bulan, $tahun),
        ]);
    }

    public function monthly(){
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $this->_display('admin/sale/monthly/index', [
            'menu_active' => 'sale',    
            'title' => 'Sales',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'monthly' => $this->sale_model->monthly_report($bulan, $tahun),
        ]);
    }
    public function yearly(){
        $tahun = $this->input->post('tahun');
        $this->_display('admin/sale/yearly/index', [
            'menu_active' => 'sale',    
            'title' => 'Sales',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'yearly' => $this->sale_model->yearly_report($tahun),
        ]);
    }

}