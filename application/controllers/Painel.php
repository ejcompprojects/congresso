<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Login.php');

/**
 * Classe responsável por gerenciar as ações de um administrador
 */
class Painel extends Login {
	public function __construct(){
		parent::__construct();
		$this->load->helper('frontend_helper'); 
		$this->load->model('Log_model', 'log_model');
		$this->load->model('Painel_model', 'painel_model');

	}

    /**
     * Função que retorna o HTML padrão do controller
     */
    public function index(){

    	$id = $this->session->userdata('usuario')->id;
        //$vai_submeter_trabalho = $this->session->userdata('usuario')->submeter_trabalho;

        //$foto_comprovante = $this->session->userdata('usuario')->foto_comprovante;
    	$usuario = $this->painel_model->get($id);
    	$status_inscricao = $usuario->status_inscricao;
    	$foto_comprovante = $usuario->foto_comprovante;

    	$vai_submeter_trabalho = $usuario->submeter_trabalho;

    	$info = array();
        // $success = array();
        // $danger = array();
        // $warning = array(); 

        $ponto = 0; //para poder marcar o avanço do participante
        $estagio = 2; //qual nível ele está.

        if($foto_comprovante == ''){//porque ainda não enviou o comprovante
        	$info[] = 'Você não anexou a foto de seu comprovante de pagamento!';
        	$estagio =  2;
        }
        else{

           // $status_inscricao = $this->session->userdata('usuario')->status_inscricao;

        	switch($status_inscricao){
        		case 0: $info[] = 'Seu pagamento está em análise.'; $ponto += 20; $estagio = 3; break;
        		case 1: $info[] = 'Seu pagamento foi <strong>aprovado!</strong>'; $ponto += 30; if(!$vai_submeter_trabalho) $estagio =7; else $estagio = 4; break;
        		case 2: $info[] = 'Seu comprovante foi reprovado por nossa equipe, por favor, envie um novo comprovante <a href="'.base_url('Painel/enviar_arquivos').'">clicando aqui</a>.'; break;
        		case 3: $info[] = 'Você está <strong>isento</strong> do pagamento deste evento.'; $ponto +=30; if(!$vai_submeter_trabalho) $estagio =7; else $estagio = 4; break;
        	}
        }

        if($vai_submeter_trabalho){ 
        	if($this->painel_model->possui_trabalho_anexado($id)){
        		$status_trabalho = $this->painel_model->status_trabalho($id);
        		switch($status_trabalho){
        			case 0: $info[] = 'Seu trabalho está na fase de <strong>validação</strong>.<br> Fique atento em seu e-mail e no sistema, pois o prazo para correção do trabalho é de 3 dias úteis após o recebimento do aviso.'; $ponto += 20; if($estagio == 3) $estagio = 4; break;
        			case 1: $info[] = 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'; $ponto += 30; if($estagio == 4) $estagio = 7; break;
        			case 2: $info[] = 'Infelimente seu trabalho <strong>não</strong> foi aprovado, mas você poderá ainda participar do Congresso.'; $ponto += 30; if($estagio == 4) $estagio = 7;   break;
        		}
        	}else{
        		// $ultimo_dia_mes = $this->ultimo_dia(date('m'));
        		// $nome_do_mes = $this->nome_do_mes(date('m'));
        		$info[] = 'O <span style="font-size:14pt;"><strong>PRAZO</strong></span> para envio do seu artigo é até <span style="font-size:14pt;"><strong>dia 30 de ABRIL!</strong></span>'; 
        		if($estagio != 2) $estagio = 4;


        	}
        }
        else{ //se ele n vai submeter trabalho
            if($status_inscricao == 1) $ponto+= 30; //se a inscrição tá paga, tá tudo certo.
        }


        //calculo de porcentagem:

        $porcentagem = $ponto + 40;
        if($porcentagem != 100){
        	$data['completo'] = false;
        }
        else{
        	$data['completo'] = true;
        }
        $data['info'] = $info;
        // $data['success'] = $success;
        // $data['danger'] = $danger;
        // $data['warning'] = $warning;
        $data['porcentagem'] = $porcentagem;
        $data['estagio'] = $estagio;
        $data['vai_submeter_trabalho'] = $vai_submeter_trabalho;


        //relacionado ao VALOR que deverá ser pago:
        $valor = $this->calcula_valor(date('m'), $this->session->userdata('usuario')->id_tipo_inscricao);
        
        $data['valor'] = $valor;


        // $data['nao_cumpriu_prazo'] = false;

        // if(date('m') > date('m', strtotime($this->session->userdata('usuario')->data_registro))){ //se tiver virado 1 mês desde a inscrição:
        //     if($vai_submeter_trabalho == 1){ //se vai submeter trabalho
        //         if(!$this->submeteu_trabalho()){ //E NÃO submeteu trabalho
        //         	$data['nao_cumpriu_prazo'] = true;
        //         }
        //     }
        // }


        $data['mensagens'] = mensagens();

      // if($data['nao_cumpriu_prazo'] == true){ //se não cumpriu prazo, vou carregar a view de não-cumpriu-prazo.
      // 	$this->load->view('painel/html_header');
      // 	$this->load->view('painel/header');
      // 	$this->load->view('painel/nao-cumpriu-prazo', $data);
      // 	$this->load->view('painel/footer');
      // }else{

      // }

      	$this->load->view('painel/html_header');
      	$this->load->view('painel/header');
      	$this->load->view('painel/widgets', $data);
      	$this->load->view('painel/footer');

  }

