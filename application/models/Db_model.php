<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {
	
	 public function __construct()
    {
        $this->load->database();
    }
	
	public function get_content($name)
	{
		$sql = 'SELECT Content FROM pages WHERE PageName='.$this->db->escape($name).';';
		$query = $this->db->query($sql);
		$row = $query->row();
		$content = $row->Content;
		return $content;
	}
	
	public function get_progress()
	{
		$query = $this->db->get('progress');
		return $query->result_array();
	}
	
	public function get_loa()
	{
		$query = $this->db->get_where('loa', 'archived = 0');
		return $query->result_array();
	}
	
	public function get_loa_archived()
	{
		$query = $this->db->get_where('loa', 'archived = 1');
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
	
	public function get_users()
	{
		$query = $this->db->get('users');
		return $query->result_array();
	}
	
	public function get_siteoptions()
	{
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	
	public function get_pagecontent()
	{
		$page = $this->input->post('page');
		$sql = 'SELECT Content FROM pages WHERE PageName='.$this->db->escape($page).';';
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
}
?>