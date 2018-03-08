<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function view($page = 'home')
	{
        if ( ! file_exists(APPPATH.'views/pages/public/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/public/header', $data);
        $this->load->view('pages/public/'.$page, $data);
        $this->load->view('templates/public/footer', $data);
	}
}
?>