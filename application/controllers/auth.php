<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('templates/nav');
        $this->load->view('auth/home');
        $this->load->view('templates/footer');
    }
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Selamat Datang';
            $this->load->view('templates/header_login', $data);
            $this->load->view('auth/masuk');
            $this->load->view('templates/footer_login');
        } else {
            $this->_loginn();
        }
    }

    private function _loginn()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // usernya ada
            if ($user) {
                // jika usernya aktif
                if ($user['is_active'] == 1) {
                    // cek password
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role'  => $user['role']
                        ];
                        $this->session->set_userdata($data);
                        // filter admin/user
                        if ($user['role'] == 1) {
                            redirect('admin');
                        } else {
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah !
                        </div>');
                        redirect('auth/login');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email belum di aktifasi !
                    </div>');
                    redirect('auth/login');
                }
            }
        } else {
            // usernya ga ada
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email tidak terdaftar !
          </div>');
            redirect('auth/login');
        }
    }

    public function registration()
    {
        // nama
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        // email
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar !'
        ]);
        // password
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password tidak sesuai',
            'min_length' => 'password terlalu pendek'
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar PPID';
            $this->load->view('templates/header_login', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/footer_login');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'new.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat
        Akun anda sudah terdaftar !
          </div>');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kamu berhasil logout !
          </div>');
        redirect('auth/login');
    }
}
