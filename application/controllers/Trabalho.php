<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Admin.php');


class Trabalho extends Admin {
	public function __construct(){
		parent::__construct();
		$this->load->helper('frontend_helper'); 
		$this->load->helper('modalform_helper'); 
		$this->load->model('Trabalho_model', 'trabalho_model');
		$this->load->model('Log_model', 'log_model');

	}

	public function get_pareceristas($id_eixo){
		$this->db->where('parecerista_eixo.id_eixo', $id_eixo);
		$this->db->join('parecerista_eixo', 'parecerista.id = parecerista_eixo.id_parecerista', 'INNER');
		$this->db->select('nome as label, id as value');
		$pareceristas = $this->db->get('parecerista')->result();

		echo json_encode($pareceristas);
	}

	public function listar_todos(){


		$table_header = array(
			
			array('icon' => 'fa fa-user', 'label' => 'Nome'),
			array('icon' => 'fa fa-book', 'label' => 'Título Trabalho'),
			array('icon' => 'fa fa-user', 'label' => 'Eixo'),
			array('icon' => 'fa fa-user', 'label' => 'Tipo usuário'),
			array('icon' => 'fa fa-user', 'label' => 'Status'),
			array('icon' => 'fa fa-user', 'label' => 'Data de Submissão')

		);

		$table_body = array('nome', 'titulo', 'eixo', 'tipo', 'status', 'data');


		$data_input_modal = array(
			//array('name' => 'justificativa', 'label' 	=> 'Justificativa', 'type' => 'input_text'),
			array('name' => 'id_eixo', 'label' => '', 'type' => 'hidden'),
			array('name' => 'id', 'label' => 'ID', 'type' => 'input_text'),
			array('name' => 'nome', 'label' 	=> 'Nome','type' 	=> 'input_text'),
			array('name' => 'email', 'label' 	=> 'E-mail', 'type' => 'input_text'),
			array('name' => 'tipo', 'label' 	=> 'Tipo', 'type' => 'input_text'),
			array('name' => 'titulo', 'label' 	=> 'Titulo', 'type' => 'input_text'),
			array('name' => 'eixo', 'label' 	=> 'Eixo', 'type' => 'input_text'),
			array('name' => 'data', 'label' 	=> 'Data', 'type' => 'input_text'),
			array('name' => 'arquivo_sem_nome_autor', 'label' 	=> 'Arquivo Sem Nome Autor', 'type' => 'input_file'),
			array('name' => 'arquivo_com_nome_autor', 'label' 	=> 'Arquivo Com Nome Autor', 'type' => 'input_file'),
			array('name' => 'status', 'label' 	=> 'Status', 'type' => 'input_text')
			

		);

		

		$objects = $this->trabalho_model->get_all();


		//converter a data para PT-BR
		for($i = 0 ; $i < count($objects); $i++){
			$objects[$i]['data'] = date('d/m/Y H:i:s', strtotime($objects[$i]['data']));
			switch($objects[$i]['status']){
				case 0: $objects[$i]['status'] = 'Em Análise'; break;
				case 1: $objects[$i]['status'] = 'Aprovado'; break;
				case 2: $objects[$i]['status'] = 'Reprovado'; break;
				case 3: $objects[$i]['status'] = 'Encaminhado para Parecerista'; break;

			}
			//$objects[$i]['pareceristas'] = $this->get_pareceristas($objects[$i]['id_eixo']);
		}
		// print_r($objects); exit();

		$dados['table_header'] 		= $table_header;
		$dados['table_body']	 	= $table_body;
		$dados['objects'] 			= $objects;
		$dados['data_input_modal']  = $data_input_modal;


		$dados['funcao'] 			= 'listar_todos';
		$dados['titulo'] 			= 'TODOS os Trabalhos';

		$dados['quantidade'] 		= $this->trabalho_model->num_rows();
		$dados['mensagens'] 		= mensagens();
		//$dados['url'] = array('aprovar' => base_url('Trabalho/enviar_para_parecerista/'));
		$dados['url'] = array();
		$this->load->view('html-header-admin');
		$this->load->view('header-admin');
		$this->load->view('listar-trabalhos', $dados);
		$this->load->view('footer-admin');
	}

