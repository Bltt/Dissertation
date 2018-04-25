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
			$data['loa'] = $this->db_model->get_latest_loas();
			$data['badges_latest'] = $this->db_model->get_latest_badges();
			
			$this->load->view('templates/private/header');
			$this->load->view('pages/private/'.$page, $data);
			$this->load->view('templates/private/footer');
		}
	}
	
	public function loa()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('ID', 'ID', 'required');
		
		if($this->form_validation->run() === FALSE)
			{
				$data['db'] = $this->db_model->get_loa();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/loa', $data);
				$this->load->view('templates/private/footer');
			}
			else
			{
				$id = $this->input->post('ID');
				$sql =  "UPDATE loa SET archived='1' WHERE ID=".$this->db->escape($id).";";
				if ($this->db->simple_query($sql)) 
				{
					$result = "Success!";
				}
				else
				{
					$result = "Query failed!";
				}
				echo $result;
				$data['db'] = $this->db_model->get_loa();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/loa', $data);
				$this->load->view('templates/private/footer');
			}
	}
	
	public function archivedloa()
	{
		$data['db'] = $this->db_model->get_loa_archived();
		$this->load->view('templates/private/header');
		$this->load->view('pages/private/archivedloa', $data);
		$this->load->view('templates/private/footer');
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
				'rules' => 'required|integer|in_list[1,3,6]'
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
			
				$data['db'] = $this->db_model->get_users();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users', $data);
				$this->load->view('pages/private/users_form');
				$this->load->view('templates/private/footer');
			}
		}
	}
	
	public function userdelete()
	{
		if( $this->require_min_level(6) )
		{
			$this->load->helper('form');
			$this->load->helper('auth');
			$this->load->library('form_validation');
			$result = '';
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{
				$data['db'] = $this->db_model->get_users();
				$data['result'] = $result;
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users_delete', $data);
				$this->load->view('templates/private/footer');	
			}
			else
			{
				$username = $this->input->post('username');
				$sql = 'DELETE FROM users WHERE username='.$this->db->escape($username).';';
				if(($username != 'admin') && ($username != 'oc'))
				{
					if ($this->db->simple_query($sql)) 
					{
						$result = '<div class="alert alert-success" role="alert">Success!</div>';
					}
					else
					{
						$result = '<div class="alert alert-danger" role="alert">Query failed!</div>';
					}
				}
				else
				{
					$result = '<div class="alert alert-danger" role="alert">OC or admin cannot be changed!</div>';
				}
				$data['result'] = $result;
				$data['db'] = $this->db_model->get_users();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users_delete', $data);
				$this->load->view('templates/private/footer');
			}
		}
	}
	
	public function userpass()
	{
		if( $this->require_min_level(6) )
		{
			$this->load->helper('form');
			$this->load->helper('auth');
			$this->load->library('form_validation');
			$result = '';
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{
				$data['db'] = $this->db_model->get_users();
				$data['result'] = $result;
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users_pass', $data);
				$this->load->view('templates/private/footer');	
			}
			else
			{
				$username = $this->input->post('username');
				$pass = $this->input->post('password');
				$passwd = $this->authentication->hash_passwd($pass);
				$sql = 'UPDATE users SET passwd='.$this->db->escape($passwd).' WHERE username='.$this->db->escape($username).';';
				if(($username != 'admin') && ($username != 'oc'))
				{
					if ($this->db->simple_query($sql)) 
					{
						$result = '<div class="alert alert-success" role="alert">Success!</div>';
					}
					else
					{
						$result = '<div class="alert alert-danger" role="alert">Query failed!</div>';
					}
				}
				else
				{
					$result = '<div class="alert alert-danger" role="alert">OC or admin cannot be changed!</div>';
				}
				$data['result'] = $result;
				$data['db'] = $this->db_model->get_users();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/users_pass', $data);
				$this->load->view('templates/private/footer');
			
			}
		}
	}
	
	public function editsite()
	{
		if( $this->require_min_level(6) )
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$data['db'] = $this->db_model->get_siteoptions();
			
			$this->form_validation->set_rules('page', 'Page', 'required');
				
			if ($this->form_validation->run() === FALSE)
			{
				$data['db'] = $this->db_model->get_siteoptions();
				$this->load->view('templates/private/header');
				$this->load->view('pages/private/editsite', $data);
				$this->load->view('templates/private/footer');
			}
			else
			{
				$name = $this->input->post('page');
				$this->session->set_flashdata('name', $name);
				redirect('/admin/editpage');
			}
		}
	}
	
	public function editpage()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('contenteditor', 'ContentEditor', 'required');
		
		$name = $this->session->flashdata('name');
		
		$sql = 'SELECT Content FROM pages WHERE PageName='.$this->db->escape($name).';';
		$query = $this->db->query($sql);
		$row = $query->row();
		$content = $row->Content;
		
		if($this->form_validation->run() === FALSE)
		{
			$data['name'] = $name;
			$data['content'] = $content;
			
			$this->session->set_flashdata('name', $name);
				
			$this->load->view('templates/private/header');
			$this->load->view('pages/private/editpage', $data);
			$this->load->view('templates/private/footer');
		}
		else
		{
			
			$name = $this->input->post('name');
			$content = $this->input->post('contenteditor');
			$data['name'] = $name;
			$data['content'] = $content;
			
			$sql = 'UPDATE pages SET Content='.$this->db->escape($content).' WHERE PageName='.$this->db->escape($name).';';
			if ($this->db->simple_query($sql)) 
			{
				$result = "Success!";
			}
			else
			{
				$result = "Query failed!";
			}
			$data['result'] = $result;
			$this->load->view('templates/private/header');
			$this->load->view('pages/private/editpage', $data);
			echo $result;
			$this->load->view('templates/private/footer');
		}
	}

	public function progtracker()
	{
		$data['db_badge'] = $this->db_model->get_badges();
		$data['db_cadets'] = $this->db_model->get_cadets();
		$data['db_achieved'] = $this->db_model->get_achieved();
		
		$this->load->view('templates/private/header_big');
		$this->load->view('pages/private/progtracker', $data);
		$this->load->view('templates/private/footer');
	}
	
	public function progtrack_edit()
	{
		if( $this->require_min_level(3) )
		{
			$data['db_badge'] = $this->db_model->get_badges();
			$data['db_cadets'] = $this->db_model->get_cadets();
			$data['db_achieved'] = $this->db_model->get_achieved();
			
			$this->load->helper('form');
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('Selector', 'Selector', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/private/header_big');
				$this->load->view('pages/private/progtrack_edit', $data);
				$this->load->view('templates/private/footer');
			}
			else
			{
				$name = $this->input->post('Selector');
				$this->session->set_flashdata('name', $name);
				redirect('/admin/editcadet');
			}
		}
	}
	
	public function progcadetadd()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
			
		$data['db_badge'] = $this->db_model->get_badges();
		$data['db_cadets'] = $this->db_model->get_cadets();
		$data['db_achieved'] = $this->db_model->get_achieved();
		
		$this->form_validation->set_rules('name', 'Name', 'required|is_unique[progress_cadets.Name]');
		$this->form_validation->set_rules('rank', 'Rank', 'required');
		$this->form_validation->set_rules('classification', 'Classification', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/private/header_big');
			$this->load->view('pages/private/prog_cadet_add', $data);
			$this->load->view('templates/private/footer');
		}
		else
		{
			$this->db_model->add_cadet($data['db_badge']);
			
			$data['db_badge'] = $this->db_model->get_badges();
			$data['db_cadets'] = $this->db_model->get_cadets();
			$data['db_achieved'] = $this->db_model->get_achieved();
			
			$this->load->view('templates/private/header_big');
			$this->load->view('pages/private/prog_cadet_add', $data);
			$this->load->view('templates/private/footer');
		}
	}
	
	public function progcadetdelete()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
			
		$data['db_badge'] = $this->db_model->get_badges();
		$data['db_cadets'] = $this->db_model->get_cadets();
		$data['db_achieved'] = $this->db_model->get_achieved();
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/private/header_big');
			$this->load->view('pages/private/prog_cadet_delete', $data);
			$this->load->view('templates/private/footer');
		}
		else
		{
			$this->db_model->delete_cadet();
			
			$data['db_badge'] = $this->db_model->get_badges();
			$data['db_cadets'] = $this->db_model->get_cadets();
			$data['db_achieved'] = $this->db_model->get_achieved();
			
			$this->load->view('templates/private/header_big');
			$this->load->view('pages/private/prog_cadet_delete', $data);
			$this->load->view('templates/private/footer');
		}
	}
	
	public function editcadet()
	{
		if( $this->require_min_level(3) )
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$name = $this->session->flashdata('name');
			
			$data['db_badge'] = $this->db_model->get_badges();
			$data['db_achieved'] = $this->db_model->get_achieved_specific($name);
			$data['db_cadet'] = $this->db_model->get_cadet_specific($name);
		
			$this->form_validation->set_rules('name', 'name', 'required');			
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata('name', $name);
				
				$this->load->view('templates/private/header_big');
				$this->load->view('pages/private/progtrack_editcadet', $data);
				$this->load->view('templates/private/footer');
			}
			else
			{
				$this->db_model->edit_cadet();
				
				$data['db_badge'] = $this->db_model->get_badges();
				$data['db_achieved'] = $this->db_model->get_achieved_specific($name);
				$data['db_cadet'] = $this->db_model->get_cadet_specific($name);
				$this->load->view('templates/private/header_big');
				$this->load->view('pages/private/progtrack_editcadet', $data);
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