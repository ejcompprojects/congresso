<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index($dados = NULL){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		//$this->load->view('novo-site/index');
		$this->load->view('novo-site/general_info');
		$this->load->view('novo-site/importacoes/footer');

	}

	public function inscricao(){
		$this->load->view('html_header');
		$this->load->view('index');
		$this->load->view('html_footer');
	}

	public function inscricao_parecerista(){
		$this->load->helper('frontend_helper');
		
		$dados['mensagens'] = mensagens();
		$dados['eixos'] 	= $this->db->get('eixo')->result_array();

		$this->load->view('html_header');
		$this->load->view('inscricao_parecerista', $dados);
		$this->load->view('html_footer');
	}


	public function historico(){		
		$this->load->view('novo-site/historico');
	}

	public function manutencao(){
		$this->load->view('novo-site/manutencao');
	}

	public function general_info(){
		$this->load->view('novo-site/general_info');
	}

	public function minicurso(){
		$this->load->view('novo-site/minicurso');
	}


	public function eixos(){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		$this->load->view('novo-site/eixos-tematicos');
		// $this->load->view('novo-site/importacoes/footer');
	}

	// public function historico(){
	// 	$this->load->view('novo-site/importacoes/header');
	// 	$this->load->view('novo-site/importacoes/menu');
	// 	$this->load->view('novo-site/index');
	// 	$this->load->view('novo-site/importacoes/footer');
	// }

		public function contato(){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		$this->load->view('novo-site/contato');
		// $this->load->view('novo-site/importacoes/footer');	
	}

	public function informacoes_gerais(){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		$this->load->view('novo-site/informacoes-gerais');
		// $this->load->view('novo-site/importacoes/footer');	
	}

	public function informacao_inscricao(){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		$this->load->view('novo-site/inscricoes');
		// $this->load->view('novo-site/importacoes/footer');
	}


	public function programacao(){
		// $this->load->view('novo-site/importacoes/header');
		// $this->load->view('novo-site/importacoes/menu');
		$this->load->view('novo-site/programacao');
		// $this->load->view('novo-site/importacoes/footer');
	}
	public function cadastrar_parecerista(){
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->model('Parecerista_model','modelParecerista');

		$dados['nome'] 				= $this->input->post('nome');
		$dados['cpf'] 				= $this->input->post('cpf');
		$dados['email'] 			= $this->input->post('email');
		$dados['senha'] 			= $this->input->post('senha');
		$dados['celular'] 			= $this->input->post('celular');
		$dados['telefone'] 			= $this->input->post('telefone');
		$dados['instituicao'] 		= $this->input->post('instituicao');
		$eixos 						= $this->input->post('eixos[]');
		$confirma_senha 			= $this->input->post('confirma-senha');

		$this->form_validation->set_rules('nome','nome','required');
		$this->form_validation->set_rules('cpf','cpf','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('senha','senha','required');
		$this->form_validation->set_rules('celular','celular','required');
		$this->form_validation->set_rules('instituicao','instituicao','required');

		$msg_success = "";
		$msg_error	 = "";

		if(count($eixos) < 1)
		{
			$msg_error.="Selecione pelo menos um eixo!<br>";
		}

		if($this->modelParecerista->cpf_exists($dados['cpf']))
		{			
			$msg_error.="Este CPF já foi cadastrado!<br>";
		}
		if(!$this->modelParecerista->validaCPF($dados['cpf']))
		{
			$msg_error.="CPF inválido ou não existe!<br>";
		}

		if($this->modelParecerista->email_exists($dados['email']))
		{
			$msg_error.="Este e-mail já foi cadastrado!<br>";
		}

		if($dados['senha'] != $confirma_senha)
		{
			$msg_error.="Senhas digitadas são diferentes!<br>";
		}
		else $dados['senha'] = $this->crypt($dados['senha']);

		if ($this->form_validation->run() == FALSE || $msg_error != ""){
			unset($dados['senha']);
			$this->session->set_flashdata('dados', $dados);
			$this->session->set_flashdata('danger', $msg_error);
			// print_r($this->input->post());
			// print_r($this->form_validation->error_array());
		}
		else
		{
			if($this->modelParecerista->cadastraParecerista($dados, $eixos)){
				$this->session->set_flashdata('success', "Cadastro realizado com sucesso!");
			}
			else $this->session->set_flashdata('danger', "Cadastro não realizado, por favor tente novamente.");
		}
		redirect(base_url('inscricao_parecerista'));
	}
	public function cadastrar(){

		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->model('Participante_model','modelParticipante');

		$this->form_validation->set_rules('nome','nome','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('senha','senha','required');
		$this->form_validation->set_rules('celular','celular','required');
		$this->form_validation->set_rules('cpf','cpf','required');
		$this->form_validation->set_rules('estado','estado','required');
		$this->form_validation->set_rules('cep','cep','required');
		$this->form_validation->set_rules('cidade','cidade','required');


		$dados['nome'] = $this->input->post('nome');
		$dados['email'] = $this->input->post('email');
		$email = $this->input->post('email');
		$dados['celular'] = $this->input->post('celular');
		$dados['telefone'] = $this->input->post('telefone');
		$dados['cpf'] = $this->input->post('cpf');
		$cpf = $this->input->post('cpf');

		$senha = $this->input->post('senha');
		$confirmacaoSenha = $this->input->post('confirma-senha');

		$dados['cep'] = $this->input->post('cep');
		$dados['cidade'] = $this->input->post('cidade');
		$dados['estado'] = $this->input->post('estado');
		$dados['endereco'] = $this->input->post('rua');
		$dados['bairro'] = $this->input->post('bairro');
		$dados['id_tipo_inscricao'] = $this->input->post('tipo');
		$dados['submeter_trabalho'] = $this->input->post('submeter_trabalho');
		$dados['deficiencia'] = $this->input->post('deficiencia');
		$dados['deficiencia_desc'] = $this->input->post('deficiencia_desc');
		$tipo_inscricao = $this->input->post('tipo');

		if($this->modelParticipante->email_exists($email)){
			$this->session->set_flashdata('emailCadastrado', TRUE);
			redirect(base_url('inscricao'));
		}
		if($this->modelParticipante->cpf_exists($cpf)){
			$this->session->set_flashdata('cpfCadastrado', TRUE);
			redirect(base_url('inscricao'));
		}


		if ($this->form_validation->run() == FALSE){
			// print_r($this->form_validation->error_array()); 
      		$this->voltar_cadastro(); 
		}else{

			if (strcmp($senha,$confirmacaoSenha) == 0){
				$dados['senha'] = $this->crypt($senha);

				switch($tipo_inscricao){

					case 1: 
					$this->load->view('html_header');
					$this->load->view('cadastro_aluno_graduacao',$dados);
					$this->load->view('html_footer');
					break; 

					case 2: 
					$this->load->view('html_header');
					$this->load->view('cadastro_aluno_pos',$dados);
					$this->load->view('html_footer');
					break;

					case 3: 
					$this->load->view('html_header');
					$this->load->view('cadastro_professor_universitario',$dados);
					$this->load->view('html_footer');
					break;		

					case 4: 
					$this->load->view('html_header');
					$this->load->view('cadastro_professor_publica',$dados);
					$this->load->view('html_footer');
					break; 	

					case 5:
					$this->load->view('html_header');
					$this->load->view('cadastro_demais_profissionais',$dados);
					$this->load->view('html_footer'); 	
					break;
					default: 
					redirect(base_url('inscricao'));
				}

			}else{
				$this->session->set_flashdata('senhasDiferentes', TRUE);
				redirect(base_url('inscricao'));
			}
		}
	}

	public function voltar_cadastro(){
		

		$dados['nome'] 					= $this->input->post('nome');
		$dados['deficiencia'] 			= $this->input->post('deficiencia');
		$dados['email'] 				= $this->input->post('email');
		$dados['celular'] 				= $this->input->post('celular');
		$dados['telefone'] 				= $this->input->post('telefone');
		$dados['senha'] 				= $this->input->post('senha');
		$dados['deficiencia_desc'] 		= $this->input->post('deficiencia_desc') ?? '';

		$dados['cidade'] 				= $this->input->post('cidade');
		$dados['cep'] 					= $this->input->post('cep');
		$dados['estado'] 				= $this->input->post('estado');
		$dados['id_tipo_inscricao'] 	= $this->input->post('id_tipo_inscricao');
		$dados['cpf'] 					= $this->input->post('cpf');
		$dados['bairro'] 				= $this->input->post('bairro');
		$dados['endereco'] 				= $this->input->post('endereco');
		$dados['submeter_trabalho'] 	= $this->input->post('submeter_trabalho');


		$this->load->view("html_header");
		$this->load->view('index',$dados);
		$this->load->view("html_footer");

	}

	public function cadastro_aluno_graduacao(){

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Aluno_Graduacao_model','modelGraduacao');
		$this->load->model('Minicursos_model','modelMinicursos');

		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');

		$this->form_validation->set_rules('instituicao','instituicao','required');
		$this->form_validation->set_rules('cidade_instituicao','cidade_instituicao','required');
		$this->form_validation->set_rules('uf','uf','required');
		$this->form_validation->set_rules('curso','curso','required');
		$this->form_validation->set_rules('semestre','semestre','required');

		$dados['nome'] 					= $this->input->post('nome');
		$dados['deficiencia'] 			= $this->input->post('deficiencia');
		$dados['email'] 				= $this->input->post('email');
		$dados['celular'] 				= $this->input->post('celular');
		$dados['telefone'] 				= $this->input->post('telefone');
		$dados['senha'] 				= $this->input->post('senha');
		$dados['deficiencia_desc'] 		= $this->input->post('deficiencia_desc') ?? '';

		$dados['cidade'] 				= $this->input->post('cidade');
		$dados['cep'] 					= $this->input->post('cep');
		$dados['estado'] 				= $this->input->post('estado');
		$dados['id_tipo_inscricao'] 	= $this->input->post('id_tipo_inscricao');
		$dados['cpf'] 					= $this->input->post('cpf');
		$dados['bairro'] 				= $this->input->post('bairro');
		$dados['endereco'] 				= $this->input->post('endereco');
		$dados['submeter_trabalho'] 	= $this->input->post('submeter_trabalho');


		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

		if($id_participante != NULL){
			$data['instituicao'] = $this->input->post('instituicao');
			$data['cidade_instituicao'] = $this->input->post('cidade_instituicao');
			$data['estado_instituicao'] = $this->input->post('uf');
			$data['curso'] = $this->input->post('curso');
			$data['semestre'] = $this->input->post('semestre');
			$data['id_participante'] = $id_participante; 

			if ($this->form_validation->run() != FALSE){
				if($this->modelGraduacao->insert($data)){
					$this->minicursos($id_participante); 
				}else{
					redirect(base_url('inscricao'));
					$this->session->set_flashdata('erroBanco', TRUE);
				}
			}else{
				$this->load->view('html_header');
				$this->load->view('cadastro_aluno_graduacao',$dados);
				$this->load->view('html_footer');
			}
		}else{
			$this->load->view('html_header');
			$this->load->view('cadastro_aluno_graduacao',$dados);
			$this->load->view('html_footer');
		}
	}

	public function cadastro_aluno_pos(){

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Aluno_Pos_model','modelPos');
		$this->load->model('Minicursos_model','modelMinicursos');

		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');

		$this->form_validation->set_rules('instituicao','instituicao','required');
		$this->form_validation->set_rules('cidade_instituicao','cidade_instituicao','required');
		$this->form_validation->set_rules('uf','uf','required');
		$this->form_validation->set_rules('curso','curso','required');
		$this->form_validation->set_rules('tematica_da_pesquisa','tematica_da_pesquisa','required');


		$dados['nome'] 					= $this->input->post('nome');
		$dados['deficiencia'] 			= $this->input->post('deficiencia');
		$dados['email'] 				= $this->input->post('email');
		$dados['celular'] 				= $this->input->post('celular');
		$dados['telefone'] 				= $this->input->post('telefone');
		$dados['senha'] 				= $this->input->post('senha');
		$dados['deficiencia_desc'] 		= $this->input->post('deficiencia_desc') ?? '';

		$dados['cidade'] 				= $this->input->post('cidade');
		$dados['cep'] 					= $this->input->post('cep');
		$dados['estado'] 				= $this->input->post('estado');
		$dados['id_tipo_inscricao'] 	= $this->input->post('id_tipo_inscricao');
		$dados['cpf'] 					= $this->input->post('cpf');
		$dados['bairro'] 				= $this->input->post('bairro');
		$dados['endereco'] 				= $this->input->post('endereco');
		$dados['submeter_trabalho'] 	= $this->input->post('submeter_trabalho');


		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

		if($id_participante != NULL){
			$data['instituicao'] = $this->input->post('instituicao');
			$data['cidade_instituicao'] = $this->input->post('cidade_instituicao');
			$data['estado_instituicao'] = $this->input->post('uf');
			$data['curso'] = $this->input->post('curso');
			$data['tematica_da_pesquisa'] = $this->input->post('tematica_da_pesquisa');
			$data['id_participante'] = $id_participante; 

			if ($this->form_validation->run() != FALSE){
				if($this->modelPos->insert($data)){
					$this->minicursos($id_participante); 
				}else{
					redirect(base_url('inscricao'));
					$this->session->set_flashdata('erroBanco', TRUE);
				}
			}else{
				$this->load->view('html_header');
				$this->load->view('cadastro_aluno_graduacao',$dados);
				$this->load->view('html_footer');
			}
		}else{
			$this->load->view('html_header');
			$this->load->view('cadastro_aluno_graduacao',$dados);
			$this->load->view('html_footer');
		}
	}

	public function cadastro_professor_universitario(){

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Professor_Universitario_model','modelProfessorUni');
		$this->load->model('Minicursos_model','modelMinicursos');

		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');

		$this->form_validation->set_rules('instituicao','instituicao','required');
		$this->form_validation->set_rules('cidade_instituicao','cidade_instituicao','required');
		$this->form_validation->set_rules('uf','uf','required');
		// $this->form_validation->set_rules('curso','curso','required');
		$this->form_validation->set_rules('departamento','departamento','required');
		$this->form_validation->set_rules('atua_na_pos_graduacao','atua_na_pos_graduacao','required');

		$dados['nome'] = $this->input->post('nome');
		$dados['email'] = $this->input->post('email');
		$dados['celular'] = $this->input->post('celular');
		$dados['telefone'] = $this->input->post('telefone');
		$dados['senha'] = $this->input->post('senha');
		$dados['cidade'] = $this->input->post('cidade');
		$dados['cep'] = $this->input->post('cep');
		$dados['estado'] = $this->input->post('estado');
		$dados['id_tipo_inscricao'] = $this->input->post('id_tipo_inscricao');
		$dados['cpf'] = $this->input->post('cpf');
		$dados['bairro'] = $this->input->post('bairro');
		$dados['endereco'] = $this->input->post('endereco');
		$dados['submeter_trabalho'] = $this->input->post('submeter_trabalho');
		$dados['deficiencia'] = $this->input->post('deficiencia');
		$dados['deficiencia_desc'] = $this->input->post('deficiencia_desc');

		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

		if($id_participante != NULL){
			$data['instituicao'] = $this->input->post('instituicao');
			$data['cidade_instituicao'] = $this->input->post('cidade_instituicao');
			$data['estado_instituicao'] = $this->input->post('uf');
			// $data['curso'] = $this->input->post('curso');
			$data['departamento'] = $this->input->post('departamento');
			$data['atua_na_pos_graduacao'] = $this->input->post('atua_na_pos_graduacao');
			$data['id_participante'] = $id_participante; 

			if ($this->form_validation->run() != FALSE){
				if($this->modelProfessorUni->insert($data)){
					$this->minicursos($id_participante); 
				}else{
					redirect(base_url('inscricao'));
					$this->session->set_flashdata('erroBanco', TRUE);
				}
			}else{
				$this->load->view('html_header');
				$this->load->view('cadastro_professor_universitario',$dados);
				$this->load->view('html_footer');
			}
		}else{
			$this->load->view('html_header');
			$this->load->view('cadastro_professor_universitario',$dados);
			$this->load->view('html_footer');
		}
	}

	public function cadastro_professor_publica(){

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Professor_Publica_model','modelProfessorPub');
		$this->load->model('Minicursos_model','modelMinicursos');

		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');

		$this->form_validation->set_rules('escola','escola','required');

		$dados['nome'] = $this->input->post('nome');
		$dados['email'] = $this->input->post('email');
		$dados['celular'] = $this->input->post('celular');
		$dados['telefone'] = $this->input->post('telefone');
		$dados['senha'] = $this->input->post('senha');
		$dados['cidade'] = $this->input->post('cidade');
		$dados['cep'] = $this->input->post('cep');
		$dados['estado'] = $this->input->post('estado');
		$dados['id_tipo_inscricao'] = $this->input->post('id_tipo_inscricao');
		$dados['cpf'] = $this->input->post('cpf');
		$dados['bairro'] = $this->input->post('bairro');
		$dados['endereco'] = $this->input->post('endereco');
		$dados['submeter_trabalho'] = $this->input->post('submeter_trabalho');
		$dados['deficiencia'] = $this->input->post('deficiencia');
		$dados['deficiencia_desc'] = $this->input->post('deficiencia_desc');

		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

		if($id_participante != NULL){
			$data['escola'] = $this->input->post('escola');
			$data['id_participante'] = $id_participante; 

			$nivel1 = $this->input->post('infantil');
			$nivel2 = $this->input->post('fundamental1');
			$nivel3 = $this->input->post('fundamental2');
			$nivel4 = $this->input->post('medio');

			if ($this->form_validation->run() != FALSE){
				if($this->modelProfessorPub->insert($data)){

					if ($nivel1 == 1){
						$nivel['id_nivel'] = $nivel1;
						$nivel['id_participante_professor'] = $id_participante;
						$this->modelProfessorPub->insertNivel($nivel);
					}if ($nivel2 == 2){
						$nivel['id_nivel'] = $nivel2;
						$nivel['id_participante_professor'] = $id_participante;
						$this->modelProfessorPub->insertNivel($nivel);
					}if ($nivel3 == 3){
						$nivel['id_nivel'] = $nivel3;
						$nivel['id_participante_professor'] = $id_participante;
						$this->modelProfessorPub->insertNivel($nivel);
					}if ($nivel4 == 4){
						$nivel['id_nivel'] = $nivel4;
						$nivel['id_participante_professor'] = $id_participante;
						$this->modelProfessorPub->insertNivel($nivel);
					}
					$this->minicursos($id_participante); 
				}else{
					redirect(base_url('inscricao'));
					$this->session->set_flashdata('erroBanco', TRUE);
				}
			}else{
				$this->load->view('html_header');
				$this->load->view('cadastro_professor_publica',$dados);
				$this->load->view('html_footer');
			}
		}else{
			$this->load->view('html_header');
			$this->load->view('cadastro_professor_publica',$dados);
			$this->load->view('html_footer');
		}
	}

	public function cadastro_demais_profissionais(){

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Demais_Profissionais_model','modelProfissionais');
		$this->load->model('Minicursos_model','modelMinicursos');

		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');

		$this->form_validation->set_rules('area_de_atuacao','area_de_atuacao','required');


		$dados['nome'] 					= $this->input->post('nome');
		$dados['deficiencia'] 			= $this->input->post('deficiencia');
		$dados['email'] 				= $this->input->post('email');
		$dados['celular'] 				= $this->input->post('celular');
		$dados['telefone'] 				= $this->input->post('telefone');
		$dados['senha'] 				= $this->input->post('senha');
		$dados['deficiencia_desc'] 		= $this->input->post('deficiencia_desc') ?? '';

		$dados['cidade'] 				= $this->input->post('cidade');
		$dados['cep'] 					= $this->input->post('cep');
		$dados['estado'] 				= $this->input->post('estado');
		$dados['id_tipo_inscricao'] 	= $this->input->post('id_tipo_inscricao');
		$dados['cpf'] 					= $this->input->post('cpf');
		$dados['bairro'] 				= $this->input->post('bairro');
		$dados['endereco'] 				= $this->input->post('endereco');
		$dados['submeter_trabalho'] 	= $this->input->post('submeter_trabalho');


		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

		if($id_participante != NULL){
			$data['area_de_atuacao'] = $this->input->post('area_de_atuacao');
			$data['id_participante'] = $id_participante;

			if ($this->form_validation->run() != FALSE){
				if($this->modelProfissionais->insert($data)){
					$this->minicursos($id_participante); 
				}else{
					redirect(base_url('inscricao'));
					$this->session->set_flashdata('erroBanco', TRUE);
				}
			}else{
				$this->load->view('html_header');
				$this->load->view('cadastro_professor_universitario',$dados);
				$this->load->view('html_footer');
			}
		}else{
			$this->load->view('html_header');
			$this->load->view('cadastro_professor_universitario',$dados);
			$this->load->view('html_footer');
		}
	}

	public function minicursos($id_participante){
		$this->load->model('Log_model', 'log_model');
		$this->log_model->insert('Participante cadastrado com sucesso.', $id_participante);
		$this->envia_email($id_participante);
		// $this->load->model('Participante_model','modelParticipante');
		// $this->load->model('Minicursos_model','modelMinicursos'); 

		// $dados['minicursos'] = $this->modelMinicursos->listar_minicursos();
		// $dados['id_participante'] = $id_participante;

		// $this->load->view('html_header');
		// $this->load->view('interesse_minicursos',$dados);
		// $this->load->view('html_footer');
	}

	public function cadastro_sucesso(){
		$this->load->view('html_header');
		$this->load->view('cadastro_sucesso');
		$this->load->view('html_footer');
	}

	public function envia_email($id_participante){
		$this->db->where('id', $id_participante);
		$usuario = $this->db->get('participante')->row();
		$key_ativar = strtotime(date("Y-m-d H:i:s"));
		$key_ativar = hash('sha512', $key_ativar);
		$key_ativar = substr($key_ativar, 0, 8);

		$dados1['key_ativar'] = $key_ativar;
		$this->db->where('id', $usuario->id);
		$this->db->update('participante', $dados1);

		if ($this->enviarEmail($id_participante)){
			$this->session->set_flashdata('cadastrado', TRUE);
			redirect('Home/cadastro_sucesso');
		}else{
			echo "erro ao enviar o e-mail";
			die;
		}

	}

	public function declarar_interesse_minicursos(){

		$this->load->model('Minicursos_model','modelMinicursos');

		$minicursosSelecionados = $this->input->post('minicursos'); 
		$id_participante = $this->input->post('id_participante');

		if($minicursosSelecionados != NULL){
			foreach ($minicursosSelecionados as $item){
				$dados['id_participante'] = $id_participante;
				$dados['id_minicurso'] = $item;
				$this->modelMinicursos->insertParticipante_interesse($dados);
			}}
			$this->db->where('id', $id_participante);
			$usuario = $this->db->get('participante')->row();
			$key_ativar = strtotime(date("Y-m-d H:i:s"));
			$key_ativar = hash('sha512', $key_ativar);
			$key_ativar = substr($key_ativar, 0, 8);

			$dados1['key_ativar'] = $key_ativar;
			$this->db->where('id', $usuario->id);
			$this->db->update('participante', $dados1);

			if ($this->enviarEmail($id_participante)){
				$this->session->set_flashdata('cadastrado', TRUE);
				$this->load->view('html_header');
				$this->load->view('cadastro_sucesso');
				$this->load->view('html_footer');
			}else{
				echo "erro ao enviar o e-mail";
				die;
			}

		}



		private function crypt ($password){
			$options = ['cost' => 12];
			$password = password_hash($password, PASSWORD_DEFAULT, $options);
			return $password; 
		}

		public function reenviarEmailAtivacao($idParticipante){
			if($this->enviarEmail($idParticipante)){
				$this->session->set_flashdata('success', 'Email de Ativação reenviado com sucesso!');
			}
			else{
				$this->session->set_flashdata('danger', 'Problema ao reenviar e-mail de ativação. Por favor, tente novamente mais tarde');

			}

			redirect('Login');
		}


		public function enviarEmail($idParticipante){

			$this->load->model('Participante_model','modelParticipante');

        //$usuario = $this->modelParticipante->get($idParticipante);
			$this->db->where('id', $idParticipante);
			$usuario = $this->db->get('participante')->row();
			$key_ativar = $usuario->key_ativar;


			$subject = 'Confirme seu e-mail';

			$message = '<h1>MUITO OBRIGADO POR SE CADASTRAR NO CONGRESSO!<h1>
			<h2>Clique no link abaixo para confirmar seu cadastro:</h2>
			<br><br>
			<p>
			Clique no  link abaixo para confirmar o seu cadastro no Congresso: Pedagogia Histórico-Crítica!<br><br>	<a href="'.base_url().'/Home/confirmaEmail/'.$key_ativar.'" target="_blank">CLIQUE AQUI PARA CONFIRMAR SEU E-MAIL.</a>  ';

			$email = $usuario->email;

			$config = Array(
				'useragent' => 'CodeIgniter',
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'smtp_timeout' => 5,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,

                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                );

			$html = '';
			$html.= '<!DOCTYPE html><html>';
			$html.= $message;
			$html.= '</html>';

			$message = $html;

			$this->load->library('email', $config);
        $this->email->from(EMAIL, 'Congresso PHC 2018');//your mail address and name
        //$this->email->set_newline('\r\n');
        //$this->email->crlf('\r\n');

        $this->email->to($email); //receiver mail
        $this->email->subject($subject);
        $this->email->message($message);
        if(!$this->email->send()){ 
        	return $this->email->print_debugger();
        }
        else{
        	return true;
        }
    }


    public function confirmaEmail($key_ativar){

    	$this->load->model('Confirma_Email_model','modelConfirmaEmail');

    	if($this->modelConfirmaEmail->ativaParticipante($key_ativar)){
    		$this->session->set_flashdata('success', 'E-mail ativo com sucesso!<br>Faça o <strong>login</strong> para continuar.');
    	}else{
    		$this->session->set_flashdata('danger', 'Houve um erro ao ativar seu e-mail, entre em contato com o pessoal da organização para saber sobre.');
    		
    	}

    	redirect('Login');
    }
}
