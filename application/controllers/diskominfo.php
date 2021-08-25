<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskominfo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pem_model', 'pub');

        $data['pemohon'] = $this->pub->getPublic();


        $data['disposisi'] = $this->db->get('pengajuan_informasi')->row();
        // $data['pemohon'] = $this->db->get('pengajuan_informasi')->result_array();

        $this->form_validation->set_rules('user_id', 'Menu', 'required');
        $this->form_validation->set_rules('katpem', 'Menu', 'required');
        $this->form_validation->set_rules('info', 'Menu', 'required');
        $this->form_validation->set_rules('tujuan', 'Menu', 'required');
        $this->form_validation->set_rules('tujuan_ins', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Admin Diskominfo';
            $this->load->view('templates/header_user', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('diskominfo/diskominfo', $data);
            $this->load->view('templates/footer_user');
        } else {
            $this->db->insert('db_dispu', ['user_id' => $this->input->post('user_id')]);
            $this->db->insert('db_dispu', ['katpem' => $this->input->post('katpem')]);
            $this->db->insert('db_dispu', ['info' => $this->input->post('info')]);
            $this->db->insert('db_dispu', ['tujuan' => $this->input->post('tujuan')]);
            $this->db->insert('db_dispu', ['tujuan_ins' => $this->input->post('tujuan_ins')]);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan !
            </div>');
            redirect('diskominfo');
        }
    }

    public function kirim($id)
    {
        $this->form_validation->set_rules('id_pengajuan', 'Pengajuan', 'required');
        if ($this->form_validation->run() == false) {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pem_model', 'pub');

        // $data['pemohonn'] = $this->pub->getPublic();

        // $where = array('id' => $id);
        $data['kirim'] = $this->pub->getPengajuanInformasi($id);

        $data['title'] = 'Admin Diskominfo';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diskominfo/kirim', $data);
        $this->load->view('templates/footer_user');
        }else{
            $id_pengajuan = $this->input->post('id_pengajuan');
            $id_petugas_diskominfo = $this->session->userdata('id');
            //kirim data ke table pengajuan_instansi
            $data = [
                'id_pengajuan_informasi' => $id_pengajuan,
                'id_petugas_diskominfo' => $id_petugas_diskominfo,
                'status' => 'diproses',
                'created_pengajuan_instansi' => date('Y-m-d H:i:s')
            ];
            if($this->db->insert('pengajuan_instansi', $data)){
                //update status ke table pengajuan_informasi
                $data = array(
                    'id_petugas' => $id_petugas_diskominfo,
                    'status' => 'diproses',
                    'updated_pengajuan' => date('Y-m-d H:i:s')
                );
                
                $this->db->where('id', $id_pengajuan);
                $this->db->update('pengajuan_informasi', $data);
                $this->session->set_flashdata(['pesan'=>'Pengajuan berhasil dikirim', 'type'=>'success']);
                redirect(base_url('Diskominfo'));
            }else{
                $this->session->set_flashdata(['pesan'=>'Pengajuan gagal dikirm', 'type'=>'danger']);
                redirect(base_url('Diskominfo'));
            }
        }
    }

    public function update()
    {
        $this->load->model('Pem_model', 'pub');

        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $katpem = $this->input->post('katpem');
        $info = $this->input->post('info');
        $tujuan = $this->input->post('tujuan');
        $tujuan_ins = $this->input->post('tujuan_ins');

        $dataa = array(
            'user_id' => $user_id,
            'katpem' => $katpem,
            'info' => $info,
            'tujuan' => $tujuan,
            'tujuan_ins' => $tujuan_ins
        );

        $where = array(
            'id' => $id
        );

        // var_dump($dataa);
        // die();

        $this->db->where($where);
        // $this->db->insert('db_dispu', $dataa);
        $this->pub->kirim_data($dataa, 'db_dispu');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan !
            </div>');
        redirect('diskominfo');
    }


    public function disposisi()
    {
        $this->load->model('Pem_model', 'pub');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['instansi'] = $this->pub->getFeedbackPengajuan();
        $data['title'] = 'Disposisi Diskominfo';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diskominfo/disposisi', $data);
        $this->load->view('templates/footer_user');
    }

    public function tolak($id)
    {
        $this->load->model('Pem_model', 'pub');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tolak'] = $this->pub->getPengajuanInformasi($id);
        $data['title'] = 'Admin Diskominfo';

        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('diskominfo/tolak', $data);
            $this->load->view('templates/footer_user');
        }else{
            //update data
            $id_petugas = $this->session->userdata('id');
            $id_pengajuan = $this->input->post('id_pengajuan');
            $alasan = $this->input->post('alasan');
            $tanggal_update = date('Y-m-d H:i:s');
            $data = array(
                'id_petugas' => $id_petugas,
                'feedback' => $alasan,
                'status' => 'ditolak',
                'updated_pengajuan' => $tanggal_update
            );
            
            $this->db->where('id', $id_pengajuan);
            $query = $this->db->update('pengajuan_informasi', $data);
            if($query){
                $this->session->set_flashdata(['pesan'=>'Pengajuan berhasil ditolak', 'type'=>'success']);
                redirect(base_url('Diskominfo'));
            }else{
                $this->session->set_flashdata(['pesan'=>'Pengajuan gagal ditolak', 'type'=>'danger']);
                redirect(base_url('Diskominfo'));
            }
        }
    }
    public function lihat($id){
        $this->load->model('Pem_model', 'pub');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('pengajuan_instansi.feedback as nama_file, updated_pengajuan_instansi, ukuran_file, type_file, pengajuan_informasi.id, pengajuan_informasi.feedback');
        $this->db->from('pengajuan_instansi');
        $this->db->join('pengajuan_informasi','pengajuan_informasi.id=pengajuan_instansi.id_pengajuan_informasi');
        $this->db->where('pengajuan_instansi.id',$id);
        $data['file'] = $this->db->get()->row();
        $data['title'] = 'Lihat PDF';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diskominfo/lihat', $data);
        $this->load->view('templates/footer_user');
    }
    public function update_feedback($id, $feedback){
        $data = [
            'feedback' => $feedback,
            'status' => 'dikirim',
            'id_petugas' => $this->session->userdata('id'),
            'updated_pengajuan' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        if($this->db->update('pengajuan_informasi', $data)){
            $this->session->set_flashdata(['type'=>'success','pesan'=>'file berhasil dikirim']);
        }else {
            $this->session->set_flashdata(['type'=>'danger','pesan'=>'file gagal dikirim']);
        }
        redirect(base_url('diskominfo/disposisi'));
    }
}
