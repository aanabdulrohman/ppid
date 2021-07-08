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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pem_model', 'pub');

        $data['pemohonn'] = $this->pub->getPublic();

        $where = array('id' => $id);
        $data['kirimm'] = $this->pub->getKirimById($where, 'pengajuan_informasi')->result();

        $data['title'] = 'Admin Diskominfo';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diskominfo/kirim', $data);
        $this->load->view('templates/footer_user');
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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Disposisi Diskominfo';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diskominfo/disposisi', $data);
        $this->load->view('templates/footer_user');
    }
}
