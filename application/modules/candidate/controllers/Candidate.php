<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Candidate extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('election/m_election');
		$this->load->model('user/m_user');
		$this->load->model('candidate/m_candidate');
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
		$config = array();
        $config["base_url"] = base_url() . "admin/candidates";
        $config["total_rows"] = $this->m_candidate->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if($this->m_candidate->record_count() > 0)
		{
			$data['candidates_table'] = $this->get($config["per_page"], $page);
		}
		else
		{
			$data['candidates_table'] = 0;
		}

		

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$data['description1'] = 'Display Candidates';
		$data['description2'] = 'Create Candidates';
		$data['table_view'] = 'candidate/display_candidate_v';
		$data['title'] = 'Candidates';
		$data['rowz'] = $config["total_rows"];
		$data['select_users'] = $this->m_user->get();
		$data['select_elections'] = $this->m_election->get();

		
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
        <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['content_view'] = 'candidate/create_candidate_v';
		$this->template->admin_template($data);			            
	}



	// Create to db
	function add()
	{
		
		$this->form_validation->set_rules('election', 'Election', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');

		$election_id = $this->input->post('election');
	    $user_id = $this->input->post('user');

		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->admin->candidates();	//base_url('admin/addpositions');
			$this->session->set_flashdata('msg', '<div class="bg-danger text-center">input error. </div>');
			//redirect('admin/positions', 'refresh');
		}
		elseif($this->m_candidate->candidate_count($election_id, $user_id) > 0)
		{
			$this->admin->candidates();	//base_url('admin/addpositions');
			$this->session->set_flashdata('msg', '<div class="bg-danger text-center">candidate already exists.</div>');
		}
		else
		{
			$data = array(
	                'election_id' => $this->input->post('election'),
	                'user_id' => $this->input->post('user')
            	);

			if ($this->m_candidate->post($data))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully Added. </div>');
	            $this->admin->candidates();
			}
		}
	}



	// Read from db
	function get($limit, $page)
	{
		$candidates = $this->m_candidate->fetch_data($limit, $page);
		$candidates_table = "";
		if (count($candidates) > 0)
		{
			$counter = 1;
			foreach ($candidates as $key => $value) {
				$user_id = $value->user_id;
				$election_id = $value->election_id;
				$count_vote = $this->m_candidate->vote_count($election_id, $user_id);
				# code...
				$candidates_table .= "<tr>";
				$candidates_table .= "<td>{$counter}</td>";
				$candidates_table .= "<td>{$value->user_firstname}</td>";
				$candidates_table .= "<td>{$value->user_lastname}</td>";
				$candidates_table .= "<td>{$value->election_title}</td>";
				$candidates_table .= "<td><span class='badge bg-green'>{$count_vote}</span></td>";
                $candidates_table .= "<td>"
                        . "<a href='".base_url('admin/updatecandidates/')."{$value->candidate_id}'><i class='glyphicon glyphicon-pencil'></i></a></td>"
                        . "<td><a href='#' onclick='deleteConfirm(\"".base_url()."admin/deletecandidates/{$value->candidate_id}\");'><i class='glyphicon glyphicon-trash'></i></a></td>";
				$candidates_table .= "</tr>";
				$counter +=1;
			}
		}

		return $candidates_table;
	}



	// Update db
	function update($id)
	{
		$data['description2'] = 'Update Candidates';
		$data['title'] = 'Candidates';
		$data['details'] = $this->m_candidate->get_by($id);
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-stop"></i> <span>Candidates</span></a></li>
        <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['select_users'] = $this->m_user->get();
		$data['select_elections'] = $this->m_election->get();
        $data['content_view'] = 'candidate/main_candidate_v';
		$this->template->admin_template($data);			


	}

	function updatecandidates($id)
	{
		$this->form_validation->set_rules('election', 'Election', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully DELETED Record. </div>');
	        $this->admin->updatecandidates($id);
		}
		else
		{
			$data = array(
	                'election_id' => $this->input->post('election'),
	                'user_id' => $this->input->post('user')
            	);

			if ($this->m_candidate->update($data, $id))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully UPDATED Record. </div>');
		        $this->admin->updatecandidates($id);
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="bg-danger text-center">Error Deleting Record. </div>');
		        $this->admin->updatecandidates($id);
			}
		}			


	}


	// Delete from db
	function delete($id)
	{
		if ($this->m_candidate->delete($id))
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-success text-center">Successfully DELETED Record. </div>');
	        redirect('admin/candidates');
		}
		else
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-danger text-center">Error Deleting Record. </div>');
	        $this->admin->candidates();
		}

	}

}