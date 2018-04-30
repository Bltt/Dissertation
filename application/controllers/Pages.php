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
	
	public function contact()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('info', 'Info', 'required');
		
		$result = '';
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['result'] = $result;
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/contact', $data);
			$this->load->view('templates/public/footer');
		}
		else
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$info = $this->input->post('info');
			$subject = date("Y-m-d").' - WEBSITE - '.$name;
			$message = 'CONTACT US -'.$subject.' \n '.$info;
			
			$config = Array(
				'protocol' 		=> 'smtp',
				'smtp_host' 	=> 'ssl://smtp.googlemail.com',
				'smtp_port' 	=> 465,
				'smtp_user'		=> 'marklightfoot96@gmail.com',
				'smtp_pass' 	=> 'ycbvorataefldbid',
				'mailtype' 		=> 'html',
				'charset'		=> 'iso-8859-1',
				'wordwrap'		=> TRUE
			);
			
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('marklightfoot96@gmail.com', $name);
			$this->email->reply_to($email, $name);
			$this->email->to('arya.solus@gmail.com');
			$this->email->cc('');
			$this->email->subject($subject);
			$this->email->message($message);
			
			if($this->email->send())
			{
				$result = '<div class="alert alert-success" role="alert">Success!</div>';
			}
			else
			{
				$result = '<div class="alert alert-success" role="alert">'.show_error($this->email->print_debugger()).'</div>';
			}

			
			$data['result'] = $result;
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/contact', $data);
			$this->load->view('templates/public/footer');
		}
	}
	
	public function join()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		
		$result = '';
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['result'] = $result;
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/join', $data);
			$this->load->view('templates/public/footer');
		}
		else
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$age = $this->input->post('age');
			$year = $this->input->post('year');
			$subject = date("Y-m-d").' - JOIN REQUEST - '.$name;
			$message = 'JOIN REQUEST \n NAME: '.$name.' \n AGE: .'.$age.' \n YEAR: .'.$year.' \n EMAIL: '.$email.' .';
			
			$config = Array(
				'protocol' 		=> 'smtp',
				'smtp_host' 	=> 'ssl://smtp.googlemail.com',
				'smtp_port' 	=> 465,
				'smtp_user'		=> 'marklightfoot96@gmail.com',
				'smtp_pass' 	=> 'ycbvorataefldbid',
				'mailtype' 		=> 'html',
				'charset'		=> 'iso-8859-1',
				'wordwrap'		=> TRUE
			);
			
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('marklightfoot96@gmail.com', $name);
			$this->email->reply_to($email, $name);
			$this->email->to('arya.solus@gmail.com');
			$this->email->cc('');
			$this->email->subject($subject);
			$this->email->message($message);
			
			if($this->email->send())
			{
				$result = '<div class="alert alert-success" role="alert">Success!</div>';
			}
			else
			{
				$result = '<div class="alert alert-success" role="alert">'.show_error($this->email->print_debugger()).'</div>';
			}

			
			$data['result'] = $result;
			$this->load->view('templates/public/header');
			$this->load->view('pages/public/join', $data);
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