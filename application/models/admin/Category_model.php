<?php
class Category_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	public function get_all_categories(){
		$this->db->order_by('name');
		$query = $this->db->get('xx_categories');
		return $result = $query->result_array();
	}
	//-----------------------------------------------------
	public function add_category($data){
		$result = $this->db->insert('xx_categories', $data);
        return $this->db->insert_id();	
	}
	//-----------------------------------------------------
	public function edit_category($data, $id){
		$this->db->where('id', $id);
		$this->db->update('xx_categories', $data);
		return true;

	}
	//-----------------------------------------------------
	public function get_category_by_id($id){
		$query = $this->db->get_where('xx_categories', array('id' => $id));
		return $result = $query->row_array();
	}


	//--------------------------------------------------------------
	// get categories by expertise level id
	public function get_categories_of_expertise_level( $el_id ){

		$this->db->select(" * ");
		$this->db->from('xx_expertise_level');
		$this->db->join( 'xx_combined_category', 'xx_combined_category.el_id = xx_expertise_level.el_id');
		$this->db->join( 'xx_categories', 'xx_categories.id = xx_combined_category.cat_id');
		$this->db->where( 'xx_combined_category.el_id', $el_id );
		$this->db->order_by('xx_categories.name', 'asc');

		$result = $this->db->get();
		return $result->result_array();

	}

	//------------------------------------------------------------------
	//get expertise level

	public function get_expertise_level(){

		$this->db->select('*');
		$this->db->from('xx_expertise_level');
		$result = $this->db->get();

		return $result->result_array();

	}


	//-----------------------------------------------------------------
	//add to combined cateogry

	public function addToCombinedCategory( $data ){
		$this->db->insert( 'xx_combined_category', $data );
	}


	//-----------------------------------------------------------------
	//add to combined cateogry

	public function removeFromCombinedCategory( $data ){
		$this->db->where( $data );
		$this->db->delete('xx_combined_category');

	}

}
?>