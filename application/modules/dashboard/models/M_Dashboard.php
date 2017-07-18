<?php
/**
* 
*/
class M_Dashboard extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}



	public function get_elections()
	{
		$this->db->from('elections');
		$this->db->limit(4);
		$this->db->where('elections.deleted', '0');
		$this->db->join('positions', 'positions.position_id = elections.position_id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_candidates()
	{
		$this->db->from('candidates');
		$this->db->limit(4);
		$this->db->where('candidates.deleted', '0');
		$this->db->join('elections', 'elections.election_id = candidates.election_id');
		$this->db->join('users', 'users.user_id = candidates.user_id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_users()
	{
		
		$this->db->limit(5);
		$this->db->where('deleted', '0');
		$query = $this->db->get('users');

		return $query->result();
	}

	public function get_positions()
	{
		$this->db->from('positions');
		$this->db->limit(5);
		$this->db->where('positions.deleted', '0');
		$this->db->join('users', 'users.user_id = positions.user_id');
		$query = $this->db->get();

		return $query->result();
	}
	

	public function vote_count($election, $id) {
			$this->db->where('candidate_id', $id);
			$this->db->where('election_id', $election);
	        $query = $this->db->get("votes");
			return count($query->result());

	}


}
