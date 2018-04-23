<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');

    }
	
	public function view($page = 'home')
	{
        if ( ! file_exists(APPPATH.'views/pages/public/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		if ($page == 'leave' || $page == 'success')
		{
			$this->leave();
		}
		else
		{
			$data['db'] = $this->db_model->get_content($page);
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/public', $data);
			$this->load->view('templates/public/footer');
		}
	}
	
	public function login()
	{
		// Method should not be directly accessible
		if( $this->uri->uri_string() == 'pages/login')
			show_404();

		if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
			$this->require_min_level(1);

		$this->setup_login_form();

		$html = $this->load->view('pages/login/header', '', TRUE);
		$html .= $this->load->view('pages/login/login_form', '', TRUE);
		$html .= $this->load->view('pages/login/footer', '', TRUE);

		echo $html;
	}
	
	public function leave()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('reason', 'Reason', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/leave');
			$this->load->view('templates/public/footer');
		}
		else
		{
			$this->db_model->set_leave();
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/success');
			$this->load->view('templates/public/footer');
		}
	}
}
?>