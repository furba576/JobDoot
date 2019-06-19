<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Employers';
		$data['layout'] = 'themes/employers/home/index';
		$this->load->view('themes/layout', $data);
	}
}
