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


		$query = $this->db->get_where('payroll_clients', array('payroll_id' => $data['payroll'][0]['id']));
		$payroll_clients = $query->result_array();

		$data['commission_details'] = [];
		$data['total_earnings'] = 0;
		foreach($payroll_clients as $payroll_client) {

			$sales_commission = ($data['payroll'][0]['commission_percentage'] / 100) * $payroll_client['commission'];
			$tax_on_commission = ($data['payroll'][0]['tax_rate'] / 100) * $sales_commission;
			$net_sales_commision = $sales_commission - $tax_on_commission;
			$data['commission_details'][] = [
				'client_name' => $payroll_client['client_name'],
				'commission_received' => $payroll_client['commission'],
				'tax_on_commission' => $tax_on_commission,
				'sales_commision' => $sales_commission,
				'net_sales_commision' => $net_sales_commision
			];

			$data['total_earnings'] += $net_sales_commision;
		}

		$data['total_earnings'] = $data['total_earnings'] + $data['payroll'][0]['bonus'];

		// Set the default timezone to Manila
		date_default_timezone_set('Asia/Manila');
		$data['current_date_time'] = date('Y-m-d h:i:s A');

		$this->load->view('template/header');
		$this->load->view('payslip', $data);
		$this->load->view('template/footer');

		// echo "<script>window.close()</script>";
	}
}
