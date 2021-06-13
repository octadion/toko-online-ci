<?php
class Setting_model extends CI_Model
{
    public function data_setting(){
        $this->db->select('*');
        $this->db->from('setting');
        $this->db->where('id',2);
        return $this->db->get()->row();
    }
}