<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Painel_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}


	public function possui_trabalho_anexado($id){
		$this->db->where('id_participante', $id);
		$return = $this->db->get('trabalho')->row();
		if($return == NULL) return false;
		else return true;
	}

	public function status_trabalho($id){
		$this->db->where('id_participante', $id);
		$trabalho = $this->db->get('trabalho')->row();
		return $trabalho->status;
	}

}