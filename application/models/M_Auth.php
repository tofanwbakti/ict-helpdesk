<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_login');
        $this->db->where('email', $post['email']);
        $this->db->where('password', sha1($post['password']));
        $this->db->where('status !=', 'NONAKTIF');
        $query = $this->db->get();
        return $query;
    }


    //fungsi untuk cetak session
    public function get($user_email = null)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_login', 'tb_login.email=tb_user.user_email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.kode=tb_user.user_sbu', 'left');
        $this->db->join('tb_departemen', 'tb_departemen.id_dept=tb_user.user_dept', 'left');
        if ($user_email != null) {
            $this->db->where('user_email', $user_email);
        }
        $query = $this->db->get();
        return $query;
    }
}
