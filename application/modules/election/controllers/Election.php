<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Election extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('election/m_election');
		$this->load->model('election/m_position');
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
        $config["base_url"] = base_url() . "admin/elections";
        $config["total_rows"] = $this->m_election->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if($this->m_election->record_count() > 0)
		{
			$data['elections_table'] = $this->get($config["per_page"], $page);
		}
		else
		{
			$data['elections_table'] = 0;
		}

		

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$data['description1'] = 'Display Election';
		$data['description2'] = 'Create Election';
		$data['table_view'] = 'election/display_election_v';
		$data['title'] = 'Elections';
		$data['rowz'] = $config["total_rows"];
		$data['select_positions'] = $this->m_position->get();

		
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li class="active"><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
        <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['content_view'] = 'election/create_election_v';
		$this->template->admin_template($data);			            
	}



	// Create to db
	function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('start', 'Start', 'required');
		$this->form_validation->set_rules('end', 'End', 'required');
		//$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->admin->elections();	//base_url('admin/addpositions');
			//$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center small">input error. </div>');
			//redirect('admin/positions', 'refresh');
		}
		else
		{
			$data = array(
	                'election_title' => $this->input->post('title'),
	                'position_id' => $this->input->post('position'),
	                'status' => $this->input->post('status'),
	                'start_date' => $this->input->post('start'),
	                'end_date' => $this->input->post('end')
            	);

			if ($this->m_election->post($data))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully Added. </div>');
	            $this->admin->elections();
			}
		}
	}



	// Read from db
	function get($limit, $page)
	{
		$elections = $this->m_election->fetch_data($limit, $page);
		$elections_table = "";
		if (count($elections) > 0)
		{
			$counter = 1;
			foreach ($elections as $key => $value) {
				# code...
				$elections_table .= "<tr>";
				$elections_table .= "<td>{$counter}</td>";
				$elections_table .= "<td>{$value->election_title}</td>";
				$elections_table .= "<td>{$value->position_title}</td>";
				$elections_table .= "<td>{$value->status}</td>";
				$elections_table .= "<td>{$value->start_date}</td>";
				$elections_table .= "<td>{$value->end_date}</td>";
                $elections_table .= "<td>"
                        . "<a href='".base_url('admin/updateelections/')."{$value->election_id}'><i class='glyphicon glyphicon-pencil'></i></a></td>"
                        . "<td><a href='#' onclick='deleteConfirm(\"".base_url()."admin/deleteelections/{$value->election_id}\");'><i class='glyphicon glyphicon-trash'></i></a></td>";
				$elections_table .= "</tr>";
				$counter +=1;
			}
		}

		return $elections_table;
	}



	// Update db
	function update($id)
	{
		$data['description2'] = 'Update Election';
		$data['title'] = 'Elections';
		$data['details'] = $this->m_election->get_by($id);
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li class="active"><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
        <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['select_positions'] = $this->m_position->get();
        $data['content_view'] = 'election/main_election_v';
		$this->template->admin_template($data);			


	}

	function updateelection($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('start', 'Start', 'required');
		$this->form_validation->set_rules('end', 'End', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully DELETED Record. </div>');
	        $this->admin->updateelections($id);
		}
		else
		{
			$data = array(
	                'election_title' => $this->input->post('title'),
	                'position_id' => $this->input->post('position'),
	                'status' => $this->input->post('status'),
	                'start_date' => $this->input->post('start'),
	                'end_date' => $this->input->post('end')
            	);

			if ($this->m_election->update($data, $id))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully UPDATED Record. </div>');
		        $this->admin->updateelections($id);
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="bg-danger text-center">Error Deleting Record. </div>');
		        $this->admin->updateelections($id);
			}
		}			


	}


	// Delete from db
	function delete($id)
	{
		if ($this->m_election->delete($id))
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-success text-center">Successfully DELETED Record. </div>');
	        redirect('admin/elections');
		}
		else
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-danger text-center">Error Deleting Record. </div>');
	        $this->admin->elections();
		}

	}

}