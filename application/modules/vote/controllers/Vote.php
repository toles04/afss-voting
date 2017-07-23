<?php
/**
* 
*/
class Vote extends MY_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('auth/m_auth');
		$this->load->model('vote/m_vote');
		$this->load->library('pagination');

		//$this->load->module(['']);
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

	public function display_vote_candidates($election_id, $val)
	{
		$user_id = $this->session->userdata('user_id');
		$data['vote_candidates'] = $this->m_vote->get_election_candidates($election_id);
		$data['election'] = $this->m_vote->get_election($election_id);
		$data['status'] = $this->m_vote->check_status($user_id, $election_id);
		$data['user_image'] = $val;
		$this->template->vote_template($data);
	}

	public function post_vote()
	{
		$user_id = $this->input->post('user_id');
		$election_id =  $this->input->post('election_id');
		$candidate_id =  $this->input->post('candidate_id');
		$user_ip = $this->input->ip_address();

		$data = array(
	                'user_id' => $this->input->post('user_id'),
	                'election_id' => $this->input->post('election_id'),
	                'candidate_id' => $this->input->post('candidate_id'),
	                'vote_id' => $this->input->ip_address()
            	);

		if (!$this->m_vote->check($user_id, $election_id, $candidate_id))
		{
		  $this->m_vote->post($data);
		}
		else
		{
			return FALSE;
		}

		//$check = $this->m_auth->check_login($email, $password);
		//echo "hello world".$user_id." ".$election_id." ".$candidate_id;
	}

	public function get_election($val)
	{
		$data['elections_table'] = $this->get();
		$data['user_image'] = $val;
		$this->template->election_template($data);
	}


// get from db
	function get()
	{
		$elections = $this->m_vote->fetch_data();
		$elections_table = "";
		if (count($elections) > 0)
		{
			foreach ($elections as $key => $value) {
				# code...
				$election_id = $value->election_id;
				$title = $value->election_title;
				$status = $value->status;
				if($status == "active"){ $title = "<span class='dark-link'><a href='".base_url('basic/vote')."/{$election_id}'>$title</a></span>";}
				$elections_table .= "<tr>";
				$elections_table .= "<td><b>{$title}</b></td>";
				$elections_table .= "<td><b>{$value->start_date}</b></td>";
				$elections_table .= "<td><b>{$value->end_date}</b></td>";
				$elections_table .= "</tr>";	
			}
		}

		return $elections_table;
	}




}