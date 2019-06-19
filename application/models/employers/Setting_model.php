<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_Model extends CI_Model{

	//-------------------------------------------------------
	// Chagne password
	public function update_password($data,$emp_id){
		$query = $this->db->get_where('xx_employers' , array('id' => $emp_id));
		$result = $query->row_array();

		 $validPassword = password_verify($data['old_password'], $result['password']);
		if ($validPassword) {
			$this->db->where('id',$emp_id);
			$this->db->update('xx_employers',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}

}

?>