  public function alterar_para_sem_submissao_de_trabalho(){
  	$id = $this->session->userdata('usuario')->id;

  	$this->db->where('id', $id);
  	$dados['submeter_trabalho'] = 0;
  	$this->db->update('participante', $dados);

  	$this->session->set_flashdata('success', '<strong>Seu cadastro foi alterado para "SEM SUBMISSÃO DE TRABALHO" com sucesso!</strong>');
  	redirect('Painel');
  }

  public function submeteu_trabalho(){
  	$id = $this->session->userdata('usuario')->id;
  	$this->db->where('id_participante', $id);
  	$quantidade = $this->db->get('trabalho')->num_rows();
  	if($quantidade == 0) return false;
  	else if($quantidade == 1) return true;
  }

// public function nome_do_mes($mes){
//     switch($mes){
//         case 2: return 'Fevereiro'; break;
//         case 3: return 'Março'; break;
//         case 4: return 'Abril'; break;
//         case 5: return 'Maio'; break;
//         case 6: return 'Junho'; break;
//         case 7: return 'Julho'; break;
//     }
// }

// public function ultimo_dia($mes){
//     switch($mes){
//         case 2: return 28; break;
//         case 3: return 31; break;
//         case 4: return 30; break;
//         case 5: return 31; break;
//         case 6: return 30; break;
//         case 7: return 31; break;
//     }
// }

  public function calcula_valor($mes, $tipo_inscricao){
  	switch($tipo_inscricao){
            case 1: //graduando
            switch($mes){
            	case 2: return 20; break;
            	case 3: return 25; break;
            	case 4: return 35; break;
            	case 5: return 35; break;
            	case 6:	return 35; break;

            }
            break; 
            case 2: //pos graduação
            case 4: //professor de ensino publico
            switch($mes){
            	case 2: return 35; break;
            	case 3: return 40; break;
            	case 4: return 55; break;
            	case 5: return 60; break;
            	case 6: return 60; break;
            }
            break;

            case 3: //professor universitário
            case 5: //demais profissionais
            switch($mes){
            	case 2: return 80; break;
            	case 3: return 90; break;
            	case 4: return 110; break;
            	case 5: return 120; break;
            	case 6: return 120; break;
            } 
            break;
            
       
            

        }
    }

