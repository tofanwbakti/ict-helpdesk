<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Helpdesk extends CI_Model
{

    // Load User Email
    public function loadEmailUser()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_login', 'tb_login.email=tb_user.user_email', 'left');
        $this->db->where('tb_user.user_email !=', 'admin@biasmandirigroup.id');
        $this->db->where('tb_login.status', "AKTIF");
        $this->db->order_by('tb_user.user_email', "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }

    // Load SBU
    public function loadSbu()
    {
        $this->db->select('*');
        $this->db->order_by('nama_sbu', "ASC");
        $query = $this->db->get('tb_sbu');
        return $query->result_array();
    }
    // Load DEPARTEMEN
    public function loadDept()
    {
        $this->db->select('*');
        $this->db->order_by('nama_dept', "ASC");
        $query = $this->db->get('tb_departemen');
        return $query->result_array();
    }

    // Load Type of GOODS
    public function loadGoods()
    {
        $this->db->select('*');
        $this->db->order_by('satuan_name', "ASC");
        $query = $this->db->get('tb_satuan_barang');
        return $query->result_array();
    }

    // Load Version
    public function loadVersion()
    {
        $this->db->select('*');
        $this->db->order_by('tb_version_log.seq_no', "ASC");
        $query = $this->db->get('tb_version_log');
        return $query->result_array();
    }

    // Load Data User untuk Form
    public function getUser($postData = array())
    {
        $response = array();

        if (isset($postData['email'])) {
            // select record
            $this->db->select('*');
            $this->db->from('tb_user');
            $this->db->join('tb_sbu', 'tb_sbu.kode=tb_user.user_sbu', 'LEFT');
            $this->db->join('tb_departemen', 'tb_departemen.id_dept=tb_user.user_dept', 'LEFT');
            $this->db->where('user_email', $postData['email']);
            $record = $this->db->get();
            $response = $record->result_array();
        }
        return $response;
    }

    // Load DB Ticket
    public function getDbTicket($postData = array())
    {
        $response = array();

        if (isset($postData['ticket'])) {
            // select record
            $this->db->select('*');
            $this->db->from('tb_helpdesk_history');
            // $this->db->join('tb_sbu', 'tb_sbu.kode=tb_user.user_sbu', 'LEFT');
            // $this->db->join('tb_departemen', 'tb_departemen.id_dept=tb_user.user_dept', 'LEFT');
            $this->db->where('no_ticket', $postData['ticket']);
            $record = $this->db->get();
            $response = $record->result_array();
        }
        return $response;
    }

    // // Add Ticket
    public function saveTicketTS($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }

    // Add History Helpdesk
    public function addHistoryHelpdesk($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }
}
