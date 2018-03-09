<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {
	
	 public function __construct()
    {
        $this->load->database();
    }
	
	public function get_loa()
	{
		$query = $this->db->get('loa');
		return $query->result_array();
	}
	
	public function set_leave()
	{
		$date = date("Y-m-d H:i:s"); 
		$arc = 0;
		
		$data= array(
			'name' => $this->input->post('name'),
			'date' => $date,
			'reason' => $this->input->post('reason'),
			'archived' => $arc
		);
		
		return $this->db->insert('loa', $data);
	}
	
	
}
?>