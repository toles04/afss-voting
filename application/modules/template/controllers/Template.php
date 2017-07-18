<?php
/**
* 
*/
class Template extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function  admin_template($data = NULL)
	{
		$this->load->view('admin/template_v', $data);
	}

	public function  basic_template($data = NULL)
	{
		//$this->load->view('basic/header_template_v', $data);
		$this->load->view('main_template_v', $data);
		//$this->load->view('basic/footer_template_v', $data);
	}

	public function  election_template($data = NULL)
	{
		//$this->load->view('basic/header_template_v', $data);
		$this->load->view('vote/vote_template_v', $data);
		//$this->load->view('basic/footer_template_v', $data);
	}

	public function  welcome_template($data = NULL)
	{
		//$this->load->view('basic/header_template_v', $data);
		$this->load->view('main_template_home_v', $data);
		//$this->load->view('basic/footer_template_v', $data);
	}

	public function  login_template($data = NULL)
	{
		$this->load->view('auth/header_template_v');
		$this->load->view('auth/login_template_v', $data);
		$this->load->view('auth/footer_template_v');
	}

	public function  register_template($data = NULL)
	{
		$this->load->view('auth/header_template_v');
		$this->load->view('auth/register_template_v', $data);
		$this->load->view('auth/footer_template_v');
	}

	public function  forgot_template($data = NULL)
	{
		$this->load->view('auth/header_template_v');
		$this->load->view('auth/forgot_template_v', $data);
		$this->load->view('auth/footer_template_v');
	}

}