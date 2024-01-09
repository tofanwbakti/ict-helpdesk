<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
    public function getDataTicket($tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        $this->db->join('tb_departemen', 'tb_departemen.nama_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.update_tgl', $tahun);
        $this->db->order_by('tb_helpdesk.seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }


    // Search Ticket
    public function searchTicket($noticket)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        $this->db->join('tb_departemen', 'tb_departemen.nama_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.no_ticket', $noticket);
        $this->db->order_by('tb_helpdesk.seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
