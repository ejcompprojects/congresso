<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Minicursos_model extends CI_Model{ 

    public function listar_minicursos($filtro = 'id'){
		$this->db->order_by($filtro,'DESC');
		return $this->db->get('minicurso')->result();
	}

	public function insertParticipante_interesse($dados){
		if($this->db->insert('participante_interesse_minicurso',$dados)){
        	return TRUE;
        }else{
        	return FALSE;
        }
	}

}