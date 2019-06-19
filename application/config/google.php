<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '766889711926-fvldpiq3lu5q773jptkmtgg462ug1lbb.apps.googleusercontent.com';
$config['google']['client_secret']    = 'ywOiL0ixeVGMwGcDc2ujseQw';
$config['google']['redirect_uri']     = 'http://jobdoot.10orbits.com/auth/googleLogin';
$config['google']['application_name'] = '10Orbits Job Tech';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();