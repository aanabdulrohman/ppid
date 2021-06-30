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
}
