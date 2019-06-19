<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    // Get industry name by id
    function get_industry_name($id)
    {
    	$CI = & get_instance();
    	return $CI->db->get_where('xx_industries', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get category name by id
    function get_category_name($id)
    {
    	$CI = & get_instance();
    	return $CI->db->get_where('xx_categories', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get category ID by title
    function get_category_id($category_name)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_categories', array('slug' => $category_name))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get country name by ID
    function get_country_name($id)
    {
    	$CI = & get_instance();
    	return $CI->db->get_where('xx_countries', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get city name by ID
    function get_city_name($id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_cities', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get city ID by title
    function get_city_slug($id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_cities', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get category by ID
    function get_category_slug($id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_categories', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get industry by title
    function get_industry_id($title)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_industries', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get industry by id
    function get_industry_slug($id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_industries', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get City ID by Name
    function get_city_id($title)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_cities', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_nationality_name($id)
    {
    	$CI = & get_instance();
    	return $CI->db->get_where('xx_countries', array('id' => $id))->row_array()['country'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_education_level($id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_education', array('id' => $id))->row_array()['type'];
    }

    // -----------------------------------------------------------------------------
    // Get User Skills
    function get_user_skills($user_id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_users', array('id' => $user_id))->row_array()['skills'];
    }

    // -----------------------------------------------------------------------------
    // Get Company Name by Employer ID
    function get_company_name_by_employer($emp_id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_companies', array('employer_id' => $emp_id))->row_array()['company_name'];
    }

    // -----------------------------------------------------------------------------
    // Get Company Name by Employer ID
    function get_company_id_by_employer($emp_id)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_companies', array('employer_id' => $emp_id))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Company ID by title
    function get_company_id($title)
    {
        $CI = & get_instance();
        return $CI->db->get_where('xx_companies', array('company_slug' => $title))->row_array()['id'];
    }

?>