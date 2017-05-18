<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_Alamat');
		//$this->load->database(); //udh di setting di autoload=libraries
	}

	public function index(){
		$data['data_diri']=$this->M_Alamat->tampil();
		$this->load->view('v_Alamat', $data);
	}

	public function create(){
	echo json_encode(array("id"=>$this->M_Alamat->create()));
	}

	public function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->M_Alamat->update($id,$value,$modul);
		echo "{}";
	}

	public function delete(){
		$id= $this->input->post("id");
		$this->M_Alamat->delete($id);
		echo "{}";
	}
}