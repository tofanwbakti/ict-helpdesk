<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_MasterData extends CI_Model
{
    public function getDataUser()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_login', 'tb_login.email=tb_user.user_email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.kode=tb_user.user_sbu', 'left');
        $this->db->join('tb_departemen', 'tb_departemen.id_dept=tb_user.user_dept', 'left');
        $this->db->order_by('tb_user.user_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    // Get database avatar
    public function getAvatar()
    {
        $this->db->order_by('seq_no', "ASC");
        $query = $this->db->get('tb_avatar');
        return $query->result_array();
    }

    // Update Picture
    public function updatePicture($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Update Password
    public function updatePassword($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    // Update Level
    public function updateLevel($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
