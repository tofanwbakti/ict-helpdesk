<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_BeritaAcara extends CI_Model
{
    public function get_BA_bynoba($noba)
    {
        $hasil = $this->db->query("SELECT * FROM tb_berita_acara_detail WHERE no_ba_detail='$noba'");
        return $hasil->result();
        // if ($hasil->num_rows > 0) {
        //     foreach ($hasil->result() as $data) {
        //         $hasil = array(
        //             'equipment_detail' => $data->equipment_detail,
        //             'sn_detail'        => $data->sn_detail,
        //             'condition_detail' => $data->condition_detail,
        //             'recommendation'   => $data->recommendation
        //         );
        //     }
        // }
        // return $hasil;
    }

    public function get_ask_apv($noba)
    {
        $hasil = $this->db->query("SELECT * FROM tb_berita_acara_detail WHERE no_ba_detail='$noba'");
        return $hasil->result();
    }

    public function get_historyBA_bynoba($noba)
    {
        $hasil = $this->db->query("SELECT * FROM tb_berita_acara_history WHERE no_ba='$noba' ");
        return $hasil->result();
    }

    public function get_item_by_kode($itemid)
    {
        $hsl = $this->db->query("SELECT * FROM tb_berita_acara_detail WHERE item_id='$itemid'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'equipment_detail' => $data->equipment_detail,
                    'sn_detail' => $data->sn_detail,
                    'condition_detail' => $data->condition_detail,
                    'recommendation'    => $data->recomendation
                );
            }
        }
        return $hasil;
    }

    // Ask Approval
    public function ask_Approval($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Save history BA
    public function save_history_BA($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }

    // Save approver
    public function save_approver($data, $table)
    {
        $this->db->insert($table, $data);
        return $data;
    }

    // Hitung total doc BA

}
