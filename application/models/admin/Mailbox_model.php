<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox_model extends CI_Model{


	public function get_all_mails(){
		$this->db->select("*");
		$this->db->from('xx_contact_us');
		$this->db->order_by('created_date');

		$result = $this->db->get();

		return $result->result_array();
	}

	public function mail_detail( $id ){
		$this->db->select("*");
		$this->db->from('xx_contact_us');
		$this->db->where('id', $id);

		$result = $this->db->get();

		return $result->row_array();

	}


}