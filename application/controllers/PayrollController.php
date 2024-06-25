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

		$sales_representative = $this->security->xss_clean($this->input->post('sales_representative'));
		$from_date = $this->security->xss_clean($this->input->post('from_date'));
		$to_date = $this->security->xss_clean($this->input->post('to_date'));
		$bonus = $this->security->xss_clean($this->input->post('bonus'));
		$client_name = $this->security->xss_clean($this->input->post('client_name'));
		$client_commission = $this->security->xss_clean($this->input->post('client_commission'));

		$payroll_data = [
			'sales_rep_id' => $sales_representative,
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

	public function payslip($id) {
		// Build and execute the query
		// $query = $this->db->get_where('payrolls', array('sales_rep_id' => $id));
		// // Fetch the result
		// // $data['payroll'] = $query->result_array(); // Or $query->result() for object array
		// // $payroll = $query->row_array(); 
		// $data['payroll'] = $query->row_array(); 

		// $query = $this->db->order_by('id', 'DESC')
        //           ->limit(1)
        //           ->get_where('payrolls', array('sales_rep_id' => $id));
		// $data['payroll'] = $query->row_array();

		// Build the query
        $this->db->select('payrolls.id, sales_representatives.id as sales_rep_id, sales_representatives.name, payrolls.from_date, payrolls.to_date, payrolls.bonus, sales_representatives.commission_percentage, sales_representatives.tax_rate, sales_representatives.bonuses');
        $this->db->from('payrolls');
        $this->db->join('sales_representatives', 'sales_representatives.id = payrolls.sales_rep_id');
        $this->db->where('payrolls.sales_rep_id', $id); // Add the where clause
        $this->db->order_by('payrolls.id', 'DESC'); // Add the order by clause
        $this->db->limit(1); // Add the limit clause
        
        // Execute the query
        $query = $this->db->get();
        
        // Return the result
		$data['payroll'] = $query->result_array(); // Using row() instead of result() to get a single row


		$query = $this->db->get_where('payroll_clients', array('payroll_id' => 33));
		$payroll_clients = $query->result_array();

		$data['commission_details'] = [];

		foreach($payroll_clients as $payroll_client) {

			$data['commission_details'][] = [
				'client_name' => $payroll_client['client_name'],
				'commission_received' => $payroll_client['commission'],
				'tax' => $data['payroll'][0]['tax_rate']
			];
		}

		$this->load->view('template/header');
		$this->load->view('payslip', $data);
		$this->load->view('template/footer');
	}
}
