<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// array of slugs of expertise_level to be shown in jobs by category section of home page
$expertise_level = array(
	array( 
		'slug' => 'internship-trainee',
		'name' => 'Internship/Trainee'
	),
	array( 
		'slug' => 'entry-level',
		'name' => 'Entry Level'
	),
	array( 
		'slug' => 'intermediate-level',
		'name' => 'Intermediate Level'
	),
	array( 
		'slug' => 'expert-level',
		'name' => 'Expert Level'
	),
	array( 
		'slug' => 'manager-level',
		'name' => 'Manager Level'
	),
	array( 
		'slug' => 'c-suite',
		'name' => 'C-suite'
	),
);

$config['expertise_level_slug'] = $expertise_level;



// for facebook
/*
| -------------------------------------------------------------------
|  Facebook API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  facebook_app_id               string   Your Facebook App ID.
|  facebook_app_secret           string   Your Facebook App Secret.
|  facebook_login_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  facebook_logout_redirect_url  string   URL to redirect back to after logout. (do not include base URL)
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_permissions          array    Your required permissions.
|  facebook_graph_version        string   Specify Facebook Graph version. Eg v3.2
|  facebook_auth_on_load         boolean  Set to TRUE to check for valid access token on every page load.
*/
$config['facebook_app_id']                = '2038416323121237';
$config['facebook_app_secret']            = 'ffff14a61a3d5c341e2c546300d39888';
$config['facebook_login_redirect_url']    = 'auth/fbLogin';
$config['facebook_logout_redirect_url']   = 'auth/logout';
$config['facebook_login_type']            = 'web';
$config['facebook_permissions']           = array('email');
$config['facebook_graph_version']         = 'v3.2';
$config['facebook_auth_on_load']          = TRUE;

?>