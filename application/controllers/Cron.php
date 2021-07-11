<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

public function update_db(){
    $this->db->select('status');
        $this->db->from('orders');
        $this->db->where('status','delivered');
        $status = $this->db->get()->result();
        foreach ($status as $p) {
                    
            $sql = "UPDATE orders SET status = 'completed' WHERE status = 'delivered'";
            $this->db->query($sql);
        
       
        }
    }
}