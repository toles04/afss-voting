<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class User extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
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
        $config["base_url"] = base_url() . "admin/users";
        $config["total_rows"] = $this->m_user->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if($this->m_user->record_count() > 0)
		{
			$data['users_table'] = $this->get($config["per_page"], $page);
		}
		else
		{
			$data['users_table'] = 0;
		}

		

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$data['description1'] = 'Display Users';
		//$data['description2'] = 'Create Position';
		//$data['table_view'] = 'position/display_user_v';
		$data['title'] = 'Users';
		$data['rowz'] = $config["total_rows"];

		
		$data['title'] = 'Users';
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
					            <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
					            <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
					            <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
					            <li class="active"><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
        $data['content_view'] = 'user/display_user_v';
		$this->template->admin_template($data);			            
	}




	// get from db
	function get($limit, $page)
	{
		$users = $this->m_user->fetch_data($limit, $page);
		$users_table = "";
		if (count($users) > 0)
		{
			$counter = 1;
			foreach ($users as $key => $value) {
				# code...
				$users_table .= "<tr>";
				$users_table .= "<td>{$counter}</td>";
				$users_table .= "<td>{$value->user_firstname}</td>";
				$users_table .= "<td>{$value->user_lastname}</td>";
				$users_table .= "<td>{$value->user_email}</td>";
				$users_table .= "<td>{$value->state}, {$value->country}.</td>";
				$users_table .= "<td>{$value->user_type}</td>";
				$users_table .= "<td>{$value->user_active}</td>";
                $users_table .= "<td>"
                        . "<a href='".base_url('admin/updateusers/')."{$value->user_id}'><i class='glyphicon glyphicon-pencil'></i></a></td>"
                        . "<td><a href='#' onclick='deleteConfirm(\"".base_url()."admin/deleteusers/{$value->user_id}\");'><a href=''><i class='glyphicon glyphicon-trash'></i></a></td>";
				$users_table .= "</tr>";
				$counter +=1;
			}
		}

		return $users_table;
	}



	// update db
	function update($id)
	{
		$data['description2'] = 'Update User';
		$data['title'] = 'Users';
		$data['details'] = $this->m_user->get_by($id);
		$data['sidebar_menu'] = '<li><a href="'.base_url('admin').'"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
					            <li><a href="'.base_url('admin/candidates').'"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
					            <li><a href="'.base_url('admin/elections').'"><i class="fa fa-stop"></i> <span>Elections</span></a></li>
					            <li><a href="'.base_url('admin/positions').'"><i class="fa fa-bank"></i> <span>Positions</span></a></li>
					            <li class="active"><a href="'.base_url('admin/users').'"><i class="fa fa-users"></i> <span>Users</span></a></li>';
		$data['content_view'] = 'user/main_user_v';
		$this->template->admin_template($data);			


	}

	function updateuser($id)
	{
		$this->form_validation->set_rules('firstname', 'Firsname', 'required|alpha');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required|alpha');
		$this->form_validation->set_rules('othername', 'Othername', 'alpha');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[11]|numeric');
		$this->form_validation->set_rules('gender', 'Gender', 'required|alpha');
		$this->form_validation->set_rules('active', 'Active', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully DELETED Record. </div>');
	        $this->admin->updateusers($id);
		}
		else
		{
			$data = array(
	                'user_firstname' => $this->input->post('firstname'),
	                'user_lastname' => $this->input->post('lastname'),
	                'user_othername' => $this->input->post('othername'),
	                'user_email' => $this->input->post('email'),
	                'user_telephone' => $this->input->post('telephone'),
	                'user_gender' => $this->input->post('gender'),
	                'user_active' => $this->input->post('active'),
	                'user_type' => $this->input->post('type')
            	);

			if ($this->m_user->update($data, $id))
			{
				$this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully UPDATED Record. </div>');
		        $this->admin->updateusers($id);
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="bg-danger text-center">Error Deleting Record. </div>');
		        $this->admin->updateusers($id);
			}
		}			


	}


	// delete from db
	function delete($id)
	{
		if ($this->m_user->delete($id))
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-success text-center">Successfully DELETED Record. </div>');
	        redirect('admin/users');
		}
		else
		{
			$this->session->set_flashdata('msgdelete', '<div class="bg-danger text-center">Error Deleting Record. </div>');
	        $this->admin->positions();
		}

	}

}