<?php
/**
* 
*/
class M_Auth extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}


	function check_login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $password);
		$query = $this->db->get();

		return $query->num_rows();

	}

	function update_ip($id, $ip)
	{
		$this->db->set('user_ip', $ip);
		$this->db->where('user_id', $id);
		$this->db->update('users');

		return true;

	}

	function get_user($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->limit(1);
		//$this->db->where('user_password', $password);
		$query = $this->db->get();


		return $query->row();

	}


	function register($data)
	{
		if($this->db->insert('users', $data))
		{
			return $this->db->insert_id();
		}

		return FALSE;
	}


	 //send confirm mail
    function sendEmail($receiver)
    {
        $from = "toles04@gmail.com";    //senders email address
        $subject = 'Verify email address';  //email subject
        
        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
        <a href=\'http://voteapp/auth/confirmEmail/'.md5($receiver).'\'>http://voteapp/auth/confirmEmail/'. md5($receiver) .'</a><br><br>Thanks';
        
        
        
        //config email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'Marshyll04';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n"; 
        
        $this->load->library('email', $config);
		$this->email->initialize($config);
        //send email
        $this->email->from($from);
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if($this->email->send()){
			//for testing
            return true;
        }else{
            return false;
        }
        
       
    }

    function add_user_images($user_images)
	{
		$this->db->set($user_images);
		$this->db->update('user_images');
	}

    
    //activate account
    function verifyEmail($key){
        $data = array('user_active' => 1);
        $this->db->where('md5(user_email)',$key);
        return $this->db->update('users', $data);    //update status as 1 to make active user
    }



}