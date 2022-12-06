<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_all_user(){
		$hsl=$this->db->get('tbl_user');
		return $hsl;	
	}

	public function getAllUsers(){
		$query = $this->db->get('tbl_user');
		return $query->result(); 
	}

	public function insert($user){
		$hsl=$this->db->insert('tbl_user', $user);
		return $hsl; 
	}

	public function getUser($id){
		$query = $this->db->get_where('tbl_user',array('id'=>$id));
		return $query->row_array();
	}

	public function activate($data, $id){
		$this->db->where('tbl_user.id', $id);
		return $this->db->update('tbl_user', $data);
	}

}
