<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loggen_in();
    }
    public function index()
    {

        $data['title'] = 'Dashboard User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['katpem'] = $this->db->get('kategori_pem')->result_array();
        $data['nama_instansi'] = $this->db->get('instansi')->result_array();

        $this->form_validation->set_rules('katpem', 'Kategori Pemohon', 'required');
        $this->form_validation->set_rules('info', 'Informasi yang dibutuhkan', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan penggunaan informasi', 'required');
        $this->form_validation->set_rules('tujuan_ins', 'Tujuan instansi');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer_user');
        } else {
            $data = [

                'user_id' => $this->input->post('user_id'),
                'katpem' => $this->input->post('katpem'),
                'info' => $this->input->post('info'),
                'tujuan' => $this->input->post('tujuan'),
                'tujuan_ins' => $this->input->post('tujuan_ins')
            ];
            $this->db->insert('pengajuan_informasi', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Submenu baru berhasil ditambahkan !
            </div>');
            redirect('user');
        }
    }

    public function profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'My Profile';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer_user');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'File name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $this->load->view('templates/header_user', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer_user');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                // filter
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './asset/img/profil/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //untuk menimpa gambar lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'new.png') {
                        unlink(FCPATH . 'asset/img/profil/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Profile kamu berhasil di update !</div>');
            redirect('user/profile');
        }
    }

    public function ubahpassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_lama', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('password_baru1', 'New Password', 'required|trim|min_length[3]|matches[password_baru2]');
        $this->form_validation->set_rules('password_baru2', 'Confirm New Password', 'required|trim|min_length[3]|matches[password_baru1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Rubah Password';
            $this->load->view('templates/header_user', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubahpassword', $data);
            $this->load->view('templates/footer_user');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');
            // jika password lama salah
            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama salah !</div>');
                redirect('user/ubahpassword');
            } else {
                // jika password nya sama dengan password lama
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password baru anda sama dengan password lama. Harus beda !</div>');
                    redirect('user/ubahpassword');
                } else {
                    // jika password benar
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password berhasil diubah !</div>');
                    redirect('user/ubahpassword');
                }
            }
        }
    }

    public function permohonan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pem_model', 'pem');

        $data['pemohon'] = $this->pem->getPem();

        // $data['pemohon'] = $this->db->get('pengajuan_informasi')->result_array();
        $data['title'] = 'My Profile';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/permohonan', $data);
        $this->load->view('templates/footer_user');
    }


    public function permohonan_admin()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pem_model', 'pub');

        $data['pemohon'] = $this->pub->getPublic();

        // $data['pemohon'] = $this->db->get('pengajuan_informasi')->result_array();
        $data['title'] = 'My Profile';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/permohonan', $data);
        $this->load->view('templates/footer_user');
    }
}
