<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

// setting route for admin
$route['admin'] = 'admin/auth';

// setting route for job page
$route['jobs'] = 'jobs/index';
$route['jobs/(:num)'] = 'jobs/index/$1';

$route['job-by-category/(:any)/(:any)'] = 'JobsExtended/get_jobs_by_combined_category/$1/$2';

// setting route for job detail page
$route['jobs/(:num)/(:any)'] = 'jobs/job_detail/$1/$2';

// setting route for companies
$route['company/(:any)'] = 'company/detail/$1';

// setting route for jobs by category, industry & location
$route['jobs-by-category'] = 'jobs/jobs_by_category';
$route['jobs-by-industry'] = 'jobs/jobs_by_industry';
$route['jobs-by-location'] = 'jobs/jobs_by_location';


// seting for abou page
$route['about'] = 'home/about_us';

// seting for contact us page
$route['contact'] = 'home/contact';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
