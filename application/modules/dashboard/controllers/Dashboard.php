<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Dashboard extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('election/m_election');
		$this->load->model('user/m_user');
		$this->load->model('user/m_candidate');
		$this->load->model('dashboard/m_dashboard');
		$this->load->model('position/m_position');
		$this->load->model('auth/m_auth');
		$this->load->module(['admin']);
		$this->load->library('pagination');
		if($this->session->userdata('isLogin') == TRUE)
		{
			$email = $this->session->userdata('email');
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($user_level != 'admin')
			{
				redirect(base_url('basic'));
			}
			
		}
		else
		{
			redirect(base_url());
		}
		
	}


	// display 
	function display($data = NULL)
	{
		$data['title'] = 'Dashboard';
		//$data['sub_title'] = 'Dashboard';	
		$data['elections_table'] = $this->get_elections();
		$data['candidates_table'] = $this->get_candidates();
		$data['users_table'] = $this->get_users();
		$data['positions_table'] = $this->get_positions();
		$data['sidebar_menu'] = '<li class="active"><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
        <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['content_view'] = 'dashboard/display_dashboard_v';
        $data['candidates_votes_view'] = 'dashboard/candidates_votes_dashboard_v';
        $data['elections_view'] = 'dashboard/elections_dashboard_v';
        $data['users_view'] = 'dashboard/users_dashboard_v';
        $data['positions_view'] = 'dashboard/positions_dashboard_v';
		$this->template->admin_template($data);			            
	}


	function get_elections()
	{
		$elections = $this->m_dashboard->get_elections();
		$elections_table = "";
		if(count($elections) > 0)
		{
			$counter = 1;
			foreach ($elections as $key => $value) 
			{
				# code...
				$elections_table .= "<tr>";
				$elections_table .= "<td>{$counter}</td>";
				$elections_table .= "<td>{$value->election_title}</td>";
				$elections_table .= "<td>{$value->position_title}</td>";
				$elections_table .= "<td>{$value->start_date}</td>";
				$elections_table .= "<td>{$value->end_date}</td>";
				$elections_table .= "</tr>";
				$counter +=1;
			}
		}
		return $elections_table;
	}



	function get_candidates()
	{
		$candidates = $this->m_dashboard->get_candidates();
		$candidates_table = "";
		if(count($candidates) > 0)
		{
			$counter = 1;
			foreach ($candidates as $key => $value) 
			{
				# code...
				$user_id = $value->user_id;
				$election_id = $value->election_id;
				$count_vote = $this->m_candidate->vote_count($election_id, $user_id);
				$candidates_table .= "<tr>";
				$candidates_table .= "<td>{$counter}</td>";
				$candidates_table .= "<td>{$value->user_firstname}</td>";
				$candidates_table .= "<td>{$value->user_lastname}</td>";
				$candidates_table .= "<td>{$value->election_title}</td>";
				$candidates_table .= "<td><span class='badge bg-blue'>{$count_vote}</span></td>";
		$candidates_table .= "</tr>";
				$counter +=1;
			}
		}
		return $candidates_table;
	}



	function get_users()
	{
		$users = $this->m_dashboard->get_users();
		$users_table = "";
		if(count($users) > 0)
		{
			$counter = 1;
			foreach ($users as $key => $value) 
			{
				# code...
				$status ="";
				if($value->user_active == "1")
				{
					$status .= "<span class='badge bg-green'>Active</span>";
				}
				else
				{
					$status .= "<span class='badge bg-red'>Inactive</span>";
				}
				$users_table .= "<tr>";
				$users_table .= "<td>{$counter}</td>";
				$users_table .= "<td>{$value->user_firstname}</td>";
				$users_table .= "<td>{$value->user_lastname}</td>";
				$users_table .= "<td>{$value->user_email}</td>";
				$users_table .= "<td>{$value->user_type}</td>";
				$users_table .= "<td>{$status}</td>";
		$users_table .= "</tr>";
				$counter +=1;
			}
		}
		return $users_table;
	}



	function get_positions()
	{
		$positions = $this->m_dashboard->get_positions();
		$positions_table = "";
		if(count($positions) > 0)
		{
			$counter = 1;
			foreach ($positions as $key => $value) 
			{
				# code...
				$positions_table .= "<tr>";
				$positions_table .= "<td>{$counter}</td>";
				$positions_table .= "<td>{$value->position_title}</td>";
				$positions_table .= "<td>{$value->user_firstname}</td>";
				$positions_table .= "<td>{$value->user_lastname}</td>";
				//$positions_table .= "<td>{$value->position_description}</td>";
		$positions_table .= "</tr>";
				$counter +=1;
			}
		}
		return $positions_table;
	}

}