<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->helper(array('form', 'url'));
        // $this->load->library('session');
        // $this->load->database();
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Dummy check for example purposes
        if ($username == 'admin' && $password == 'password') {
            $this->session->set_userdata('username', $username);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid login credentials']);
        }
    }
}
