<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// -----------------------------------------------------------------------------
    // Make Title From Slug Function    
    if (!function_exists('make_title'))
    {
        function make_title($string)
        {
        	return ucfirst(preg_replace('/-/', " ", $string));
        }
    }


?>