	public function listar_para_validacao(){
		$status = 0; //0 é status EM ANÁLISE


		$table_header = array(
			
			array('icon' => 'fa fa-user', 'label' => 'Nome'),
			array('icon' => 'fa fa-user', 'label' => 'Eixo'),
			array('icon' => 'fa fa-user', 'label' => 'Data de Submissão')

		);

		$table_body = array('nome', 'eixo', 'data');


		$data_input_modal = array(
			//array('name' => 'justificativa', 'label' 	=> 'Justificativa', 'type' => 'input_text'),
			array('name' => 'id_eixo', 'label' => '', 'type' => 'hidden'),
			array('name' => 'id', 'label' => 'ID', 'type' => 'input_text'),
			array('name' => 'nome', 'label' 	=> 'Nome','type' 	=> 'input_text'),
			array('name' => 'email', 'label' 	=> 'E-mail', 'type' => 'input_text'),
			array('name' => 'tipo', 'label' 	=> 'Tipo', 'type' => 'input_text'),
			array('name' => 'titulo', 'label' 	=> 'Titulo', 'type' => 'input_text'),
			array('name' => 'eixo', 'label' 	=> 'Eixo', 'type' => 'input_text'),
			array('name' => 'data', 'label' 	=> 'Data', 'type' => 'input_text'),
			array('name' => 'arquivo_sem_nome_autor', 'label' 	=> 'Arquivo Sem Nome Autor', 'type' => 'input_file'),
			array('name' => 'arquivo_com_nome_autor', 'label' 	=> 'Arquivo Com Nome Autor', 'type' => 'input_file'),
			array('name' => 'reenviar_trabalho_com_autor', 'label' 	=> '', 'type' => 'special_button'),
			array('name' => 'reenviar_trabalho_sem_autor', 'label' 	=> '', 'type' => 'special_button'),
			array('name' => 'reenviar_ambos_trabalhos', 'label' 	=> '', 'type' => 'special_button'),
			array('name' => 'aceitar_trabalhos', 'label' 	=> '', 'type' => 'special_button'),
			array('name' => 'mensagem', 'label' 	=> '', 'type' => 'textarea')

		);

		

		$objects = $this->trabalho_model->get_all_where_status($status);


		//converter a data para PT-BR
		for($i = 0 ; $i < count($objects); $i++){
			$objects[$i]['data'] = date('d/m/Y H:i:s', strtotime($objects[$i]['data']));
			//$objects[$i]['pareceristas'] = $this->get_pareceristas($objects[$i]['id_eixo']);
		}
		// print_r($objects); exit();

		$dados['table_header'] 		= $table_header;
		$dados['table_body']	 	= $table_body;
		$dados['objects'] 			= $objects;
		$dados['data_input_modal']  = $data_input_modal;


		$dados['funcao'] 			= 'listar_para_validacao';
		$dados['titulo'] 			= 'Trabalhos Para Validação';

		$dados['quantidade'] 		= $this->trabalho_model->num_rows_where_status($status);
		$dados['mensagens'] 		= mensagens();
		$dados['url'] = array('aprovar' => base_url('Trabalho/validar/'), 'reprovar' => base_url('Trabalho/enviar_email_participante/'));

		$this->load->view('html-header-admin');
		$this->load->view('header-admin');
		$this->load->view('listar-trabalhos-para-validacao', $dados);
		$this->load->view('footer-admin');
	}

