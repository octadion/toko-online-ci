<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akun_model extends CI_Model
{
    
    var $column_order = array(null, 'email', 'first_name', 'last_name'); //set column field database for datatable orderable
    var $column_search = array('email', 'first_name', 'last_name'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order 

    private function _get_datatables_query() {
        $this->db->select('user.*, ref_role.name');
        $this->db->from('user');
        $this->db->join('ref_role', 'user.role_id = ref_role.id', 'left');
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
        $this->db->from('user');
        return $this->db->count_all_results();
    }
    // end datatables
    public function get($id =  null){
        $this->db->from('user');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
      }
      
    public function del($id)
    {
        $params = [
            'deleted_at' => date('Y-m-d H:i:s'),
            
        ];
		$this->db->where('id', $id);
		$result = $this->db->update('user', $params);
        return $result;
    }
    public function edit($post){
        print_r($post);
        $params = [
          'first_name' => $post['first_name'],
          'last_name' => $post['last_name'],
          'email' => $post['email'], 
          'phone' => $post['phone'],
          'alamat'=>$post['alamat'],
        // 'role_id'=>$post['role_id'],  
        'edited_at' => date('Y-m-d H:i:s'),

        ];
        $this->db->where('id',  decode_id($post['id']));
        $result = $this->db->update('user', $params);
        return $result;
    }
    public function add($post){
        print_r($post);
        $params = [
          'username' => $post['username'],
          'name' => $post['name'],
          'email' => $post['email'],
      
        'telepon' => $post['telepon'],
        'alamat' => $post['alamat'],

          'password' => $this->auth_model->get_password($post['password']),
          'role_id'=> $post['role_id'],
        //   'foto_name'=> $post['foto_name'],
        'foto_path' => $post['path_min'],
        'foto_name' => $post['name'],
        ];
        $result = $this->db->insert('auth', $params);
        return $result;
    }
    public function check()
    {
        $email = $this->input->post('email');
        $query = $this->db->select('email')
                 ->from('user')
                 ->where('email', $email)
                 ->get();
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function edit_pw($post){
        $params = [
        'password' => $this->auth_model->get_password($post['password']),
        'edited_at' => date('Y-m-d H:i:s'),

        ];
        $this->db->where('id', $post['id']);
        $result = $this->db->update('auth', $params);
        return $result;
    }
      
    public function check_pw_lama()
    {
        $password = $this->auth_model->getpw($this->input->post('password'));
        $query = $this->db->select('password')
                 ->from('auth')
                 ->where('password',$password)
                 ->get();
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function check_pw_baru()
    {
        $password = $this->auth_model->get_password($this->input->post('password'));
        $query = $this->db->select('password')
                 ->from('auth')
                 ->where('password', $password)
                 ->get();
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_user($id =  null){
        $this->db->from('user');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
      }

}

