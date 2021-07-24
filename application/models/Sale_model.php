<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sale_model extends CI_Model
{
    public function daily_report($tanggal, $bulan, $tahun){
        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('orders','orders.id = order_items.order_id', 'left');
        $this->db->join('product', 'product.id = order_items.product_id', 'left');
        $this->db->where('DAY(orders.order_date)', $tanggal);
        $this->db->where('MONTH(orders.order_date)', $bulan);
        $this->db->where('YEAR(orders.order_date)', $tahun);
        $this->db->where('orders.payment_status','settlement');
        // $this->db->or_where('orders.status','delivered');
        // $this->db->or_where('orders.status','completed');
        return $this->db->get()->result();
    }
    public function monthly_report($bulan, $tahun){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('MONTH(order_date)', $bulan);
        $this->db->where('YEAR(order_date)', $tahun);
        $this->db->where('payment_status','settlement');
        // $this->db->or_where('status','delivered');
        // $this->db->or_where('status','completed');
        return $this->db->get()->result();
    }
    public function yearly_report($tahun){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('YEAR(order_date)', $tahun);
        $this->db->where('payment_status','settlement');
        return $this->db->get()->result();
    }
}