	public function listar_validados(){
		$status = 1; //1 é status VÁLIDO


		$table_header = array(
			
			array('icon' => 'fa fa-user', 'label' => 'Nome'),
			array('icon' => 'fa fa-book', 'label' => 'Título Trabalho'),
			array('icon' => 'fa fa-user', 'label' => 'Eixo'),
			array('icon' => 'fa fa-user', 'label' => 'Tipo usuário'),
			array('icon' => 'fa fa-user', 'label' => 'Data de Submissão')

		);

		$table_body = array('nome', 'titulo', 'eixo', 'tipo', 'data');


		$data_input_modal = array(
			//array('name' => 'justificativa', 'label' 	=> 'Justificativa', 'type' => 'input_text'),
			array('name' => 'id_eixo', 'label' => '', 'type' => 'hidden'),
			array('name' => 'id', 'label' => 'ID', 'type' => 'input_text'),
			array('name' => 'nome', 'label' 	=> 'Nome','type' 	=> 'input_text'),
			array('name' => 'email', 'label' 	=> 'E-mail', 'type' => 'input_text'),
			array('name' => 'tipo', 'label' 	=> 'Tipo', 'type' => 'input_text'),
			array('name' => 'titulo', 'label' 	=> 'Titulo', 'type' => 'input_text'),
			array('name' => 'eixo', 'label' 	=> 'Eixo', 'type' => 'input_text'),
			array('name' => 'data', 'label' 	=> 'Data', 'type' => 'input_text'),
			array('name' => 'arquivo_sem_nome_autor', 'label' 	=> 'Arquivo Sem Nome Autor', 'type' => 'input_file'),
			array('name' => 'arquivo_com_nome_autor', 'label' 	=> 'Arquivo Com Nome Autor', 'type' => 'input_file'),
			array('name' => 'pareceristas', 'label' => 'Selecione o parecerista', 'type' => 'special_select', 'url' => ''.base_url('Trabalho/get_pareceristas/'), 'id' => 'id_eixo')
			

		);

		

		$objects = $this->trabalho_model->get_all_where_status($status);


		//converter a data para PT-BR
		for($i = 0 ; $i < count($objects); $i++){
			$objects[$i]['data'] = date('d/m/Y H:i:s', strtotime($objects[$i]['data']));
			//$objects[$i]['pareceristas'] = $this->get_pareceristas($objects[$i]['id_eixo']);
		}
		// print_r($objects); exit();

		$dados['table_header'] 		= $table_header;
		$dados['table_body']	 	= $table_body;
		$dados['objects'] 			= $objects;
		$dados['data_input_modal']  = $data_input_modal;


		$dados['funcao'] 			= 'listar_validados';
		$dados['titulo'] 			= 'Trabalhos Validados';

		$dados['quantidade'] 		= $this->trabalho_model->num_rows_where_status($status);
		$dados['mensagens'] 		= mensagens();
		$dados['url'] = array('aprovar' => base_url('Trabalho/enviar_para_parecerista/'));

		$this->load->view('html-header-admin');
		$this->load->view('header-admin');
		$this->load->view('listar-trabalhos', $dados);
		$this->load->view('footer-admin');
	}



	public function listar_invalidos(){
		$status = 2; //1 é status VÁLIDO


		$table_header = array(
			
			array('icon' => 'fa fa-user', 'label' => 'Nome'),
			array('icon' => 'fa fa-book', 'label' => 'Título Trabalho'),
			array('icon' => 'fa fa-user', 'label' => 'Eixo'),
			array('icon' => 'fa fa-user', 'label' => 'Tipo usuário'),
			array('icon' => 'fa fa-user', 'label' => 'Data de Submissão')

		);

		$table_body = array('nome', 'titulo', 'eixo', 'tipo', 'data');


		$data_input_modal = array(
			//array('name' => 'justificativa', 'label' 	=> 'Justificativa', 'type' => 'input_text'),
			array('name' => 'id_eixo', 'label' => '', 'type' => 'hidden'),
			array('name' => 'id', 'label' => 'ID', 'type' => 'input_text'),
			array('name' => 'nome', 'label' 	=> 'Nome','type' 	=> 'input_text'),
			array('name' => 'email', 'label' 	=> 'E-mail', 'type' => 'input_text'),
			array('name' => 'tipo', 'label' 	=> 'Tipo', 'type' => 'input_text'),
			array('name' => 'titulo', 'label' 	=> 'Titulo', 'type' => 'input_text'),
			array('name' => 'eixo', 'label' 	=> 'Eixo', 'type' => 'input_text'),
			array('name' => 'data', 'label' 	=> 'Data', 'type' => 'input_text'),
			array('name' => 'arquivo_sem_nome_autor', 'label' 	=> 'Arquivo Sem Nome Autor', 'type' => 'input_file'),
			array('name' => 'arquivo_com_nome_autor', 'label' 	=> 'Arquivo Com Nome Autor', 'type' => 'input_file'),
			
			

		);

		

		$objects = $this->trabalho_model->get_all_where_status($status);


		//converter a data para PT-BR
		for($i = 0 ; $i < count($objects); $i++){
			$objects[$i]['data'] = date('d/m/Y H:i:s', strtotime($objects[$i]['data']));
			
		}


		$dados['table_header'] 		= $table_header;
		$dados['table_body']	 	= $table_body;
		$dados['objects'] 			= $objects;
		$dados['data_input_modal']  = $data_input_modal;


		$dados['funcao'] 			= 'listar_invalidados';
		$dados['titulo'] 			= 'Trabalhos Inválidos - Clique em "Aceitar" para que o trabalho seja Válido.';

		$dados['quantidade'] 		= $this->trabalho_model->num_rows_where_status($status);
		$dados['mensagens'] 		= mensagens();
		$dados['url'] = array('aprovar' => base_url('Trabalho/aprovar_trabalho_invalido/'));

		$this->load->view('html-header-admin');
		$this->load->view('header-admin');
		$this->load->view('listar-trabalhos', $dados);
		$this->load->view('footer-admin');
	}

