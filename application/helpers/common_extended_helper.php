<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    // Get Expertise Level ID by slug
    function get_expertise_level_id($title){
        $CI = & get_instance();
        return $CI->db->get_where('xx_expertise_level', array('el_slug' => $title))->row_array()['el_id'];
    }


    // -----------------------------------------------------------------------------
    // Get Expertise Level Name by ID

    function get_expertise_level_name( $id ){
    	$CI = & get_instance();
        return $CI->db->get_where('xx_expertise_level', array('el_id' => $id))->row_array()['el_name'];
    }


?>