<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Confirma_Email_model extends CI_Model{ 

	public function ativaParticipante($key_ativar){
		$this->db->set('ativo', '1');
		$this->db->where('key_ativar',$key_ativar );
		return $this->db->update('participante');

	}




} 