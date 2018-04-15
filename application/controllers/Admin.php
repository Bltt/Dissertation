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
	
	public function users()
	{
		if( $this->require_min_level(6) )
		{
			$this->load->helper('form');
			$this->load->helper('auth');
			$this->load->library('form_validation');
			$this->load->model('usercreate_model');
			$this->load->model('validation_callables');
			
			$validation_rules = [
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required|max_length[12]|is_unique[' . db_table('user_table') . '.username]',
				'errors' => [
					'is_unique' => 'Username already in use.',
					'required' => 'The username field is required.'
				]
			],
			[
				'field' => 'passwd',
				'label' => 'passwd',
				'rules' => [
					'trim',
					'required',
					[ 
						'_check_password_strength', 
						[ $this->validation_callables, '_check_password_strength' ] 
					]
				],
				'errors' => [
					'required' => 'The password field is required.'
				]
			],
			[
				'field'  => 'email',
				'label'  => 'email',
				'rules'  => 'trim|required|valid_email|is_unique[' . db_table('user_table') . '.email]',
				'errors' => [
					'is_unique' => 'Email address already in use.'
				]
			],
			[
				'field' => 'auth_level',
				'label' => 'auth_level',
				'rules' => 'required|integer|in_list[1,3,6,8,9]'
			]
		];

		$this->form_validation->set_rules( $validation_rules );
		$data['db'] = $this->db_model->get_users();
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users', $data);
				$this->load->view('pages/private/users_form');
				$this->load->view('templates/private/footer');
			}
			else
			{
				//$this->db_model->set_user();
				
				$user_data= array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'auth_level' => $this->input->post('auth_level'),
					'passwd' => $this->input->post('passwd')
				);
				
				$user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
				$user_data['user_id']    = $this->usercreate_model->get_unused_id();
				$user_data['created_at'] = date('Y-m-d H:i:s');


				$this->db->set($user_data)
					->insert(db_table('user_table'));
			
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users', $data);
				if( $this->db->affected_rows() == 1 )
				echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
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