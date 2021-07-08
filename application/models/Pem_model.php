<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pem_model extends CI_Model
{

    public function getPem()
    {
        $user_id = $this->session->userdata('id');
        $query = "SELECT `pengajuan_informasi`.*, `kategori_pem`.`katpem`, `instansi`.`nama_instansi`, `user`.`name`
                FROM `pengajuan_informasi` 
                JOIN `kategori_pem` 
                ON `pengajuan_informasi`.`katpem` = `kategori_pem`.`id`
                JOIN `instansi` 
                ON `pengajuan_informasi`.`tujuan_ins` = `instansi`.`id`
                JOIN `user` 
                ON `pengajuan_informasi`.`user_id` = `user`.`id`
                WHERE `pengajuan_informasi`.`user_id` = '$user_id'";
        return $this->db->query($query)->result_array();
    }
    public function getPublic()
    {
        $user_id = $this->session->userdata('id');
        $query = "SELECT `pengajuan_informasi`.*, `kategori_pem`.`katpem`, `instansi`.`nama_instansi`, `user`.`name`
                FROM `pengajuan_informasi` 
                JOIN `kategori_pem` 
                ON `pengajuan_informasi`.`katpem` = `kategori_pem`.`id`
                JOIN `instansi` 
                ON `pengajuan_informasi`.`tujuan_ins` = `instansi`.`id`
                JOIN `user` 
                ON `pengajuan_informasi`.`user_id` = `user`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function getKirimById($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function kirim_data($dataa, $table)
    {
        $this->db->insert($table, $dataa);
    }

    public function getPublicinstansi_dispu()
    {
        $user_id = $this->session->userdata('id_instansi');
        $query = "SELECT `db_dispu`.*, `kategori_pem`.`katpem`, `instansi`.`nama_instansi`, `user`.`name`
                FROM `db_dispu` 
                JOIN `kategori_pem` 
                ON `db_dispu`.`katpem` = `kategori_pem`.`id`
                JOIN `instansi` 
                ON `db_dispu`.`tujuan_ins` = `instansi`.`id`
                JOIN `user` 
                ON `db_dispu`.`user_id` = `user`.`id` 
                WHERE `instansi`.`id` = $user_id";
        return $this->db->query($query)->result_array();
    }
}
