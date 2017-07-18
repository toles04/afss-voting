<?php
/**
* 
*/
class M_User extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}





	public function post($data)
	{
		if($this->db->insert('users', $data))
		{
			return TRUE;
		}

		return FALSE;
	}





	public function get()
	{
		$this->db->where('deleted', '0');
		$query = $this->db->get('users');

		return $query->result();
	}





	public function get_by($id)
	{
		$this->db->from('users');
		$this->db->where('user_id', $id);
		$this->db->where('users.deleted', '0');
		$this->db->join('countries', 'countries.id = users.user_country');
		$this->db->join('states', 'states.id = users.user_state');
        $query = $this->db->get();

		return $query->result_array();
	}





	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('user_id', $id);

		if($this->db->update('users'))
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
		$this->db->set('user_active', '0');
		$this->db->where('deleted', '0');
		$this->db->where('user_id', $id);
		if($this->db->update('users'))
		{

			return TRUE;

		}

		return FALSE;
	}




	public function record_count() {
			$this->db->where('deleted', '0');
	        $query = $this->db->get("users");
			return count($query->result());

	}




	// Fetch data according to per_page limit.
	public function fetch_data($limit, $start) {

		$this->db->from('users');
		$this->db->limit($limit, $start);
		$this->db->where('users.deleted', '0');
		$this->db->join('countries', 'countries.id = users.user_country');
		$this->db->join('states', 'states.id = users.user_state');
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
