<?php
/**
* 
*/
class M_Vote extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}



	public function get_election($election_id)
	{
		$this->db->where('election_id', $election_id);
		$this->db->where('deleted', '0');
		//$this->db->join('elections', 'positions.position_id = elections.position_id');
		$query = $this->db->get('elections');

		return $query->row();
	}

	function post($data)
	{
		if($this->db->insert('votes', $data))
		{
			return $this->db->insert_id();
		}
		return FALSE;
	}

	function check($user_id, $election_id, $candidate_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('election_id', $election_id);
		$this->db->where('candidate_id', $candidate_id);
		$query = $this->db->get('votes');

		return $query->row();

	}

	function check_status($user_id, $election_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('election_id', $election_id);
		$query = $this->db->get('votes');

		return $query->row();

	}

	

	public function vote_count($election, $id) {
			$this->db->where('candidate_id', $id);
			$this->db->where('election_id', $election);
	        $query = $this->db->get("votes");
			return count($query->result());

	}


	public function get_election_candidates($election_id)
	{
		$this->db->from('candidates');
		$this->db->limit(5);
		$this->db->where('candidates.deleted', '0');
		$this->db->where('election_id', $election_id);
		//$this->db->join('elections', 'elections.election_id = candidates.election_id');
		$this->db->join('users', 'users.user_id = candidates.user_id');
		//$this->db->join('user_images', 'user_images.user_id = candidates.user_id');
		$query = $this->db->get();

		return $query->result();
	}


	// Fetch data according to per_page limit.
	public function fetch_data() {

		$this->db->from('elections');
		$this->db->limit(5);
		$this->db->where('elections.deleted', '0');
        $query = $this->db->get();
        return $query->result();
	}


}
