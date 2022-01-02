<?php defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load(array('auth', 'ion_auth'), 'indonesian');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('admin/page/konsep_putusan', 'refresh');
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function login()
    {

        $data['title'] = 'AMORA | Login';

        if ($this->ion_auth->logged_in()) {
            redirect('/');
        }

        $this->form_validation->set_rules(
            'identity',
            'Nama Pengguna',
            'required',
            array('required' => 'Nama Pengguna tidak dapat kosong.')
        );
        $this->form_validation->set_rules(
            'password',
            'Kata Sandi',
            'required',
            array('required' => 'Password tidak dapat kosong')
        );

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
            // echo $remember;
            // die;

            if ($this->ion_auth->login($username, $password, $remember)) {
                redirect('/', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh');
            }
        } else {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['username'] = array(
                'type' => 'text',
                'name' => 'identity',
                'value' => $this->form_validation->set_value('identity'),
                'id' => 'inputUsername',
                'required' => 'required',
                'class' => 'form-control',
                'placeholder' => 'Nama Pengguna'
            );
            $data['password'] = array(
                'name' => 'password',
                'id' => 'inputPassword',
                'required' => 'required',
                'minlength' => 4,
                'class' => 'form-control',
                'placeholder' => 'Kata Sandi'
            );

            $this->load->view('login', $data);
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('/', 'refresh');
    }
}
