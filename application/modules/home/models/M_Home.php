<?php
/**
* 
*/
class M_Home extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	function get_countries()
	{
		$query = $this->db->get('countries');
		return $query->result();

	}


	function get_states($id)
	{
		$this->db->where('country_id', $id);
		$query = $this->db->get('states');
		return $query->result();

	}
}