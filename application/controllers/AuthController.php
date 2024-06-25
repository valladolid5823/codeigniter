<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/footer');
    }

   
    public function login() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Dummy check for example purposes
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('username', $username);
            echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid login credentials']);
        }
    }

	public function logout() {
        // Unset all session data
        $this->session->unset_userdata('username');
        // Add more session data to unset as needed

        // Optionally, destroy the session
        $this->session->sess_destroy();

		redirect(base_url(''));
    }

	public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

        $data = [
            'username' => $username,
            'password' => $password,
        ];

        if ($this->db->insert('users', $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register user']);
        }
    }
}
