<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model','chart');
        check_admin();
    }


    public function index()
    {
        $this->_display('admin/grafik/index', [
            'menu_active' => 'grafik',    
            'title' => 'Chart',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }
    public function data(){
     
            $start_date= $this->input->post('start_date');
            $end_date= $this->input->post('end_date');
            $tipe = $this->input->post('tipe');
            // print_r($end_date);
            // print_r($start_date);
            // print_r($tipe);
            if($tipe == 'penjualan'){
            $hasil = $this->chart->get_chart_data($start_date, $end_date);
            
            $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($hasil));
            }
            else if($tipe=='terjual'){
                $results = $this->chart->get_chart_data_sold($start_date, $end_date);
            
                $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($results));
            }
            else if($tipe=='terlaris'){
                $terlaris = $this->chart->get_chart_data_laris($start_date, $end_date);
            
                $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($terlaris));
            }

      
    }

    
}
