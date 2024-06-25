<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
		// Check if user is logged in
        if (!$this->session->userdata('username')) {
            redirect(base_url(''));
        }
    }

    public function index() {
		$data['profiles'] = $this->db->get('sales_representatives')->result();
		$this->load->view('template/header');
		$this->load->view('template/navbar');
        $this->load->view('sales_rep_view', $data);
		$this->load->view('template/footer');
    }

	public function create() {
		$this->load->view('template/header');
		$this->load->view('template/navbar');
        $this->load->view('sales_rep_form');
		$this->load->view('template/footer');
    }

    public function save() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('commission_percentage', 'Commission Percentage', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]');
        $this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]');
        $this->form_validation->set_rules('bonuses', 'Bonuses', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $data = [
            'name' => $this->security->xss_clean($this->input->post('name')),
            'commission_percentage' => $this->security->xss_clean($this->input->post('commission_percentage')),
            'tax_rate' => $this->security->xss_clean($this->input->post('tax_rate')),
            'bonuses' => $this->security->xss_clean($this->input->post('bonuses'))
        ];

        if ($this->db->insert('sales_representatives', $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Profile created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create profile']);
        }
    }
}
