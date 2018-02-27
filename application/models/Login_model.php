<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getPasswordHashFromParticipante($email){
		$this->db->where('email', $email);
   		$usuario = $this->db->get('participante')->row();
   		return ($usuario!= NULL) ? $usuario->senha : false;
	}

	public function getPasswordHashFromAdministrador($email){
		$this->db->where('email', $email);
   		$usuario = $this->db->get('administrador')->row();
   		return ($usuario!= NULL) ? $usuario->senha : false;
	}

	public function getParticipante($email){
		$this->db->where('email', $email);
		$this->db->select('id, nome, email, celular, telefone, endereco, numero, bairro, complemento, cidade, estado, cep, submeter_trabalho, foto_comprovante, id_tipo_inscricao, status_inscricao, data_registro, data_resposta');
   		$usuario = $this->db->get('participante')->row();
   		return $usuario;
	}

	public function getAdministrador($email){
		$this->db->where('email', $email);
		$this->db->select('id, nome, email, data_registro');
   		$usuario = $this->db->get('administrador')->row();
   		return $usuario;
	}

	public function verificaEmailECpf($email, $cpf){
		$this->db->where('email', $email);
		$this->db->where('cpf', $cpf);
		return $this->db->get('participante')->row();
	}

	public function atualizaSenha($id, $senha){
		$this->db->where('id', $id);
		$usuario['senha'] = $senha;
		$this->db->update('participante', $usuario);
	}

}