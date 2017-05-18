<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Alamat extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function tampil(){
		$this->db->order_by("id", "desc");
		$query=$this->db->get("alamat");
		return $query->result_array();
	}

	public function create(){
		$this->db->insert("alamat", array("nama"=>""));
		return $this->db->insert_id();
	}

	public function update($id,$value,$modul){
		$this->db->where(array("id"=>$id));
		$this->db->update("alamat", array($modul=>$value));
	}

	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("alamat");
	}
	
}