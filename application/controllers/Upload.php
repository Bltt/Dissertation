<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
		public function upload()
	{
		$this->load->view('templates/private/header');
		$this->load->view('pages/private/imageupload', array('error' => ' '));
		$this->load->view('templates/private/footer');
	}
	
	 public function do_upload()
        {
                $config['upload_path']          = './assets/images/uploads/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
						
						$this->load->view('templates/private/header');
                        $this->load->view('pages/private/imageupload', $error);
						$this->load->view('templates/private/footer');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						
						$this->load->view('templates/private/header');
                        $this->load->view('pages/private/imageupload_success', $data);
						$this->load->view('templates/private/footer');
                }
        }
}
?>