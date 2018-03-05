<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Confirma_Email_model extends CI_Model{ 

	public function ativaParticipante($email){
		$this->db->set('ativo', '1');
		$this->db->where('email',$email );
		$this->db->update('participante')
   		return $usuario;
	}




} 