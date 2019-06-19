<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users()
		{
			return $this->db->count_all('xx_users');
		}
		public function get_active_users()
		{
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('xx_users');
		}
		public function get_deactive_users()
		{
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('xx_users');
		}

		public function get_all_employers()
		{
			return $this->db->count_all('xx_employers');
		}
		public function get_active_employers()
		{
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('xx_employers');
		}
		public function get_deactive_employers()
		{
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('xx_employers');
		}

		public function get_latest_users()
		{
			$this->db->select('*');
			$this->db->from('xx_users');
			$this->db->order_by('created_date','desc');
			$this->db->limit(10, 0);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

?>
