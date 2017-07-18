<?php
/**
* 
*/
class M_Position extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}





	public function post($data)
	{
		if($this->db->insert('positions', $data))
		{
			return TRUE;
		}

		return FALSE;
	}





	public function get()
	{

		$this->db->where('deleted', '0');
		$query = $this->db->get('positions');

		return $query->result();
	}





	public function get_by($id)
	{
		$this->db->from('positions');
		$this->db->where('position_id', $id);
		$this->db->join('users', 'users.user_id = positions.user_id');
		$query = $this->db->get();

		return $query->result_array();
	}





	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('position_id', $id);

		if($this->db->update('positions'))
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
		$this->db->where('position_id', $id);
		if($this->db->update('positions'))
		{

			return TRUE;

		}

		return FALSE;
	}




	public function record_count() {
			$this->db->where('deleted', '0');
	        $query = $this->db->get("positions");
			return count($query->result());

	}




	// Fetch data according to per_page limit.
	public function fetch_data($limit, $start) {

		$this->db->from('positions');
		$this->db->limit($limit, $start);
		$this->db->where('positions.deleted', '0');
		$this->db->join('users', 'users.user_id = positions.user_id');
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
