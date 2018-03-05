<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index($dados = NULL){

		$this->load->view('html_header');
		$this->load->view('index',$dados);
		$this->load->view('html_footer');
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
 		$tipo_inscricao = $this->input->post('tipo');

 		if($this->modelParticipante->email_exists($email)){
 			$this->session->set_flashdata('emailCadastrado', TRUE);
 			redirect(base_url());
 		}
 		if($this->modelParticipante->cpf_exists($cpf)){
 			$this->session->set_flashdata('cpfCadastrado', TRUE);
 			redirect(base_url());
 		}


 		if ($this->form_validation->run() == FALSE){
 			print_r($this->input->post());
 			print_r($this->form_validation->error_array());
 			exit();
 			redirect(base_url());
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
	 				redirect(base_url());
	 			}

	 		}else{
	 			$this->session->set_flashdata('senhasDiferentes', TRUE);
	 			redirect(base_url());
	 		}
 		}
	}

	public function voltar_cadastro(){
		
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
 					redirect(base_url());
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
 					redirect(base_url());
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
		$this->form_validation->set_rules('curso','curso','required');
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

 		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

 		if($id_participante != NULL){
 			$data['instituicao'] = $this->input->post('instituicao');
 			$data['cidade_instituicao'] = $this->input->post('cidade_instituicao');
 			$data['estado_instituicao'] = $this->input->post('uf');
 			$data['curso'] = $this->input->post('curso');
 			$data['departamento'] = $this->input->post('departamento');
 			$data['atua_na_pos_graduacao'] = $this->input->post('atua_na_pos_graduacao');
 			$data['id_participante'] = $id_participante; 

 			if ($this->form_validation->run() != FALSE){
 				if($this->modelProfessorUni->insert($data)){
 					$this->minicursos($id_participante); 
 				}else{
 					redirect(base_url());
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
 					redirect(base_url());
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

 		$id_participante = $this->modelParticipante->cadastraParticipante($dados);

 		if($id_participante != NULL){
 			$data['area_de_atuacao'] = $this->input->post('area_de_atuacao');
 			$data['id_participante'] = $id_participante;

 			if ($this->form_validation->run() != FALSE){
 				if($this->modelProfissionais->insert($data)){
 					$this->minicursos($id_participante); 
 				}else{
 					redirect(base_url());
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

		$this->load->model('Participante_model','modelParticipante');
		$this->load->model('Minicursos_model','modelMinicursos'); 

		$dados['minicursos'] = $this->modelMinicursos->listar_minicursos();
		$dados['id_participante'] = $id_participante;

		$this->load->view('html_header');
		$this->load->view('interesse_minicursos',$dados);
		$this->load->view('html_footer');
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


 
    public function enviarEmail($idParticipante){

    	$this->load->model('Participante_model','modelParticipante');

        $usuario = $this->modelParticipante->get($idParticipante);

        $subject = 'Confirme seu e-mail!';
        
        $message = 'Clique no e-mail link abaixo para confirmar o seu cadastro no Congresso: Pedagogia Histórico-Crítica! \n  <a'.base_url().'/Home/confirmaEmail/'.$usuario->email.'">Clique Aqui para confirmar seu e-mail</a>  ';

        $email = $usuario->email;

        $config = Array(
                  'protocol' => 'mail',
                  'smtp_host' => 'ssl://smtp.googlemail.com',
                  'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1',
                    'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->from(EMAIL, NOME);//your mail address and name
        $this->email->set_newline('\r\n');
        $this->email->crlf('\r\n');

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


    public function confirmaEmail($emailMD){

    	$this->load->model('Confirma_Email_model','modelConfirmaEmail');

    	if($this->modelConfirmaEmail->ativaParticipante($email)){
    		echo ("email confirmado com sucesso!");
    	}else{
    		echo ("erro ao confirmar o e-mail");
    	}


    }
}
