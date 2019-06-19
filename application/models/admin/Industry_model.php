<?php
class Industry_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	public function get_all_industries(){
		$this->db->order_by('name');
		$query = $this->db->get('xx_industries');
		return $result = $query->result_array();
	}
	//-----------------------------------------------------
	public function add_industry($data){
		$result = $this->db->insert('xx_industries', $data);
        return $this->db->insert_id();	
	}
	//-----------------------------------------------------
	public function edit_industry($data, $id){
		$this->db->where('id', $id);
		$this->db->update('xx_industries', $data);
		return true;

	}
	//-----------------------------------------------------
	public function get_industry_by_id($id){
		$query = $this->db->get_where('xx_industries', array('id' => $id));
		return $result = $query->row_array();
	}
	
}
?>