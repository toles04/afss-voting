<?php
/**
* 
*/
class M_Basic extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}


	function get_by_id($id)
	{
		$this->db->where('user_id', $id);
		$this->db->where('deleted', '0');
		$this->db->where('user_active', '1');
		$query = $this->db->get('users');

		return $query->row();

	}

	function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('user_id', $id);
		if($this->db->update('users', $data))
		{
			return $this->db->insert_id();
		}

		return FALSE;
	}

	function delete($id)
	{
		$this->db->set('deleted', '1');
		$this->db->set('user_active', '0');
		$this->db->where('user_id', $id);
		if($this->db->update('users'))
		{
			return $this->db->insert_id();
		}

		return FALSE;
	}

	 function add_user_images($user_images, $user_id)
	{
		$this->db->set($user_images);
		$this->db->where('user_id', $user_id);
		$this->db->insert('user_images');
	}

	function get_image_url($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_images');
		$this->db->order_by('image_id', 'desc');
		$this->db->limit(1);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();	

		$val = $query->row();
		$image_path = $val->image_path;

		return $image_path;

	}
}