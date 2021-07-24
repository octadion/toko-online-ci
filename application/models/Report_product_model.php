<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_product_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'name','barcode', 'qty','base_total', 'code','stock','created_at',); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('order_items.*, order_items.id as id_orderitem, inventories.qty as stock, orders.status');
        $this->db->from('order_items');
        $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        $this->db->join('orders', 'orders.id = order_items.order_id', 'left');
        $this->db->where('orders.payment_status', 'settlement');
        if($_POST["start_date"] && $_POST["end_date"])
        {
        $this->db->where('order_items.created_at BETWEEN "'.$_POST["start_date"] . '" and "'.$_POST["end_date"] .'"');
        }
        // $this->db->or_where('orders.status', 'delivered');
        // if($_POST["start_date"] && $_POST["end_date"])
        // {
        // $this->db->where('order_items.created_at BETWEEN "'.$_POST["start_date"] . '" and "'.$_POST["end_date"] .'"');
        // }
        // $this->db->or_where('orders.status', 'completed');
        // if($_POST["start_date"] && $_POST["end_date"])
        // {
        // $this->db->where('order_items.created_at BETWEEN "'.$_POST["start_date"] . '" and "'.$_POST["end_date"] .'"');
        // }
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
            
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all() {
        $this->db->from('order_items');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('order_items');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function rangeDate($start_date, $end_date){
        $start_date = $start_date . ' 00:00:00';
        $end_date = $end_date . ' 23:59:59';
        print_r($start_date);
        print_r($end_date);
        $query = $this->db->select('order_items.*, order_items.id as id_orderitem, inventories.qty as stock, orders.status')
            // ->from('order_items')
            ->join('inventories', 'inventories.product_id = order_items.product_id', 'left')
            ->join('orders', 'orders.id = order_items.order_id', 'left')
            ->where('orders.status', 'confirmed')
            // ->where('order_items.created_at >=', $start_date)
            ->where('order_items.created_at BETWEEN "'.$start_date. '" and "'.$end_date.'"')
            // ->group_by($this->tables['invent_sales'].".inv_cno")
            // ->group_by($this->tables['invent_inv'].".inv_cno")
            // ->group_by($this->tables['invent_inv'].".timestamp")
            ->get('order_items');
    
        return $query->result_array();
        print_r($query);
    }

    public function penyesuaian($post){
        $params = [
            'qty' => $post['qty'],
            // 'shipped_by' => decode_id($this->session->userdata('id')),
            // 'shipped_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('inventories', $params);
        return $result;
    }

    public function penambahan($post){
        $qty = $post['qty'];
        $id = decode_id($post['id']);
        $sql = "UPDATE inventories SET qty = qty + '$qty' WHERE id = '$id'";
        $this->db->query($sql);
    }

    public function pengurangan($post){
        $qty = $post['qty'];
        $id = decode_id($post['id']);
        $sql = "UPDATE inventories SET qty = qty - '$qty' WHERE id = '$id'";
        $this->db->query($sql);
    }
}