    public function send_doubt(){
        //enviar dúvida
    	$email = $this->session->userdata('usuario')->email;
    	$nome = $this->session->userdata('usuario')->nome;
    	$id = $this->session->userdata('usuario')->id;
    	$mensagem = '';
    	$mensagem.= '<h2>O Participante '.$nome.' te enviou uma mensagem através do Painel do Participante:</h2>';
    	$mensagem.='<strong>Participante:</strong> '.$nome;
    	$mensagem.="<br><strong>E-mail:</strong> ".$email;
    	$mensagem.= '<br><br>';
    	$mensagem.='<strong>Mensagem:</strong><br>';
    	$mensagem.= nl2br($this->input->post('message'));
    	if($this->send_email_to_admin($mensagem)){
    		$this->log_model->insert('O participante enviou uma dúvida.', $id);
    		$this->session->set_flashdata('success', 'Dúvida enviada com sucesso!<br>Em breve te responderemos através de seu e-mail. Fique ligado em sua caixa de entrada.');
    	}else{
    		$this->session->set_flashdata('danger', 'Houve um erro ao enviar o e-mail.Tente enviar a dúvida para o e-mail:'.EMAIL_ADMIN);
    	}



    	redirect(base_url('Painel#duvida'));
    }

 // public function nao_cumpriu_prazo_enviar_arquivos(){
 //    $id = $this->session->userdata('usuario')->id;

 //    $usuario = $this->painel_model->get($id);
 //    $vai_submeter_trabalho = $usuario->submeter_trabalho;
 //    $foto_comprovante = $usuario->foto_comprovante;
 //    if($foto_comprovante == ''){
 //        $enviou_comprovante = false;
 //    }
 //    else{
 //        $enviou_comprovante = true;

 //    $status_inscricao = $usuario->status_inscricao;
 //     switch($status_inscricao){
 //            case 0: $status_inscricao = 'Em análise'; break;
 //            case 1: $status_inscricao = 'Aprovado'; break;
 //            case 2: $status_inscricao = 'Reprovado'; break;
 //            case 3: $status_inscricao = 'Isento'; break;
 //        }


 // }

    public function enviar_arquivos(){

    	$id = $this->session->userdata('usuario')->id;
    	$vai_submeter_trabalho = $this->session->userdata('usuario')->submeter_trabalho;

    	$usuario = $this->painel_model->get($id);
    	$foto_comprovante = $usuario->foto_comprovante;
    	$status_inscricao = 0;
    	if($foto_comprovante == ''){
    		$enviou_comprovante = false;
    	}
    	else{
    		$enviou_comprovante = true;

    		$status_inscricao = $usuario->status_inscricao;
    		switch($status_inscricao){
    			case 0: $status_inscricao = 'Em análise'; break;
    			case 1: $status_inscricao = 'Aprovado'; break;
    			case 2: $status_inscricao = 'Reprovado'; break;
    			case 3: $status_inscricao = 'Isento'; break;
    		}
    	}
    	$status_trabalho = '';

    	if($vai_submeter_trabalho){ 
    		if($this->painel_model->possui_trabalho_anexado($id)){
    			$status_trabalho = $this->painel_model->status_trabalho($id);
    			switch($status_trabalho){
    				case 0: $status_trabalho = 'Seu trabalho está em <strong>análise</strong>.'; break;
    				case 1: $status_trabalho = 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'; break;
    				case 2: $status_trabalho = 'Infelimente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.'; break;
    			}
    		}else{
    			$status_trabalho = 'Você deve enviar seu artigo até fim do mês!'; 

    		}
    	}

    	$data['eixos'] = $this->painel_model->get_eixos();

    	$data['enviou_comprovante'] = $enviou_comprovante;
    	$data['status_inscricao'] = $status_inscricao;
    	$data['status_trabalho']  = $status_trabalho;
    	$data['vai_submeter_trabalho'] = $vai_submeter_trabalho;

    	$data['mensagens'] = mensagens();
    	$this->load->view('painel/html_header');
    	$this->load->view('painel/header');
    	$this->load->view('painel/enviar-arquivos', $data);
    	$this->load->view('painel/footer');
    }


    public function send_photo(){

    //verificar se já existia uma imagem lá:
    	$id = $this->session->userdata('usuario')->id;
    	$this->db->where('id', $id);
    	$participante = $this->db->get('participante')->row();
    	$foto_comprovante = $participante->foto_comprovante;

    	if($foto_comprovante != ''){
    		unlink('uploads/comprovante/'.$foto_comprovante);
    	}

    	$resposta = $this->do_upload_image('comprovante_deposito');


    	if($resposta == true){
    		$this->log_model->insert('O participante enviou o comprovante.', $id);
    		$this->session->set_flashdata('success', 'Comprovante enviado com sucesso!<br>');

    	}else{
    		$this->session->set_flashdata('danger', $resposta);
    	}

    	redirect(base_url('Painel/enviar_arquivos'));
    }

