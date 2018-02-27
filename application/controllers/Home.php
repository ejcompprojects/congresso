<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index(){
		$this->load->view('html_header');
		$this->load->view('index');
		$this->load->view('html_footer');
	}

	public function cadastrar(){

		//tirar duvidas de quais são os required pra fazer validação dos dados

		$dados['nome'] = $this->input->post('nome');
 		$dados['email'] = $this->input->post('email');
 		$dados['celular'] = $this->input->post('celular');
 		$dados['telefone'] = $this->input->post('telefone');

 		$senha = $this->input->post('senha');
 		$confirmacaoSenha = $this->input->post('confirma-senha');

 		$dados['celular'] = $this->input->post('celular');
 		$dados['telefone'] = $this->input->post('telefone');
 		$dados['numero'] = $this->input->post('numero');
 		$dados['cidade'] = $this->input->post('cidade');
 		$dados['cep'] = $this->input->post('cep');
 		$dados['estado'] = $this->input->post('estado');
 		$dados['id_tipo_inscricao'] = $this->input->post('tipo');

 		if (strcmp($senha,$confirmacaoSenha) == 0){
 			$dados['senha'] = $this->crypt($senha);
 		}else{
 			$this->index(); // tratar senhas diferentes;
 		}

 		if ($this->form_validation->run() == FALSE){
			$this->index();// tratar caso de erro no form!
		}else{
			if($this->db->insert('institucional',$dados)){
				$this->session->set_flashdata('sucesso', TRUE);
			}else{
				$this->session->set_flashdata('errorInserir',TRUE);
			}
		}
		$this->cadastrar($dados);


	}


	// public function crypt ($senha){
 // 		$senhaCrypt = md5($senha);
 // 		return $senhaCrypt; 
 // 	}

 	private function crypt ($password){
        $options = ['cost' => 12];
        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        return $password; 
    }
}
