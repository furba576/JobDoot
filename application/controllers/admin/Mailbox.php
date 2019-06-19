<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->model('admin/Mailbox_model');
	}


	public function index(){
		$data['title'] = 'Mailbox';
		$data['view'] = 'admin/mailbox/mailbox';
		$data['mails'] = $this->Mailbox_model->get_all_mails();
		
		$this->load->view('admin/layout', $data);
	}


	public function viewMail( $id ){
		$data['mail'] = $this->Mailbox_model->mail_detail( $id );
		$data['title'] = "View Mail";
		$data['view'] = "admin/mailbox/view_mail";

		$this->load->view('admin/layout', $data);
		
	}
}