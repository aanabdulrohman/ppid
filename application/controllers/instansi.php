<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
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

        $data['pemohon2'] = $this->pub->getPublicinstansi_dispu();

        $data['title'] = 'Instansi';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('instansi/instansi', $data);
        $this->load->view('templates/footer_user');
    }

    public function inputdata()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Input Data';
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('instansi/inputdata', $data);
        $this->load->view('templates/footer_user');
    }
    public function kirimdata($id)
    {   
        $this->load->model('Pem_model', 'pub');

        $this->form_validation->set_rules('pengajuan_instansi', 'Pengajuan instansi', 'required');
        // $this->form_validation->set_rules('file', 'File', 'required');
        if($this->form_validation->run() == false){
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pemohon'] = $this->pub->getPengajuanInstansi($id);
        $data['title'] = 'Kirim Data';
        
        $this->load->view('templates/header_user', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('instansi/kirimdata', $data);
        $this->load->view('templates/footer_user');
        }else{
            $config['upload_path']          = './asset/upload/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048;
            $config['remove_spaces']        = true;
            $config['file_ext_tolower']     = true;
            $config['file_name']            = date('YmdHis').$_FILES['file']['name'];

            $this->load->library('upload', $config);
            if($this->upload->do_upload('file')){
                $uploaddata = $this->upload->data();
                $data = [
                    'id_petugas_instansi' => $this->session->userdata('id'),
                    'status' => 'dikirim',
                    'feedback' => $uploaddata['file_name'],
                    'ukuran_file' => $uploaddata['file_size'],
                    'type_file' => $uploaddata['file_ext'],
                    'updated_pengajuan_instansi' => date('Y-m-d H:i:s')
                ];
                $this->db->where('id', $this->input->post('pengajuan_instansi'));
                if($this->db->update('pengajuan_instansi', $data)){
                    $this->session->set_flashdata(['type'=>'success','pesan'=>'file berhasil dikirim']);
                }else{
                    $this->session->set_flashdata(['type'=>'danger','pesan'=>'file gagal dikirim']);
                }
                redirect(base_url('Instansi'));
            }else{
                $this->session->set_flashdata(['type'=>'danger','pesan'=>$this->upload->display_errors()]);
                redirect(base_url('Instansi'));
            }
        }
    }
}
