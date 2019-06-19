<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Home_Extended_Model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_job_count_by_expertise_level(){

		$result = $this->db->query("SELECT COUNT(*) as num, xx_expertise_level.el_name, xx_expertise_level.el_slug FROM xx_job_post, xx_expertise_level WHERE xx_job_post.expertise_level = xx_expertise_level.el_id AND xx_expertise_level.show_in_banner = 1 GROUP BY xx_expertise_level.el_id");

		return $result->result_array();
	}

	// gets all categories combined with expertise level and job counts in eachcombined category
	public function get_category_by_expertise_level(){

		$this->db->select(" * ");
		$this->db->from('xx_expertise_level');
		$this->db->join( 'xx_combined_category', 'xx_combined_category.el_id = xx_expertise_level.el_id');
		$this->db->join( 'xx_categories', 'xx_categories.id = xx_combined_category.cat_id');
		$this->db->order_by('xx_expertise_level.order_level', 'asc');

		$result = $this->db->get();
		return $result->result_array();

	}


	// count number of jobs in combined category
	public function count_jobs_by_combined_category( $el_id, $cat_id ){
		$this->db->where( array(
			'category' => $cat_id,
			'expertise_level' => $el_id
		) );
		$this->db->from('xx_job_post');

		return $this->db->count_all_results();
	}


	// get all featured jobs along with compay logo url
	public function get_jobs($limit, $offset)
	{
		$this->db->select('jp.id, job_title, jp.company_name, jp.job_slug, jp.job_type, jp.description, jp.country, jp.city, jp.created_date, jp.industry, xx_companies.company_logo');
		$this->db->from('xx_job_post jp');
		$this->db->join( 'xx_companies', 'xx_companies.employer_id = jp.employer_id' );
		$this->db->where( array(
			'is_status'  => 'active',
			'is_featured'=> 'yes'
			)
		);
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}



}// END CLASS

?>