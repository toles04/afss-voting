<?php
/**
* 
*/
class M_Candidate extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}





	public function post($data)
	{
		if($this->db->insert('candidates', $data))
		{
			return TRUE;
		}

		return FALSE;
	}





	public function get()
	{
		$this->db->where('deleted', '0');
		$query = $this->db->get('candidates');

		return $query->result();
	}





	public function get_by($id)
	{
		$this->db->where('candidate_id', $id);
		$query = $this->db->get('candidates');

		return $query->result_array();
	}





	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('candidate_id', $id);

		if($this->db->update('candidates'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

		//return $query->result();
	}




	public function delete($id)
	{	
		$this->db->set('deleted', '1');
		$this->db->where('deleted', '0');
		$this->db->where('candidate_id', $id);
		if($this->db->update('candidates'))
		{

			return TRUE;

		}

		return FALSE;
	}




	public function record_count() {
			$this->db->where('deleted', '0');
	        $query = $this->db->get("candidates");
			return count($query->result());

	}





	public function vote_count($election, $id) {
			$this->db->where('candidate_id', $id);
			$this->db->where('election_id', $election);
	        $query = $this->db->get("votes");
			return count($query->result());

	}


	public function candidate_count($election, $user_id) {
			$this->db->where('user_id', $user_id);
			$this->db->where('election_id', $election);
	        $query = $this->db->get("candidates");
			return count($query->result());

	}




	// Fetch data according to per_page limit.
	public function fetch_data($limit, $start) {

		
		$this->db->from('candidates');
		$this->db->limit($limit, $start);
		$this->db->where('candidates.deleted', '0');
		$this->db->join('elections', 'elections.election_id = candidates.election_id');
		$this->db->join('users', 'users.user_id = candidates.user_id');
		//$this->db->join('elections', 'elections.election_id = candidates.election_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

}