	public function aprovar_trabalho_invalido($id_trabalho){
		$this->db->where('id_participante', $id_trabalho);
		$dados['status'] = 1;
		$this->db->update('trabalho', $dados);

		$this->db->where('id_participante', $id_trabalho);
		$trabalho = $this->db->get('trabalho')->row();
		

		$this->session->set_flashdata('success', 'O trabalho <b>"'.$trabalho->titulo.'"</b> foi alterado para <b>VÁLIDO</b>.');

		redirect('Trabalho/listar_invalidos');

	}

	public function validar($id_participante){
		$this->db->where('id_participante', $id_participante);
		$dados['status'] = 1;
		$this->db->update('trabalho', $dados);

		$this->db->where('id_participante', $id_participante);
		$trabalho = $this->db->get('trabalho')->row();
		

		$this->session->set_flashdata('success', 'O trabalho <b>"'.$trabalho->titulo.'"</b> foi validado com sucesso!');

		redirect('Trabalho/listar_para_validacao');

	}

	public function enviar_para_parecerista($id_participante){
		
		if($this->input->post('pareceristas') != ''){

			$update['status'] = 3;
			$this->db->where('id_participante', $id_participante);
			$this->db->update('trabalho', $update);

			$dados['id_trabalho'] = $id_participante;
			$dados['id_parecerista'] = $this->input->post('pareceristas');

			$this->db->insert('trabalho_parecerista', $dados);

			$this->db->where('id_participante', $id_participante);
			$this->db->select('titulo');
			$trabalho = $this->db->get('trabalho')->row();

			$this->db->where('id',$this->input->post('pareceristas'));
			$parecerista = $this->db->get('parecerista')->row();
			$this->session->set_flashdata('success', 'Trabalho '.$trabalho->nome.' adicionado ao parecerista '.$parecerista->nome.'.');
		}else{
			$this->session->set_flashdata('danger', 'Selecione um parecerista.');

		}
		redirect('Trabalho/listar_validados');
	}

	public function enviar_email_participante()
	{
		$id_participante = $this->input->post('id');
		$trabalho = $this->input->post('trabalhos');
		if($trabalho == "reenviar_trabalho_com_autor")
		{
			$status = 5;
		}	
		else if($trabalho == "reenviar_trabalho_sem_autor")
		{
			$status = 4;
		}
		else if($trabalho == "reenviar_ambos_trabalhos")
		{
			$status = 6;
		}

		$this->trabalho_model->reenviar_trabalhos($id_participante, $status);
		$titulo = "Trabalho reprovado";
		$mensagem = "<h2>Olá Congressista! <br> Seu trabalho foi reprovado por um administrador. </h2> <br> Mensagem: <br>";
		$mensagem .= $this->input->post('mensagem');
		$mensagem .= "<h3> Atenção! Você tem até 3 dias para reenviar seu trabalho!";
		$email = $this->input->post('email');
		$resposta = $this->send_email_with_title($titulo, $mensagem, $email);
		if($resposta){
            $this->log_model->insert('Foi enviado o e-mail de reenvio de trabalho para o participante.', $id_participante);
    		$this->session->set_flashdata('success', 'Email enviado com sucesso!');  
    	}
    	else{
        $this->log_model->insert('Houve um erro no envio do e-mail para o participante.', $id_participante);
    		$this->session->set_flashdata('danger', htmlspecialchars($resposta));  

    	}
	}
}


?>