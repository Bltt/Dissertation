<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function view($page = 'dash')
	{
        if ( ! file_exists(APPPATH.'views/pages/private/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/private/header', $data);
        $this->load->view('pages/private/'.$page, $data);
        $this->load->view('templates/private/footer', $data);
	}
}
?>