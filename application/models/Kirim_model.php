<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirim_model extends CI_Model
{
    public function getKirimById($id)
    {
        return $this->db->get_where('pengajuan_informasi', ['id' => $id])->row_array();
    }
}
