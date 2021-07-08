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
        // agar tiidak bisa logout lewat url
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->load->view('templates/nav');
        $this->load->view('auth/home');
        $this->load->view('templates/footer');
    }
    public function login()
    {

        // agar tidak bisa logout lewat url
        if ($this->session->userdata('email')) {
            redirect('user');
        }

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
                            'role'  => $user['role'],
                            'id'  => $user['id'],
                            'id_instansi'  => $user['id_instansi']
                        ];
                        $this->session->set_userdata($data);
                        // filter admin/user/instansi
                        if ($user['role'] == 1) {
                            redirect('admin');
                        } elseif ($user['role'] == 2) {
                            redirect('user');
                        } elseif ($user['role'] == 3) {
                            redirect('instansi');
                        } else {
                            redirect('diskominfo');
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
        // agar tidak bisa logout lewat url
        if ($this->session->userdata('email')) {
            redirect('user');
        }

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
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'new.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // menyiapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat
        Akun anda sudah terdaftar. Silahkan aktifasi akun anda !
          </div>');
            redirect('auth/login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'hw8722888@gmail.com',
            'smtp_pass' => 'Dimetaabadi100599',
            'smtp_port' => '465',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('hw8722888@gmail.com', 'PPID KOTA BANJAR');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun PPID Kota Banjar');
            $this->email->message('Masuk ke link berikut untuk mengaktifkan akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifasi</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Akun PPID Kota Banjar');
            $this->email->message('Masuk ke link berikut untuk riset akun anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">' . $email . ' berhasil aktifasi. silahkan login !
                    </div>');
                    redirect('auth/login');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun aktifasi gagal, token telah hangus !
                    </div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun aktifasi gagal, token salah !
                </div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun aktifasi gagal, email salah !
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

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/header_login', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/footer_login');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active => 1'])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Cek email untuk mengubah password !
                </div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email belum terdatar atau belum di aktifasi !
                </div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Reset password gagal. Token salah !
            </div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Reset password gagal. Email salah !
            </div>');
            redirect('auth/login');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Rubah Password';
            $this->load->view('templates/header_login', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/footer_login');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password berhasil diubah, silahkan loin.
            </div>');
            redirect('auth/login');
        }
    }
}
