<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'id','code','order_date','total_price','customer_firstname','customer_lastname','customer_email','status', 'payment_status', 'created_at'); //set column field database for datatable orderable
    var $column_search = array('customer_firstname'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('orders.*, order_items.qty, order_items.product_id, order_items.name, order_items.barcode');
        $this->db->from('orders');
        $this->db->group_by('order_items.order_id');
        $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
        $this->db->where('orders.deleted_at', null);
        $this->db->where('orders.status', 'created');
        $this->db->or_where('orders.status', 'cancelled');
        $this->db->where('orders.deleted_at', null);
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
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('orders');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    private function _get_datatables_query2() {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('deleted_at', null);
        $this->db->where('status', 'confirmed');

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

    function get_datatables2() {
        $this->_get_datatables_query2();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered2() {
        $this->_get_datatables_query2();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all2() {
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get2($id =  null){
        $this->db->from('orders');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    private function _get_datatables_query3() {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('deleted_at', null);
        $this->db->where('status', 'delivered');

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

    function get_datatables3() {
        $this->_get_datatables_query3();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered3() {
        $this->_get_datatables_query3();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all3() {
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get3($id =  null){
        $this->db->from('orders');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    private function _get_datatables_query4() {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('deleted_at', null);
        $this->db->where('status', 'completed');

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

    function get_datatables4() {
        $this->_get_datatables_query4();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered4() {
        $this->_get_datatables_query3();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all4() {
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get4($id =  null){
        $this->db->from('orders');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function confirm($post){
        print_r($post);
        $params = [
            'status' => $post['status'],
            'updated_at' => date('Y-m-d H:i:s'),
          'approved_by' => decode_id($this->session->userdata('id')),
          'approved_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('orders', $params);

        // $stock = [
        //     $qty = $post['qty'],
        //     $product_id = $post['product_id'],
        // ];
        // $sql = "UPDATE inventories SET qty = qty - '$qty' WHERE product_id = '$product_id'";
        // $this->db->query($sql);
        return $result;
    }
    public function update_stock($id){
        print_r($id);
        $post = $this->db->select('*')
                   ->get_where('order_items',[
                       'order_id' => $id
                   ])->result();
                //    $result = [];
                print_r($post);
                   foreach ($post as $p) {
                    
                        $sql = "UPDATE inventories SET qty = qty - '$p->qty' WHERE product_id = '$p->product_id'";
                        $this->db->query($sql);
                    
                   
                }
       
        // return $result;
    }
    public function cancel($post){
        print_r($post);
        $params = [
            'status' => $post['status'],
            'updated_at' => date('Y-m-d H:i:s'),
            'cancelled_by' => decode_id($this->session->userdata('id')),
            'cancelled_at' => date('Y-m-d H:i:s'),
            'note' => $post['note'],
        ];

        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('orders', $params);
        return $result;
    }
    public function deliver($post){
        print_r($post);
        $params = [
            'status' => $post['status'],
            'updated_at' => date('Y-m-d H:i:s'),
          
        ];

        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('orders', $params);
        return $result;
    }

    public function del($id)
    {
        $params = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
		$this->db->where('id', decode_id($id));
		$result = $this->db->update('orders', $params);
        return $result;
    }

    public function track_number($post){
        $params = [
            'track_number' => $post['track_number'],
            'shipped_by' => decode_id($this->session->userdata('id')),
            'shipped_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('order_id', decode_id($post['id']));
        $result = $this->db->update('shipments', $params);
        return $result;
    }
    public function update_pay_order($dataupdate_order, $where){
        $this->db->update('orders',$dataupdate_order, $where);

    }
    function get_data(){
        $this->db->select("count(id) as total_penjualan, DATE_FORMAT(order_date, '%M, %Y') AS datetime, sum(grand_total) as total");
        $this->db->group_by('datetime');
        $result = $this->db->get('orders');
        if($result->num_rows() > 0){
            foreach($result->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
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