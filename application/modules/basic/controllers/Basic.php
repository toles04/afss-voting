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
			$deleted = $this->m_auth->get_user($email)->deleted;
			$user_active = $this->m_auth->get_user($email)->user_active;
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($deleted == '1' || $user_active == '0')
			{
				redirect('login');
			}

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
		$data['user_image'] = $this->get_image();
		$this->template->basic_template($data);
	}

	function election()
	{
		$data = $this->get_image();
		$this->vote->get_election($data);
	}

	function vote($id=null)
	{
		$data = $this->get_image();
		$this->vote->display_vote_candidates($id, $data);
	}

	function post_votes()
	{
		$this->vote->post_vote();
	}

	function edit_user()
	{
		$this->load->model('basic/m_basic');
		$user_id = $this->session->userdata('user_id');
		$data['user_details'] = $this->m_basic->get_by_id($user_id);
		$data['user_image'] = $this->get_image();
		$this->template->edit_basic_template($data);
	}

	function edit_action()
	{
		$this->load->model('m_basic');
		//$this->edit();
		$this->form_validation->set_rules('firstname', 'Firstname', 'required|alpha');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required|alpha');
		$this->form_validation->set_rules('othername', 'Othername', 'alpha');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[11]|numeric');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

			if($this->form_validation->run()==FALSE)
			{
				$this->edit_user();
			}
			else
			{
				$data = array(
	                'user_firstname' => $this->input->post('firstname'),
	                'user_lastname' => $this->input->post('lastname'),
	                'user_othername' => $this->input->post('othername'),
	                'user_telephone' => $this->input->post('telephone')
            	);

            	
            	$user_id = $this->session->userdata('user_id');
				$id = $this->m_basic->update($data, $user_id);

				$this->load->library('upload');
				$files = $_FILES;
				$images = count($_FILES['user_images']['name']);
				$images_array = [];

				$this->upload->initialize($this->set_upload_option());

				if (!$this->upload->do_upload('user_images'))
				{
					$error = array('error' => $this->upload->display_errors());
				}
				else
				{
					$images_array = [
						'image_path' => base_url()."uploads/users/".$_FILES['user_images']['name'],
						'user_id' => $user_id
					];
				}

				if(!$images_array == "")
				{
					$this->m_basic->add_user_images($images_array, $user_id);
				}
				redirect(base_url('basic/edit_user'));
				

			}

				
	}

	private function set_upload_option()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = './uploads/users/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['overwrite'] = FALSE;

		return $config; 
	}

	function get_image()
	{
		$this->load->model('m_basic');
		$user_id = $this->session->userdata('user_id');
		$image = "";
		
		if($this->m_basic->get_image_url($user_id))
		{
			$image .= $this->m_basic->get_image_url($user_id);
		}
		else
		{
			$image .= base_url('uploads/users/dummy-profile-pic-male1.jpg');
		}

		return $image;

	}

	function delete_action()
	{
		$this->load->model('m_basic');
		//$this->delete();
		$user_id = $this->session->userdata('user_id');
		$this->m_basic->delete($user_id);
		redirect(base_url('auth/logout'));
	}
}