    public function send_article(){

    	$resposta1 = $this->do_upload_article('artigo_com_autor');
    	$resposta2 = $this->do_upload_article('artigo_sem_autor');


    	if($resposta1['deu_certo'] && $resposta2['deu_certo']){
    		$data['arquivo_com_nome_autor'] = $resposta1['message'];
    		$data['arquivo_sem_nome_autor'] = $resposta2['message'];
    		$data['titulo'] = $this->input->post('titulo');
    		$data['id_eixo'] = $this->input->post('eixo');
    		$data['id_participante'] = $this->session->userdata('usuario')->id;

    		$this->db->insert('trabalho', $data);
    		$cdata['id_trabalho'] = $data['id_participante'];

    		$coautores = $this->input->post('coautoresCPF');

    		foreach ($coautores as $cpf) {
        if($cpf != $this->session->userdata('usuario')->cpf){ //se o cpf do coautor for diferente do CPF do usuário:
        	$qcoaut = $this->getcouator($cpf);
        	if($qcoaut->num_rows() == 1){
        		$cdata['id_participante'] = $qcoaut->row()->id;
        		$this->db->insert('coautor', $cdata);
        	}
        }
    }

    $this->log_model->insert('O participante enviou o artigo.', $data['id_participante']);
    $this->session->set_flashdata('success', 'Artigo enviado para análise.<br>Em breve você receberá a resposta.');

}else{

	if($resposta1['deu_certo'] != true) $this->session->set_flashdata('danger', $resposta1['message']);
	if($resposta2['deu_certo'] != true) $this->session->set_flashdata('danger', $resposta2['message']);
}

redirect(base_url('Painel/enviar_arquivos'));
}

public function profile(){
	$data['mensagens'] = mensagens();
	$id = $this->session->userdata('usuario')->id;
	$this->db->where('id', $id);
	$usuario = $this->db->get('participante')->row();    

    // $this->db->where('id_participante', $id);
    // switch($usuario->id_tipo_inscricao){
    //     case 1:  $usuario = $this->db->get('aluno_graduacao')->row(); break;
    //     case 2:  $usuario = $this->db->get('aluno_pos_graduacao')->row(); break;
    //     case 3:  $usuario = $this->db->get('professor_universitario')->row(); break;
    //     case 4:  $usuario = $this->db->get('prof_ensino_publico')->row(); break;
    //     case 5:  $usuario = $this->db->get('demais_profissionais')->row(); break;
    // }



	$data['usuario'] = $usuario;
	$this->load->view('painel/html_header');
	$this->load->view('painel/header');
	$this->load->view('painel/profile', $data);
	$this->load->view('painel/footer');
}

    // public function dados_referentes_ao_tipo_de_inscricao(){
    //     $tipo_inscricao = $this->session->userdata('usuario')->id_tipo_inscricao;

