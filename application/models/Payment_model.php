<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'order_id','gross_amount','payment_type','vendor_name','va_number','payment_time','status', 'created_at'); //set column field database for datatable orderable
    var $column_search = array('vendor_name'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('deleted_at', null);
        if($_POST["start_date"] && $_POST["end_date"])
        {
        $this->db->where('payment_time BETWEEN "'.$_POST["start_date"] . '" and "'.$_POST["end_date"] .'"');
        }
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
        $this->db->from('payments');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('payments');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_view($id =  null){
        $this->db->from('payments');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $this->db->where('deleted_at', null);
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        // print_r($post);
        $params = [
          'unit_name' => $post['unit_judul'],
        ];
        $result = $this->db->insert('unit', $params);
        return $result;
    }

    public function edit($post){
        print_r($post);
        $params = [
          'unit_name' => $post['unit_judul'],
          'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', decode_id($post['unit_id']));
        $result = $this->db->update('unit', $params);
        return $result;
    }

    public function del($id)
    {
        $params = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
		$this->db->where('id', decode_id($id));
		$result = $this->db->update('unit', $params);
        return $result;
    }

    public function check_duplicate_unit($unit)
    {
        $this->db->from('unit');
        $this->db->where('unit_name', $unit);
        $query = $this->db->get();
        if($query->num_rows()>0){
            // return $query->row();
            return true;
        }else{    
            // return $query->row();
            return false;
        }
    }

    public function check_duplicate_unit_id($id)
    {
        $this->db->from('product');
        $this->db->where('unit_id', decode_id($id));
        $query = $this->db->get();
        if($query->num_rows()>0){
            // return $query->row();
            return true;
        }else{    
            // return $query->row();
            return false;
        }
    }

    public function update($dataupdate, $where){
        $this->db->update('payments',$dataupdate,$where);
        return $this->db->affected_rows();
    }
}