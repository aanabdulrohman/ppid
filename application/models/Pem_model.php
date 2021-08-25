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
                JOIN `kategori_pem` ON `pengajuan_informasi`.`katpem` = `kategori_pem`.`id`
                JOIN `instansi` ON `pengajuan_informasi`.`tujuan_ins` = `instansi`.`id`
                JOIN `user` ON `pengajuan_informasi`.`user_id` = `user`.`id`
                where `pengajuan_informasi`.`status` = 'menunggu' OR `pengajuan_informasi`.`status` = 'diproses' OR `pengajuan_informasi`.`status` = 'ditolak'";
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
        $id_instansi = $this->session->userdata('id_instansi');
        $query = "SELECT `pengajuan_instansi`.*, `pengajuan_informasi`.`info`, `pengajuan_informasi`.`tujuan`, `pengajuan_informasi`.`katpem`, `kategori_pem`.`katpem` FROM `pengajuan_instansi` 
        JOIN `pengajuan_informasi` ON `pengajuan_informasi`.`id` = `pengajuan_instansi`.`id_pengajuan_informasi`
        JOIN `kategori_pem` ON `kategori_pem`.`id` = `pengajuan_informasi`.`katpem` 
        WHERE pengajuan_instansi.`status` = 'diproses' AND `pengajuan_informasi`.`tujuan_ins`=$id_instansi ";
        return $this->db->query($query)->result_array();
    }
    public function getPengajuanInstansi($id){
        $id_instansi = $this->session->userdata('id_instansi');
        $query = "SELECT `pengajuan_instansi`.*, `pengajuan_informasi`.`info`, `pengajuan_informasi`.`tujuan`, `pengajuan_informasi`.`katpem`, `kategori_pem`.`katpem`, `user`.`name` FROM `pengajuan_instansi` 
        JOIN `pengajuan_informasi` ON `pengajuan_informasi`.`id` = `pengajuan_instansi`.`id_pengajuan_informasi`
        JOIN `kategori_pem` ON `kategori_pem`.`id` = `pengajuan_informasi`.`katpem` 
        JOIN `user` ON `user`.`id` = `pengajuan_informasi`.`user_id` 
        WHERE pengajuan_instansi.`status` = 'diproses' AND `pengajuan_informasi`.`tujuan_ins`=$id_instansi AND `pengajuan_instansi`.`id` = $id";
        return $this->db->query($query)->row();
    }
    public function getPengajuanInformasi($id){
        $query = "SELECT `pengajuan_informasi`.*, `kategori_pem`.`katpem`, `instansi`.`nama_instansi`, `user`.`name`
                FROM `pengajuan_informasi` 
                JOIN `kategori_pem` ON `pengajuan_informasi`.`katpem` = `kategori_pem`.`id`
                JOIN `instansi` ON `pengajuan_informasi`.`tujuan_ins` = `instansi`.`id`
                JOIN `user` ON `pengajuan_informasi`.`user_id` = `user`.`id`
                where `pengajuan_informasi`.`id` = $id ";
        return $this->db->query($query)->row();
    }
    public function getFeedbackPengajuan(){
        $query = "SELECT `pengajuan_instansi`.*, `pengajuan_informasi`.`info`, `pengajuan_informasi`.`tujuan`, `pengajuan_informasi`.`katpem`, `kategori_pem`.`katpem`, `user`.`name`, `instansi`.`nama_instansi` FROM `pengajuan_instansi` 
        JOIN `pengajuan_informasi` ON `pengajuan_informasi`.`id` = `pengajuan_instansi`.`id_pengajuan_informasi`
        JOIN `kategori_pem` ON `kategori_pem`.`id` = `pengajuan_informasi`.`katpem` 
        JOIN `instansi` ON `instansi`.`id` = `pengajuan_informasi`.`tujuan_ins` 
        JOIN `user` ON `user`.`id` = `pengajuan_informasi`.`user_id` 
        WHERE pengajuan_instansi.`status` = 'dikirim'";
        return $this->db->query($query)->result_array();
    }
}
