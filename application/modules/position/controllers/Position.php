<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Position extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('position/m_position');
		$this->load->model('user/m_user');
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
        $config["base_url"] = base_url() . "admin/positions";
        $config["total_rows"] = $this->m_position->record_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if($this->m_position->record_count() > 0)
		{
			$data['positions_table'] = $this->get($config["per_page"], $page);
		}
		else
		{
			$data['positions_table'] = 0;
		}

		

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$data['description1'] = 'Display Position';
		$data['description2'] = 'Create Position';
		$data['table_view'] = 'position/display_position_v';
		$data['title'] = 'Positions';
		$data['rowz'] = $config["total_rows"];
		$data['select_users'] = $this->m_user->get();

		
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
					            <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
					            <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
					            <li class="active"><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
					            <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['content_view'] = 'position/create_position_v';
		$this->template->admin_template($data);			            
	}



	// add to db
	function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|is_unique[positions.position_title]');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->admin->positions();	//base_url('admin/addpositions');
			//$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center small">input error. </div>');
			//redirect('admin/positions', 'refresh');
		}
		else
		{
			$data = array(
	                'position_title' => $this->input->post('title'),
	                'position_description' => $this->input->post('description'),
	                'user_id' => $this->input->post('user')
            	);

			if ($this->m_position->post($data))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully Added. </div>');
	            $this->admin->addpositions();
			}
		}
	}



	// get from db
	function get($limit, $page)
	{
		$positions = $this->m_position->fetch_data($limit, $page);
		$positions_table = "";
		if (count($positions) > 0)
		{
			$counter = 1;
			foreach ($positions as $key => $value) {
				# code...
				$positions_table .= "<tr>";
				$positions_table .= "<td>{$counter}</td>";
				$positions_table .= "<td>{$value->position_title}</td>";
				$positions_table .= "<td>{$value->user_firstname}</td>";
				$positions_table .= "<td>{$value->user_lastname}</td>";
				$positions_table .= "<td>{$value->position_description}</td>";
                $positions_table .= "<td>"
                        . "<a href='".base_url('admin/updatepositions/')."{$value->position_id}'><i class='glyphicon glyphicon-pencil'></i></a></td>"
                        . "<td><a href='#' onclick='deleteConfirm(\"".base_url()."admin/deletepositions/{$value->position_id}\");'><i class='glyphicon glyphicon-trash'></i></a></td>";
				$positions_table .= "</tr>";
				$counter +=1;
			}
		}

		return $positions_table;
	}



	// update db
	function update($id)
	{
		$data['description2'] = 'Update Position';
		$data['title'] = 'Positions';
		$data['details'] = $this->m_position->get_by($id);
		$data['sidebar_menu'] = '
		<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
        <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
        <li class="active"><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
        <li><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['select_users'] = $this->m_user->get();
		$data['content_view'] = 'position/main_position_v';
		$this->template->admin_template($data);			


	}

	function updatepost($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully DELETED Record. </div>');
	        $this->admin->updatepositions($id);
		}
		else
		{
			$data = array(
	                'position_title' => $this->input->post('title'),
	                'position_description' => $this->input->post('description'),
	                'user_id' => $this->input->post('user')
            	);

			if ($this->m_position->update($data, $id))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully UPDATED Record. </div>');
		        $this->admin->updatepositions($id);
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="bg-danger text-center">Error Deleting Record. </div>');
		        $this->admin->updatepositions($id);
			}
		}			


	}


	// delete from db
	function delete($id)
	{
		if ($this->m_position->delete($id))
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-success text-center">Successfully DELETED Record. </div>');
	        redirect('admin/positions');
		}
		else
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-danger text-center">Error Deleting Record. </div>');
	        $this->admin->positions();
		}

	}

}