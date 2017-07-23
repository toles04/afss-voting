<?php
/**
* 
*/
class Admin extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('auth/m_auth');

		$this->load->module([
				'position',
				'user',
				'election',
				'candidate',
				'dashboard'
			]);

		if($this->session->userdata('isLogin') == TRUE)
		{
			$email = $this->session->userdata('email');
			$deleted = $this->m_auth->get_user($email)->deleted;
			$user_active = $this->m_auth->get_user($email)->user_active;
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($deleted == '1' || $user_active == '0')
			{
				redirect(base_url('auth/logout'));
			}
			
			if ($user_level != 'admin')
			{
				redirect(base_url('basic'));
			}
			
		}
		else
		{
			redirect('login');
		}
	}

	public function index()
	{
		$this->dashboard->display();
	}





	
	// start of Elections page functions

	function candidates()
	{
		
		$this->candidate->display();
	}

	function addcandidates()
	{
		
		$this->candidate->add();
	}

	function updatecandidates($id)
	{
		
		$this->candidate->update($id);
	}

	function updatecandidate($id)
	{
		
		$this->candidate->updatecandidates($id);
	}

	function deletecandidates($id)
	{
		
		$this->candidate->delete($id);
	}

	// end of Elections page functions






	// start of Elections page functions

	function elections()
	{
		
		$this->election->display();
	}

	function addelections()
	{
		
		$this->election->add();
	}

	function updateelections($id)
	{
		
		$this->election->update($id);
	}

	function updateelection($id)
	{
		
		$this->election->updateelection($id);
	}

	function deleteelections($id)
	{
		
		$this->election->delete($id);
	}

	// end of Elections page functions






	// start of positions page functions

	function positions()
	{
		
		$this->position->display();
	}

	function addpositions()
	{
		
		$this->position->add();
	}

	function updatepositions($id)
	{
		
		$this->position->update($id);
	}

	function updatepost($id)
	{
		
		$this->position->updatepost($id);
	}

	function deletepositions($id)
	{
		
		$this->position->delete($id);
	}

	// end of positions page functions






	// start of Users page functions

	function users()
	{
		
		$this->user->display();
	}

	function updateusers($id)
	{
		
		$this->user->update($id);
	}

	function updateuser($id)
	{
		
		$this->user->updateuser($id);
	}

	function deleteusers($id)
	{
		
		$this->user->delete($id);
	}

	// end of Users page functions	

}