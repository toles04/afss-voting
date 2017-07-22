<?php
/**
* 
*/
class Basic extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('auth/m_auth');

		$this->load->module(['vote']);
		if($this->session->userdata('isLogin') == TRUE)
		{
			$email = $this->session->userdata('email');
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($user_level == 'admin')
			{
				redirect(base_url('admin'));
			}
			
		}
		else
		{
			redirect('login');
		}
	}

	public function index()
	{
		$this->template->basic_template();
	}

	function election()
	{
		$this->vote->get_election();
	}

	function vote($id=null)
	{
		$this->vote->display_vote_candidates($id);
	}

	function post_votes()
	{
		$this->vote->post_vote();
	}  
}