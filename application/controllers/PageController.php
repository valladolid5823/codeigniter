<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

	public function about()
	{
		$this->load->view('about');
	}

	public function blog($blog_url = null)
	{
		$this->load->view('blog_view');
	}

	public function demo()
	{
		$this->load->model('StudentModel');
		$student = new StudentModel;
		
		$data['title'] = $student->demo();
		$this->load->view('demo_page', $data);
	}

	public function employee()
	{
		$this->load->view('frontend/employee');
	}

}

