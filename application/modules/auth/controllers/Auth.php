<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Auth extends MY_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('m_auth');
		
		//$this->load->library('session');
	}

	function index()
	{

		if($this->session->userdata('isLogin') == TRUE)
		{
			$email = $this->session->userdata('email');
			$user_level = $this->m_auth->get_user($email)->user_type;
			if ($user_level == 'admin')
			{
				redirect('admin');
			}
			else
			{
				redirect('home');	
			}
			
		}
		else
		{
			redirect('auth/login');
		}

	}

	public function login()
	{
		$this->load->module(['home']);
		# code...
		if($this->session->userdata('isLogin') != TRUE)
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

			if($this->form_validation->run()==FALSE)
			{
				$this->home->login();
			}
			else
			{
				$email = $this->input->post('email');
				$password =  $this->input->post('password');
				$user_ip = $this->input->ip_address();
				$check = $this->m_auth->check_login($email, $password);

				if($check <> 0)
				{
					
					$user_details = $this->m_auth->get_user($email);
					$user_level = $user_details->user_type;
					$user_id = $user_details->user_id;
					$this->session->set_userdata('isLogin', TRUE);
					$this->session->set_userdata('email',$email);
					$this->session->set_userdata('user_id',$user_id);

					$this->m_auth->update_ip($user_id, $user_ip);

					//$this->session->set_userdata('user_level',$user_type);

					if ($user_level == 'admin')
					{
						redirect('admin');
					}
					else
					{
						redirect('basic');

					}
					//echo $user_level.'yup';
					
				}
				else
				{
					$this->session->set_flashdata('verify', '<div class="bg-danger text-center">Incorrect email and password combination.</div>');
	                    $this->home->login();
				}
			}
		}
		else
		{
			redirect('auth');
		}
	}


	public function register()
	{
		$this->load->module(['home']);
		# code...
		if($this->session->userdata('isLogin') != TRUE)
		{
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|alpha');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|alpha');
			$this->form_validation->set_rules('othername', 'Othername', 'alpha');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.user_email]', array('is_unique' => 'User already exists'));
			$this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[11]|numeric');
			$this->form_validation->set_rules('gender', 'Gender', 'required|alpha');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

			if($this->form_validation->run()==FALSE)
			{
				$this->home->register();
			}
			else
			{
				$data = array(
	                'user_firstname' => $this->input->post('firstname'),
	                'user_lastname' => $this->input->post('lastname'),
	                'user_othername' => $this->input->post('othername'),
	                'user_email' => $this->input->post('email'),
	                'user_telephone' => $this->input->post('telephone'),
	                'user_country' => $this->input->post('country'),
	                'user_state' => $this->input->post('state'),
	                'user_gender' => $this->input->post('gender'),
	                'user_ip' => $this->input->ip_address(),
	                'user_password' => md5($this->input->post('password'))
            	);

            	

				

				$id =  $this->m_auth->register($data);
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
						'user_id' => $id
					];
				}

				if(!$images_array == "")
				{
					$this->m_auth->add_user_images($images_array);
				}


				if($this->m_auth->sendEmail($this->input->post('email')))
				{
                    $this->session->set_flashdata('msg', '<div class="bg-success text-center">Successfully registered. Please confirm the mail that has been sent to your email. </div>');
                    $this->home->login();
                }
                else
                { 
                    $this->session->set_flashdata('msg', '<div class="bg-danger text-center">Failed!! Please try again.</div>');
                    $this->home->register();
                }
		
			}
		}
		else
		{
			redirect('auth');
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


	function confirmEmail($hash){
        if($this->m_auth->verifyEmail($hash)){
            $this->session->set_flashdata('verify', '<div class="bg-success text-center">Email address is confirmed. Please login to the system</div>');
            $this->home->login();
        }else{
            $this->session->set_flashdata('verify', '<div class="bg-danger text-center">Email address is not confirmed. Please try to re-register.</div>');
            $this->home->login();
        }
    }


	public function logout()
	{
		# code...
		$this->session->sess_destroy();
		redirect(base_url('login'));

	}



 public function forgot()
 {
 	$this->load->module(['home']);
 	if($this->session->userdata('isLogin') != TRUE)
	{
     
		 
    	$email= $this->input->post('email');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
		//$this->load->view('user/forgetpassword');
			$this->home->forgot();
		}
		else
		{

		 	if($this->m_auth->get_user($email))
		 	{
		 		$this->load->helper('string');
		 		$password= random_string('alnum',6);


		 		$this->db->where('user_email', $email);
		 		$this->db->update('users',array('user_password'=>MD5($password)));

		 		$this->email->from('contact@example.com', 'Password reset');
				$this->email->to($user->email); 
				$this->email->subject('Password reset');
			   	$this->email->message('You have requested the new password, Here is you new password:'. $password); 
				$this->email->send();
		     	$this->session->set_flashdata('message','<div class="bg-success text-center">Password has been reset and has been sent to email</div>'); 
		    	redirect(base_url('forgot'));
		 	}
		 
		 


		 
		    }
	}
	else
	{
		redirect('auth');
	}
 }



}