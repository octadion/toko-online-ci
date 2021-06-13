<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'barcode', 'name', 'category_name', 'unit_name','weight','price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order 
    
    private function _get_datatables_query() {
        $this->db->select('product.*, product.id as id_product, category.category_name, unit.unit_name');
        $this->db->from('product');
        // $this->db->join('auth', 'berita.user_id = auth.id', 'left');
        $this->db->join('category', 'product.category_id = category.id', 'left');
         $this->db->join('unit', 'product.unit_id = unit.id', 'left');
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
        $this->db->from('product');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id =  null){
        $this->db->from('product');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
      }

    public function add($post){
        // print_r($post);
        $params = [
          'barcode' => $post['barcode'],
          'name' => $post['name'],
          'category_id' => $post['category'],
        //   'status' => $post['status'],
          'description' => $post['description'],
          'short_desc' => $post['short_desc'],
          'price' => $post['price'],
          'weight' => $post['weight'],
          'unit_id' => $post['unit'],
          'status_barang' => $post['status_barang'],
          'status_post' => $post['status_post']
        //   'user_id' => decode_id($this->session->userdata('id')),
        ];
        $post['thumbnail'] == '' || $post['thumbnail'] == null ? null : $params['thumbnail'] = $post['thumbnail'];
        $result = $this->db->insert('product', $params);
        $product_id = $this->db->insert_id(); 
        $stock = [
            'product_id' => $product_id,
            'qty' => $post['qty'],
        ];
        $hasil_stock = $this->db->insert('inventories', $stock);
        return $result;
    }

    public function edit($post){
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'category_id' => $post['category'],
            'description' => $post['description'],
            'short_desc' => $post['short_desc'],
            'price' => $post['price'],
            'weight' => $post['weight'],
            'unit_id' => $post['unit'],
            'status_barang' => $post['status_barang'],
            'status_post' => $post['status_post']
        //   'user_id_last' => decode_id($this->session->userdata('id')),
        ];
        $post['thumbnail'] == '' || $post['thumbnail'] == null ? null : $params['thumbnail'] = $post['thumbnail'];
        // $post['title'] == '' || $post['title'] == null ? null : $params['judul'] = $post['title'];

        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('product', $params);
        return $result;
    }

    public function del($post)
    {
        $params = [
            'deleted_at' => date('Y-m-d H:i:s'),
            // 'status' => 'deleted',
        ];
		$this->db->where('id', $post["id"]);
		$result = $this->db->update('product', $params);
        return $result;
    }

    public function edit_status_barang($post){
        $params = [
            'status_barang' => $post['status_barang'],
            'updated_at' => date('Y-m-d H:i:s'),
        //   'user_id_last' => decode_id($this->session->userdata('id')),
        ];

        $this->db->where('id', decode_id($post['id']));
        $result = $this->db->update('product', $params);
        return $result;
    }

    public function check_duplicate_barcode($barcode)
    {
        $this->db->from('product');
        $this->db->where('barcode', $barcode);
        $query = $this->db->get();
        if($query->num_rows()>0){
            // return $query->row();
            return true;
        }else{    
            // return $query->row();
            return false;
        }
    }

    public function check_used_kategori($kategori_id){
        $query = $this->db->where('category_id', $kategori_id);
        if($query->num_rows()>0){
            return true;
        }else{    
            return false;
        }
    }

    // still unfinished
    public function check_duplicate_slug($slug){
        $query = $this->db->where('slug', $slug);
        if($query->num_rows()>0){
            return true;
        }else{    
            return false;
        }
    }


    // still unfinished
    public function slug_update($slug){
        $sql = "SELECT MAX(SUBSTR(slug,-3,3)) AS num_slug
                FROM berita
                WHERE slug LIKE '".$slug."%' ";
        $query = $this->db->query($sql);
        $row = $query->row();

        if($query->num_rows() > 0){
            if(ctype_digit($row->num_slug)){
                $n = ((int)$row->num_slug) + 1;
                $no = sprintf("%'.03d", $n);
            } else{
                $no = "001";
            }
        }
        $new_slug = 'lol'.'-'.$no;
        return $row->num_slug;
    }
}