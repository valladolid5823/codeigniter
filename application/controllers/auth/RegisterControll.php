<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller
{
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('frontend/register');
		$this->load->view('template/footer');
	}
}
