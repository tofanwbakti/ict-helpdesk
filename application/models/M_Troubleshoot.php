<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Troubleshoot extends CI_Model
{
    public function getDataTicket($tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.input_tgl', $tahun);
        $this->db->where('tb_helpdesk.jenis_komplain', "TS");
        $this->db->order_by('tb_helpdesk.seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get Data Helpdeks That Filtered Periode
    public function getDataTicketFiltered($awal, $akhir, $category)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        if ($akhir == "0") {
            $this->db->like('tb_helpdesk.input_tgl', $awal);
        } else {
            $this->db->where('tb_helpdesk.input_tgl BETWEEN "' . $awal . '"AND"' . $akhir . '"');
        }
        $this->db->where('tb_helpdesk.jenis_komplain', $category);
        $this->db->order_by('tb_helpdesk.seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get no ticket for combobox propose BA
    public function getNoTicket($tahun)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->like('update_tgl', $tahun);
        $this->db->where('jenis_komplain', "TS");
        $this->db->where('doc_ba !=', "Y");
        $this->db->order_by('seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get Filtered no ticket for combobox propose BA
    public function getNoTicketFiltered($awal, $akhir, $category)
    {
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        if ($akhir == "0") {
            $this->db->like('input_tgl', $awal);
        } else {
            $this->db->where('input_tgl BETWEEN "' . $awal . '"AND"' . $akhir . '"');
        }
        $this->db->where('tb_helpdesk.jenis_komplain', $category);
        $this->db->where('doc_ba !=', "Y");
        $this->db->order_by('seq_no', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Add History Helpdesk
    public function addHistoryHelpdesk($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }

    public function updateTask($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('user_email', "ASC");
        $record = $this->db->get();
        return $record->result_array();
    }

    // #BERITA ACARA
    // Add Berita acara
    public function proposeBA($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }
}