    //     switch($tipo_inscricao){
    //         case 1: 
    //     }
    // }

public function alterar_meus_dados(){
	$id = $this->session->userdata('usuario')->id;
	$nome =  $this->input->post('nome');
	$celular = $this->input->post('celular');
	$telefone = $this->input->post('telefone');

	$endereco = $this->input->post('endereco');
	$bairro = $this->input->post('bairro');
	$cep = $this->input->post('cep');
	$cidade = $this->input->post('cidade');
	$estado = $this->input->post('estado');

	$dados['nome'] = $nome;
	$dados['celular'] = $celular;
	$dados['telefone'] = $telefone;

	$dados['endereco'] = $endereco;
	$dados['bairro'] = $bairro;
	$dados['cep'] = $cep;
	$dados['cidade'] = $cidade;
	$dados['estado'] = $estado;


	$senha_atual = $this->input->post('senha_atual');
	$senha_nova  = $this->input->post('senha_nova');
	$repetir_senha = $this->input->post('repetir_senha');


	$this->db->where('id', $id);
	$this->db->select('senha');
	$usuario = $this->db->get('participante')->row();
	$senha = $usuario->senha;
	if($senha_nova != '' || $senha_atual != ''){
       if(password_verify($senha_atual, $senha)){ //senhas iguais:
       	if($senha_nova == $repetir_senha){
            //devemos atualizar a senha:
       		$dados['senha'] = $this->crypt($senha_nova);
       		$this->db->where('id', $id);
       		$this->db->update('participante', $dados);
       		$this->log_model->insert('O participante alterou a senha.', $id);
       		$this->session->set_flashdata('success', 'Dados atualizados com sucesso!');

       	}else{

       		$this->session->set_flashdata('danger', 'Senha Nova e Repetir Senha estão diferentes!');
       	}
            }else{ //se for diferente
            	$this->session->set_flashdata('danger', 'Senha Atual incorreta!');

            }
        }
        else{
        	$this->log_model->insert('O participante alterou os dados.', $id);
        	$this->session->set_flashdata('success', 'Dados atualizados com sucesso!');
        	$this->db->where('id', $id);
        	$this->db->update('participante', $dados);

        }


        redirect(base_url('Painel/profile'));

    }

    public function do_upload_image($name)
    {



    	$config['upload_path']          = 'uploads/comprovante';
    	$config['allowed_types']        = 'pdf|gif|jpg|png|jpeg|bmp';
    	$config['max_size']             = 2048;
    	$config['encrypt_name']         = TRUE;


    	$this->load->library('upload');
    	$this->upload->initialize($config);
    	if ( ! $this->upload->do_upload($name))
    	{
        //$error = array('error' => $this->upload->display_errors());

    		return $this->upload->display_errors();

    	}
    	else
    	{
        //$data = array('upload_data' => $this->upload->data());
        //inserir no banco
    		$foto = $this->upload->data('file_name');
    		$id = $this->session->userdata('usuario')->id;
    		return $this->painel_model->update_image($foto, $id);

    	}
    }

    public function do_upload_article($name){

    	$upload_path = 'uploads/artigo';
    // if($name == 'artigo_sem_autor') $upload_path = 'uploads/artigo';
    // else $upload_path = 'uploads/artigo';

    	$config['upload_path']          = $upload_path;
    	$config['allowed_types']        = 'doc|docx|pdf';
    //$config['max_size']             = 8192;
    	$config['encrypt_name']         = TRUE;

    	$this->load->library('upload', $config);

    	if ( ! $this->upload->do_upload($name))
    	{
        //$error = array('error' => $this->upload->display_errors());
        // print_r($this->upload->display_errors()); exit();
    		$resposta['deu_certo'] = false;
    		$resposta['message'] = $this->upload->display_errors();

    	}
    	else
    	{   

    		$resposta['deu_certo'] = true;
    		$resposta['message'] = $this->upload->data('file_name');

    	}
    	return $resposta;
    }

    public function save($article, $name, $id){
    	$eixo = $this->input->post('eixo');
    	$titulo  = $this->input->post('titulo');

    	if($this->painel_model->existe_trabalho($id)){
    		$this->painel_model->update_trabalho($article, $name, $id, $titulo, $eixo);
    	}else{
    		$this->painel_model->insert_trabalho($article, $name, $id, $titulo, $eixo);
    	}
    }


// public function coautores($text){

// 	$this->db->like('nome', $text);
// 	$this->db->or_where('cpf', $text);
// 	$this->db->select('id, nome, cpf');
// 	$participantes = $this->db->get('participante')->result();

// 	$json = json_encode($participantes);
// 	echo $json;
// }
    public function getcouator($cpf)
    {
    	if ($cpf!="") {
    		$this->db->where('cpf', $cpf);
    		$this->db->where('status_inscricao', 1);
    		$this->db->select('id, nome');
    		return $this->db->get('participante');
    	}
    	return "";
    }
    public function coautor($cpf=""){
    	if ($cpf!="") {
    		$participante = $this->getcouator($cpf)->row();
    		echo json_encode($participante);
    	}
    }

}