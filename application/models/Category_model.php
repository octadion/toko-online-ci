<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'category_name', 'created_at'); //set column field database for datatable orderable
    var $column_search = array('category_name'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('deleted_at', null);

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
        $this->db->from('category');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('category');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_view($id =  null){
        $this->db->from('category');
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
          'category_name' => $post['kategori_judul'],
        ];
        $result = $this->db->insert('category', $params);
        return $result;
    }

    public function edit($post){
        print_r($post);
        $params = [
          'category_name' => $post['kategori_judul'],
          'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', decode_id($post['kategori_id']));
        $result = $this->db->update('category', $params);
        return $result;
    }

    public function del($id)
    {
        $params = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
		$this->db->where('id', decode_id($id));
		$result = $this->db->update('category', $params);
        return $result;
    }

    public function check_duplicate_category($category)
    {
        $this->db->from('category');
        $this->db->where('category_name', $category);
        $query = $this->db->get();
        if($query->num_rows()>0){
            // return $query->row();
            return true;
        }else{    
            // return $query->row();
            return false;
        }
    }

    public function check_duplicate_category_id($id)
    {
        $this->db->from('product');
        $this->db->where('category_id', decode_id($id));
        $query = $this->db->get();
        if($query->num_rows()>0){
            // return $query->row();
            return true;
        }else{    
            // return $query->row();
            return false;
        }
    }
}