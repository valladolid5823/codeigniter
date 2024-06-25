<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {
		$this->viewPayrollForm();
    }

	public function viewPayrollForm() {
		$data['profiles'] = $this->db->get('sales_representatives')->result();
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('payroll_form', $data);
		$this->load->view('template/footer');
	}

    public function process() {

		$sales_representative = $this->input->post('sales_representative');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$bonus = $this->input->post('bonus');
		$client_name = $this->input->post('client_name');
		$client_commission = $this->input->post('client_commission');

		// Example: Inserting data into database
		$payroll_data = [
			'sales_representative' => $sales_representative,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'bonus' => $bonus,
		];
		$this->db->insert('payrolls', $payroll_data);

		$payroll_id = $this->db->insert_id();
		
		for ($i = 0; $i < count($client_name); $i++) {
			$client_data = [
				'payroll_id' => $payroll_id,
				'client_name' => $client_name[$i],
				'commission' => $client_commission[$i],
			];
			$this->db->insert('payroll_clients', $client_data);
		}
		

		$response = [
			'status' => 'success',
			'message' => 'Payroll created successfully!'
		];
		echo json_encode($response);
	
        // $this->form_validation->set_rules('sales_representative', 'Sales Representative', 'required');
        // $this->form_validation->set_rules('from_date', 'From Date', 'required');
        // $this->form_validation->set_rules('to_date', 'To Date', 'required');
        // $this->form_validation->set_rules('bonus', 'Bonuses', 'required');
		// $this->form_validation->set_rules('clients[][name]', 'Client Name', 'required');
        // $this->form_validation->set_rules('clients[][commission]', 'Commission', 'required');
        // if ($this->form_validation->run() == FALSE) {
		// 	$this->viewPayrollForm();
        // } else {
        //     $sales_representative = $this->input->post('sales_representative');
        //     $from_date = $this->input->post('from_date');
        //     $to_date = $this->input->post('to_date');
        //     $bonus = $this->input->post('bonus');
        //     $clients = $this->input->post('clients');

        //     // Process data as per your business logic (e.g., save to database, generate payroll, etc.)

        //     // Example: Inserting data into database
        //     $payroll_data = [
        //         'sales_representative' => $sales_representative,
        //         'from_date' => $from_date,
        //         'to_date' => $to_date,
        //         'bonus' => $bonus,
        //     ];
        //     $this->db->insert('payrolls', $payroll_data);

        //     $payroll_id = $this->db->insert_id();

        //     foreach ($clients as $client) {
        //         $client_data = [
        //             'payroll_id' => $payroll_id,
        //             'client_name' => $client['name'],
        //             'commission' => $client['commission'],
        //         ];
        //         $this->db->insert('payroll_clients', $client_data);
        //     }

		// 	$response = [
		// 		'status' => 'success',
		// 		'message' => 'Payroll created successfully!'
		// 	];
		// 	echo json_encode($response);
        // }

    }
}
