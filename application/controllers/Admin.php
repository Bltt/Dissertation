<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper(array('form', 'url'));
	}
	
	public function view($page = 'dash')
	{		
		if( $this->require_min_level(1) )
		{
			if ( ! file_exists(APPPATH.'views/pages/private/'.$page.'.php'))
			{
					// Whoops, we don't have a page for that!
					show_404();
			}
		
			if($page == 'loa')
			{
				$data['db'] = $this->db_model->get_loa();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/loa', $data);
				$this->load->view('templates/private/footer');
			}
			else
			{
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/'.$page);
				$this->load->view('templates/private/footer');
			}
		}
	}
	
	public function logout()
	{
		$this->authentication->logout();

		// Set redirect protocol
		$redirect_protocol = USE_SSL ? 'https' : NULL;

		redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
	}
}
?>