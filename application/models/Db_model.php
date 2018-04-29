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
	
	public function get_achieved_specific($name)
	{
		$sql = 'SELECT * FROM progress_achieved WHERE Name='.$this->db->escape($name).' ORDER BY Badge_ID;';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_cadet_specific($name)
	{
		$sql = 'SELECT * FROM progress_cadets WHERE Name='.$this->db->escape($name).';';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_badges()
	{
		$sql = 'SELECT * FROM progress_badges ORDER BY Badge_ID;';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_cadets()
	{
		$query = $this->db->get('progress_cadets');
		return $query->result_array();
	}
	
		public function get_achieved()
	{
		$query = $this->db->get('progress_achieved');
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
		$arc = 0;
		
		$data= array(
			'name' => $this->input->post('name'),
			'date' => $this->input->post('date'),
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
	
	public function set_sitedefault()
	{
		$page = $this->input->post('page');
		
		$sql = 'SELECT Content FROM pages_default WHERE PageName='.$this->db->escape($page).';';
		$query = $this->db->query($sql);
		$row = $query->row();
		$content = $row->Content;
		$result = '';
		
		$sql = 'UPDATE pages SET Content='.$this->db->escape($content).' WHERE PageName='.$this->db->escape($page).';';
		if ($this->db->simple_query($sql)) 
		{
			$result = '<div class="alert alert-success" role="alert">Success!</div>';
		}
		else
		{
			$result = '<div class="alert alert-danger" role="alert">Query failed!</div>';
		}
		return $result; 
	}
	
	public function get_pagecontent()
	{
		$page = $this->input->post('page');
		$sql = 'SELECT Content FROM pages WHERE PageName='.$this->db->escape($page).';';
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function add_cadet($badges)
	{
		$name = $this->input->post('name');
		$data = array (
			'Name'				=> $name,
			'Rank' 				=> $this->input->post('rank'),
			'Classification' 	=> $this->input->post('classification'),
		);
		
		$this->db->insert('progress_cadets', $data);
		
		$i = 1;
		foreach($badges as $badge):
			$data_ach = array(
				'Badge_ID' 		=> $i,
				'Date'			=> date("Y-m-d"),
				'Level'			=> 'Grey',
				'Name'			=> $name,
			);
			$this->db->insert('progress_achieved', $data_ach);
			$i++;
		endforeach;
	}
	
	public function add_badge()
	{
		$badge = $this->input->post('badge');
		
		$data = array(
			'Badge_Name'	=> $badge,
		);
		$this->db->insert('progress_badges', $data);
		
		$cadets = $this->get_cadets();
		
		$sql = 'SELECT MAX(Badge_ID) FROM progress_badges LIMIT 1;';
		$query = $this->db->query($sql);
		$data_db = $query->result_array();
		$id = $data_db[0]['MAX(Badge_ID)'];
		
		foreach($cadets as $cadet):
			$data_ach = array(
				'Name' 		=> $cadet['Name'],
				'Level' 	=> 'Grey',
				'Date'		=> date("Y-m-d"),
				'Badge_ID'	=> $id,
			);
			$this->db->insert('progress_achieved', $data_ach);		
		endforeach;
	}
	
		public function delete_badge()
	{
		$badge = $this->input->post('badge');
		$sql = 'SELECT Badge_ID FROM progress_badges WHERE Badge_Name='.$this->db->escape($badge).';';
		$query = $this->db->query($sql);
		$data_db = $query->result_array();
		$id = $data_db[0]['Badge_ID'];
			
		$this->db->where('Badge_Name', $badge);
		$this->db->delete('progress_badges');
		
		$this->db->where('Badge_ID', $id);
		$this->db->delete('progress_achieved');
	}
	
	public function delete_cadet()
	{
		$name = $this->input->post('name');
		
		$tables = array('progress_cadets', 'progress_achieved');
		$this->db->where('name', $name);
		$this->db->delete($tables);
	}
	
	public function edit_cadet()
	{
		$name = $this->input->post('name');
		$data_cadets = array (
			'Name'				=> $name,
			'Rank' 				=> $this->input->post('rank'),
			'Classification' 	=> $this->input->post('classification'),
		);
		$db_badge = $this->get_achieved_specific($name);
		$i = 0;
		foreach($db_badge as $badges):
			$data_ach = array(
				'Badge_ID' 		=> $i,
				'Date'			=> $this->input->post('date_'.html_escape($i).''),
				'Level'			=> $this->input->post('level_'.html_escape($i).''),
				'Name'			=> $name,
			);
			$this->db->where('Name', $name);	
			$this->db->where('Badge_ID', $i);	
			$this->db->update('progress_achieved', $data_ach);
			$i++;
		endforeach;
		
		$this->db->where('Name', $data_cadets['Name']);
		$this->db->update('progress_cadets', $data_cadets);
	}
	
	public function get_latest_loas()
	{
		$a = 0;
		$sql = 'SELECT * FROM loa WHERE date='.$this->db->escape(date("Y-m-d")).' AND archived='.$this->db->escape($a).';';
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_latest_badges()
	{
		/* $sql = 'SELECT * FROM progress_achieved WHERE PageName='.$this->db->escape($page).';';
		
		$query = $this->db->query($sql);
		return $query->result_array();*/
	}

}
?>