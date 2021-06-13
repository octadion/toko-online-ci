<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'product_id','qty', 'created_at'); //set column field database for datatable orderable
    var $column_search = array('id'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('inventories.*, inventories.id as id_inventory, product.barcode, product.name');
        $this->db->from('inventories');
        $this->db->join('product', 'product.id = inventories.product_id', 'left');
        $this->db->where('product.deleted_at', null);

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
        $this->db->from('inventories');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('inventoriess');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
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
