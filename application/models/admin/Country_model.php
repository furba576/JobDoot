<?php
class Country_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_all_countries(){
		$this->db->order_by('name');
		$query = $this->db->get('xx_countries');
		return $result = $query->result_array();
	}

	//-----------------------------------------------------
	public function add_country($data){
		$result = $this->db->insert('xx_countries', $data);
        return $this->db->insert_id();	
	}

	//-----------------------------------------------------
	public function edit_country($data, $id){
		$this->db->where('id', $id);
		$this->db->update('xx_countries', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_country_by_id($id){
		$query = $this->db->get_where('xx_countries', array('id' => $id));
		return $result = $query->row_array();
	}
	
}
?>