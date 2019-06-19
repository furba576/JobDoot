<?php
class City_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_all_cities(){
		$this->db->order_by('name');
		$query = $this->db->get('xx_cities');
		return $result = $query->result_array();
	}

	//-----------------------------------------------------
	public function add_city($data){
		$result = $this->db->insert('xx_cities', $data);
        return $this->db->insert_id();	
	}

	//-----------------------------------------------------
	public function edit_city($data, $id){
		$this->db->where('id', $id);
		$this->db->update('xx_cities', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_city_by_id($id){
		$query = $this->db->get_where('xx_cities', array('id' => $id));
		return $result = $query->row_array();
	}
	
}
?>