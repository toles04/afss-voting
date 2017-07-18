<?php
/**
* 
*/
class Home extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('auth/m_auth');
		$this->load->model('home/m_home');

		if($this->session->userdata('isLogin') == TRUE)
		{
			$email = $this->session->userdata('email');
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($user_level != 'admin')
			{
				redirect(base_url('basic'));
			}
			else
			{
				redirect(base_url('admin'));
			}
		}
	}

	function index()
	{
		
		$this->template->welcome_template();	

	}

	public function  login()
	{
		$this->template->login_template();
	}

	public function  register()
	{
		$data['countries'] = $this->m_home->get_countries();
		$this->template->register_template($data);
	}

	public function  forgot()
	{
		$this->template->forgot_template();
	}

	public function state($id)
	{
		$states = $this->m_home->get_states($id);
		

		foreach ($states as $key => $value) 
		{
			# code...
			echo "<option value='{$value->id}'>{$value->state}</option>";
		}
		
	}

}