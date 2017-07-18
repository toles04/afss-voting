<?php
/**
* 
*/
class M_Election extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}





	public function post($data)
	{
		if($this->db->insert('elections', $data))
		{
			return TRUE;
		}

		return FALSE;
	}





	public function get()
	{
		$this->db->where('deleted', '0');
		$query = $this->db->get('elections');

		return $query->result();
	}





	public function get_by($id)
	{
		$this->db->from('elections');
		$this->db->where('election_id', $id);
		$this->db->join('positions', 'positions.position_id = elections.position_id');
		$query = $this->db->get();

		return $query->result_array();
	}





	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('election_id', $id);

		if($this->db->update('elections'))
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
		$this->db->where('election_id', $id);
		if($this->db->update('elections'))
		{

			return TRUE;

		}

		return FALSE;
	}




	public function record_count() {
			$this->db->where('deleted', '0');
	        $query = $this->db->get("elections");
			return count($query->result());

	}




	// Fetch data according to per_page limit.
	public function fetch_data($limit, $start) {

		
		$this->db->from('elections');
		$this->db->limit($limit, $start);
		$this->db->where('elections.deleted', '0');
		$this->db->join('positions', 'positions.position_id = elections.position_id');
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
