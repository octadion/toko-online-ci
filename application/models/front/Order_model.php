<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function save_order($data){
        $this->db->insert('orders',$data);
    }

    public function save_order_items($data){
        $this->db->insert('order_items',$data);
    }
    public function save_shipment($data){
        $this->db->insert('shipments',$data);
    }
    public function update_pay_order($dataupdate_order, $where){
        $this->db->update('orders',$dataupdate_order, $where);

    }

    public function unpaid($id = null){
        $this->db->select('*');
        $this->db->from('orders');
        // $this->db->where('payment_status','unpaid');
        $this->db->where('user_id',decode_id($this->session->userdata('id')));
        $this->db->where('id',$id);
        $this->db->order_by('id','desc');
        return $this->db->get()->result();
    }
    public function paid(){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status','created');
        $this->db->where('user_id',decode_id($this->session->userdata('id')));
        $this->db->or_where('status','cancelled');
        $this->db->where('user_id',decode_id($this->session->userdata('id')));
        $this->db->order_by('id','desc');
        return $this->db->get()->result();
    }

    public function getproduct($id = null){
        $this->db->select('orders.*, order_items.qty, order_items.name,order_items.barcode, order_items.base_price, order_items.base_total, order_items.product_id');
        $this->db->join('order_items', 'orders.id = order_items.order_id', 'left');
        // $this->db->where('payment_status','unpaid');
        // $this->db->where('user_id',decode_id($this->session->userdata('id')));
        $this->db->where([
            'orders.user_id' => decode_id($this->session->userdata('id')),
            // 'orders.payment_status' => 'unpaid',
            'orders.id' => $id,
        ]);
        $this->db->from('orders');
        return $this->db->get()->result();
    }
}