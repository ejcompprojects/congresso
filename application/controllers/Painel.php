<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Login.php');

/**
 * Classe responsável por gerenciar as ações de um administrador
 */
class Painel extends Login {
	const DATALIMITE = "2018-07-10 23:59";

	public function __construct(){
		parent::__construct();
        if($this->session->userdata('usuario')->tipo_usuario == 'Administrador') redirect(base_url('Admin'));
        else if($this->session->userdata('usuario')->tipo_usuario == 'Parecerista') redirect(base_url('Parecerista'));
        $this->load->helper('frontend_helper');
        $this->load->model('Log_model', 'log_model');
        $this->load->model('Painel_model', 'painel_model');
        $this->load->helper('buscarMinicurso');
        $this->load->model('Minicurso_model', 'minicurso_model');

    }

    public function get_trabalho($id_usuario){
      $this->db->where('id_participante', $id_usuario);
      return $this->db->get('trabalho')->row();
  }

  public function get_parecer($id_usuario){
      $this->db->where('id_trabalho', $id_usuario);
      return $this->db->get('trabalho_parecerista')->row();
  }


  public function retorna_etapa_que_o_usuario_se_encontra(){
      $id = $this->session->userdata('usuario')->id;

      $usuario = $this->painel_model->get($id);

      if($usuario->foto_comprovante == ''){
         $enviou_comprovante = 0;
     }else{
         $enviou_comprovante = 1;
     }

     $status_comprovante = $usuario->status_inscricao;


     $vai_submeter_trabalho = $usuario->submeter_trabalho;    


     $trabalho = $this->get_trabalho($id);

     if(is_object($trabalho)) $enviou_trabalho = 1;
     else $enviou_trabalho = 0;

     $parecer = $this->get_parecer($id);

     if(is_object($parecer)) $tem_parecer = 1;
     else $tem_parecer = 0;

     $array = array();
     $array['vai_submeter_trabalho'] = $vai_submeter_trabalho;
     $array['mensagens'] = array();


    if( !$enviou_comprovante && $status_comprovante != 3){ //todo mundo tem que enviar o comprovante, se não enviou:

        //Informações relevantes para a página inicial:
    	$array['fase'] = 'ENVIAR_COMPROVANTE';
    	$array['etapa'] = 2;
    	$array['porcentagem'] = 40;

        //Informações relevantes para a página de enviar arquivos:
    	$array['div_enviar_comprovante'] = TRUE;
    	$array['div_status_comprovante'] = FALSE;
    	$array['div_enviar_trabalho'] = FALSE;
    	$array['div_alerta_trabalho'] = TRUE;
    	$array['div_status_trabalho'] = FALSE;


    	array_push($array['mensagens'], 'Você não anexou a foto de seu comprovante de pagamento!');

    }
    else{ // se enviou

    	$array['div_enviar_comprovante'] = FALSE;
    	$array['div_status_comprovante'] = TRUE;
    	$array['div_alerta_trabalho'] = TRUE;



    	$array['fase'] = 'COMPROVANTE_ENVIADO';
    	$array['etapa'] = 3;
    	$array['porcentagem'] = 70;

    	switch($status_comprovante){

            case 0:   //EM ANÁLISE:
            $array['status_comprovante'] = array(
            	'title' => 'Seu comprovante de pagamento está em <b>análise.</b>', 
            	'panel' => 'panel-info', 
            	'label' => 'Em Análise'
            );

            array_push($array['mensagens'], 'Seu comprovante de pagamento está em análise.');

            break;

            case 1:   //APROVADO:
            $array['status_comprovante'] = array(
            	'title' => 'Seu comprovante de depósito foi <b>aprovado!</b>',
            	'panel'   => 'panel-success',
            	'label'   => 'Aprovado'
            );
            array_push($array['mensagens'], 'Seu comprovante de pagamento foi aprovado com sucesso!');
            break;

            case 2:  //REPROVADO:

            $array['status_comprovante'] = array(
            	'title' => 'Seu comprovante de depósito foi <b>reprovado.</b>',
            	'subtitle' => '<p>Isto pode acontecer por você ter pago o valor que não corresponde à sua inscrição no respectivo mês.</p><p>O Comprovante de depósito pode não estar claro (estar embaçado).</p><br><p>Envie um novo comprovante:</p>',
            	'panel'   => 'panel-danger',
            	'label'   => 'Reprovado'
            );
            array_push($array['mensagens'], 'Seu comprovante de pagamento foi recusado. Reenvie um novo comprovante clicando em "Enviar Arquivos".');
            $array['div_enviar_comprovante'] = TRUE;
            break;


            case 3:  //ISENTO:

            $array['status_comprovante'] = array(
            	'title' => 'Você está <strong>isento</strong> do pagamento.',
            	'panel'   => 'panel-success',
            	'label'   => 'Isento'
            );
            array_push($array['mensagens'], 'Você está isento do pagamento!');
            break;

        }

    }
    
    if( $vai_submeter_trabalho ) {

                if($enviou_trabalho){ //ele pode estar na fase de VALIDAÇÃO DO TRABALHO:

                	$array['div_enviar_trabalho'] = FALSE;
                	$array['div_alerta_trabalho'] = FALSE;
                	$array['div_status_trabalho'] = TRUE;
                    //AQUI É A FASE DE VALIDAÇÃO:

                	$array['fase'] = 'VALIDAÇÃO';
                	$array['etapa'] = 5;
                	$array['porcentagem'] = 100;

                	if($trabalho->data_limite != NULL){
                		$data_atual = strtotime(date('Y-m-d'));
                		$data_limite = strtotime($trabalho->data_limite);
                		if($data_atual > $data_limite){
                			$array['etapa'] = 7;
                			$array['status_trabalho'] = array(
                				'title' => 'Você perdeu o prazo para reenvio do trabalho.<br>Você ainda poderá participar do evento mas não poderá reenviar o trabalho.', 
                				'panel' => 'panel-danger', 
                				'label' => 'Etapa de Validação'
                			);
                			array_push($array['mensagens'], 'Você perdeu o prazo para envio de seu artigo.');
                			return $array;

                		}

                	}



                    switch($trabalho->status){ //se foi VALIDADO:
                        case 0: //EM ANÁLISE:

                        $array['status_trabalho'] = array(
                        	'title' => 'Seu trabalho foi enviado com sucesso e será <strong>validado</strong> por um membro de nossa equipe.<br> Fique atento em seu e-mail e no sistema, pois o prazo para correção e reenvio do trabalho é de 3 dias úteis após o recebimento do aviso.', 
                        	'panel' => 'panel-info', 
                        	'label' => 'Etapa de Validação'
                        );
                        array_push($array['mensagens'], 'Seu trabalho está sendo validado por nossa equipe.');

                        break;

                        case 1: //APROVADO:

                        $array['status_trabalho'] = array(
                        	'title' => 'Seu trabalho foi validado e será encaminhado para um parecerista avaliar.<br>Dentro de alguns dias, enviaremos um e-mail para avisá-lo quanto ao parecer sobre seu trabalho.', 
                        	'panel' => 'panel-info', 
                        	'label' => 'Encaminhado Para Parecerista'
                        );
                        array_push($array['mensagens'], 'Seu trabalho foi validado por nossa equipe. Agora seu trabalho está sendo analisado por um parecerista.');

                        break;

                        case 2: //REPROVADO:

                        $array['status_trabalho'] = array(
                        	'title' => 'Foi encontrado erros em seu trabalho:<br>'.$trabalho->justificativa.'<br>Corrija os erros e reenvie o trabalho <b>ATÉ O DIA '.date('d/m/Y', strtotime($trabalho->data_limite)).'</b>.', 
                        	'panel' => 'panel-danger', 
                        	'label' => 'Etapa de Validação'
                        );
                        array_push($array['mensagens'], 'Entre em "Enviar Arquivos" para anexar seu trabalho.');

                        break;

                        case 3: //PARECERISTA ESTÁ ANALISANDO:
                        $array['etapa'] = 6;

                        $array['status_trabalho'] = array(
                        	'title' => 'Seu trabalho está sendo analisado por nossa equipe.', 
                        	'panel' => 'panel-info', 
                        	'label' => 'Etapa de Análise'
                        );
                        break;

                        case 4: //REENVIAR TRABALHO SEM AUTOR:

                        $array['status_trabalho'] = array(
                        	'title' => '<b>Foi encontrado erros em seu trabalho SEM autor.</b><br><br>Leia atentamente as informações sobre cada um e se atente ao que a nossa equipe escreveu sobre o que está errado em seu trabalho:<br>'.$trabalho->justificativa.'<br><br<br>Corrija os erros e reenvie o trabalho <b>ATÉ O DIA '.date('d/m/Y', strtotime($trabalho->data_limite)).'</b>.', 
                        	'panel' => 'panel-warning', 
                        	'label' => 'Etapa de Validação'
                        );
                        $array['div_reenviar_trabalho'] = 1;

                        $array['status_reenvio'] = 'SEM';

                        array_push($array['mensagens'], 'Entre em "Enviar Arquivos" para anexar seu trabalho.');

                        break;

                        case 5: //REENVIAR TRABALHO COM AUTOR:

                        $array['status_trabalho'] = array(
                        	'title' => '<b>Foi encontrado erros em seu trabalho COM autor.</b><br><br>Leia atentamente as informações sobre cada um e se atente ao que a nossa equipe escreveu sobre o que está errado em seu trabalho:<br>'.$trabalho->justificativa.'<br><br<br>Corrija os erros e reenvie o trabalho <b>ATÉ O DIA '.date('d/m/Y', strtotime($trabalho->data_limite)).'</b>.', 
                        	'panel' => 'panel-warning', 
                        	'label' => 'Etapa de Validação'
                        );
                        $array['div_reenviar_trabalho'] = 1;


                        $array['status_reenvio'] = 'COM';

                        array_push($array['mensagens'], 'Entre em "Enviar Arquivos" para anexar seu trabalho.');

                        break;

                        case 6: //REENVIAR AMBOS:

                        $array['status_trabalho'] = array(
                        	'title' => '<b>Foi encontrado erros em seu trabalho COM autor e SEM autor.<b><br><br>Leia atentamente as informações sobre cada um e se atente ao que a nossa equipe escreveu sobre o que está errado em seu trabalho:<br>'.$trabalho->justificativa.'<br><br><br>Corrija os erros e reenvie o trabalho <b>ATÉ O DIA '.date('d/m/Y', strtotime($trabalho->data_limite)).'</b>.', 
                        	'panel' => 'panel-warning', 
                        	'label' => 'Solicitado Reenvio'
                        );
                        $array['div_reenviar_trabalho'] = 1;
                        

                        $array['status_reenvio'] = 'AMBOS';

                        array_push($array['mensagens'], 'Entre em "Enviar Arquivos" para anexar seu trabalho.');

                        break;


                    }

                    if($trabalho->status == 3){ //analisado por parecerista:

                    	if($tem_parecer){
                    		$array['etapa'] = 7;


                    		$array['div_enviar_trabalho'] = FALSE;
                    		$array['div_alerta_trabalho'] = FALSE;
                    		$array['div_status_trabalho'] = TRUE;
                    		$array['div_reenviar_trabalho'] = FALSE;


                    		switch($parecer->status_parecer){
                                case 1: //APROVADO:



                                $array['status_trabalho'] = array(
                                	'title' => '<b>Parabéns!</b><br>Seu trabalho foi <b>APROVADO!</b>',
                                	'subtitle' => '<h3>Nota:'.$parecer->nota.'</h3><br><p>Ver Formulário de avaliação:</p><br> <a class="btn btn-info" href="'.base_url('uploads/parecer/'.$parecer->arquivo_parecer).'">CLIQUE AQUI PARA VER O FORMULÁRIO</a>',
                                	'panel' => 'panel-success',
                                	'label' => 'Etapa de Avaliação'
                                );
                                array_push($array['mensagens'], '<b>Parabéns!</b><br>Seu trabalho foi <b>APROVADO!</b>');


                                break;

                              case 2: //REPROVADO
                              $array['status_trabalho'] = array(
                              	'title' => 'Infelizmente, seu trabalho foi <b>reprovado</b>. Mas fique tranquilo, você ainda poderá participar do evento!',
                              	'subtitle' => '<h3>Nota:'.$parecer->nota.'</h3><br><p>Ver Formulário de avaliação:</p><br> <a class="btn btn-info" href="'.base_url('uploads/parecer/'.$parecer->arquivo_parecer).'">CLIQUE AQUI PARA VER O FORMULÁRIO</a>',
                              	'panel' => 'panel-danger',
                              	'label' => 'Etapa de Avaliação');
                              array_push($array['mensagens'], 'Infelizmente, seu trabalho foi <b>reprovado</b>. Mas fique tranquilo, você ainda poderá participar do evento!');

                          }
                      }
                  }

                }else{ //se não enviou o trabalho:
                	$array['fase'] = 'ENVIAR_TRABALHO';
                	$array['etapa'] = 4;
                	$array['porcentagem'] = 70;

                	$data_atual = strtotime(date('Y-m-d'));
                	$prazo_maximo = strtotime('2018-05-18');
                	if($data_atual > $prazo_maximo){
                		$array['status_trabalho'] = array(
                			'title' => 'Você perdeu o prazo para envio do trabalho. O prazo final era até o dia 18/05/2018.',

                			'panel' => 'panel-danger',
                			'label' => 'Fora do Prazo de Envio de Trabalho');

                		array_push($array['mensagens'], 'Você perdeu o prazo para envio do trabalho. O prazo final era até o dia <b>18/05/2018</b>.');
                		$array['etapa'] = 7;
                		$array['porcentagem'] = 100;

                		$array['div_enviar_trabalho'] = FALSE;
                		$array['div_alerta_trabalho'] = FALSE;
                		$array['div_status_trabalho'] = TRUE;
                	}
                	else{
                		if($status_comprovante == 1 || $status_comprovante == 3){
                			$array['div_enviar_trabalho'] = TRUE;
                			$array['div_alerta_trabalho'] = FALSE;
                			$array['div_status_trabalho'] = FALSE;
                		}

                		array_push($array['mensagens'], 'O <span style="font-size:14pt;"><strong>PRAZO</strong></span> para envio do seu artigo é até <span style="font-size:14pt;"><strong>dia 18 de MAIO!</strong></span>');
                	}
                }

            }
            else{  //e NÃO vai submeter trabalho:
                if($enviou_comprovante){
                      $array['fase'] = 'JA_ENVIOU_COMPROVANTE_E_NAO_SUBMETERA_TRABALHO';
                    $array['etapa'] = 7;
                    $array['porcentagem'] = 100;

                    array_push($array['mensagens'], 'Inscrição completa com sucesso!');

                    $array['div_enviar_comprovante'] = FALSE;
                    $array['div_status_comprovante'] = TRUE;
                    $array['div_enviar_trabalho'] = FALSE;
                    $array['div_alerta_trabalho'] = FALSE;
                    $array['div_status_trabalho'] = FALSE;
                }
                else{
                    $array['fase'] = 'JA_ENVIOU_COMPROVANTE_E_NAO_SUBMETERA_TRABALHO';
                    $array['etapa'] = 7;
                    $array['porcentagem'] = 100;

                    array_push($array['mensagens'], 'Inscrição completa com sucesso!');

                    $array['div_enviar_comprovante'] = TRUE;
                    $array['div_status_comprovante'] = FALSE;
                    $array['div_enviar_trabalho'] = FALSE;
                    $array['div_alerta_trabalho'] = FALSE;
                    $array['div_status_trabalho'] = FALSE;
                    
                }
            }







            return $array;
          //echo '<pre>'; print_r($array); echo '</pre>'; exit();





        }

        public function index(){


        	$data = $this->retorna_etapa_que_o_usuario_se_encontra();

        	$valor = $this->calcula_valor(date('m'), $this->session->userdata('usuario')->id_tipo_inscricao);

        	$data['valor'] = $valor;
        	$data['estagio'] = $data['etapa'];


        	$data['messages'] = mensagens();

        // echo '<pre>'; print_r($data); echo '</pre>'; exit();
        	$this->load->view('painel/html_header');
        	$this->load->view('painel/header');
        	$this->load->view('painel/index', $data);
        	$this->load->view('painel/footer');


        }

        public function enviar_arquivos(){
        	$id = $this->session->userdata('usuario')->id;

        	$data = $this->retorna_etapa_que_o_usuario_se_encontra();

        	$data['eixos'] = $this->painel_model->get_eixos();


       //$data['dentro_do_prazo'] = $this->painel_model->get_diferenca_datas($id);

        	$data['messages'] = mensagens();

       // echo '<pre>'; print_r($data); echo '</pre>'; exit();

        	$this->load->view('painel/html_header');
        	$this->load->view('painel/header');
        	$this->load->view('painel/send-files', $data);
        	$this->load->view('painel/footer');
        }

    /**
     * Função que retorna o HTML padrão do controller
     */
    // public function index_antigo(){

    // 	$id = $this->session->userdata('usuario')->id;
    //     //$vai_submeter_trabalho = $this->session->userdata('usuario')->submeter_trabalho;

    //     //$foto_comprovante = $this->session->userdata('usuario')->foto_comprovante;
    // 	$usuario = $this->painel_model->get($id);
    // 	$status_inscricao = $usuario->status_inscricao;
    // 	$foto_comprovante = $usuario->foto_comprovante;

    // 	$vai_submeter_trabalho = $usuario->submeter_trabalho;

    // 	$info = array();   
    //     // $success = array();
    //     // $danger = array();
    //     // $warning = array(); 

    //     $ponto = 0; //para poder marcar o avanço do participante
    //     $estagio = 2; //qual nível ele está.

    //     if($foto_comprovante == ''){//porque ainda não enviou o comprovante
    //     	$info[] = 'Você não anexou a foto de seu comprovante de pagamento!';
    //     	$estagio =  2;
    //     }
    //     else{

    //        // $status_inscricao = $this->session->userdata('usuario')->status_inscricao;

    //     	switch($status_inscricao){
    //     		case 0: $info[] = 'Seu pagamento está em análise.'; $ponto += 20; $estagio = 3; break;
    //     		case 1: $info[] = 'Seu pagamento foi <strong>aprovado!</strong>'; $ponto += 30; if(!$vai_submeter_trabalho) $estagio =7; else $estagio = 4; break;
    //     		case 2: $info[] = 'Seu comprovante foi reprovado por nossa equipe, por favor, envie um novo comprovante <a href="'.base_url('Painel/enviar_arquivos').'">clicando aqui</a>.'; break;
    //     		case 3: $info[] = 'Você está <strong>isento</strong> do pagamento deste evento.'; $ponto +=30; if(!$vai_submeter_trabalho) $estagio =7; else $estagio = 4; break;
    //     	}
    //     }

    //     if($vai_submeter_trabalho){ 
    //     	if($this->painel_model->possui_trabalho_anexado($id)){
    //     		$status_trabalho = $this->painel_model->status_trabalho($id);
    //     		switch($status_trabalho){
    //     			case 0: $info[] = 'Seu trabalho está na fase de <strong>validação</strong>.<br> Fique atento em seu e-mail e no sistema, pois o prazo para correção do trabalho é de 3 dias úteis após o recebimento do aviso.'; $ponto += 20; if($estagio == 3) $estagio = 4; break;
    //     			case 1: $info[] = 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'; $ponto += 30; if($estagio == 4) $estagio = 7; break;
    //     			case 2: $info[] = 'Infelizmente seu trabalho <strong>não</strong> foi aprovado, mas você poderá ainda participar do Congresso.'; $ponto += 30; if($estagio == 4) $estagio = 7;   break;
    //     		}
    //     	}else{
    //     		// $ultimo_dia_mes = $this->ultimo_dia(date('m'));
    //     		// $nome_do_mes = $this->nome_do_mes(date('m'));
    //     		$info[] = 'O <span style="font-size:14pt;"><strong>PRAZO</strong></span> para envio do seu artigo é até <span style="font-size:14pt;"><strong>dia 30 de ABRIL!</strong></span>'; 
    //     		if($estagio != 2) $estagio = 4;


    //     	}
    //     }
    //     else{ //se ele n vai submeter trabalho
    //         if($status_inscricao == 1) $ponto+= 30; //se a inscrição tá paga, tá tudo certo.
    //     }


    //     //calculo de porcentagem:

    //     $porcentagem = $ponto + 40;
    //     if($porcentagem != 100){
    //     	$data['completo'] = false;
    //     }
    //     else{
    //     	$data['completo'] = true;
    //     }
    //     $data['info'] = $info;
    //     // $data['success'] = $success;
    //     // $data['danger'] = $danger;
    //     // $data['warning'] = $warning;
    //     $data['porcentagem'] = $porcentagem;
    //     $data['estagio'] = $estagio;
    //     $data['vai_submeter_trabalho'] = $vai_submeter_trabalho;


    //     //relacionado ao VALOR que deverá ser pago:
    //     $valor = $this->calcula_valor(date('m'), $this->session->userdata('usuario')->id_tipo_inscricao);

    //     $data['valor'] = $valor;



    //     $data['mensagens'] = mensagens();



    //     $this->load->view('painel/html_header');
    //     $this->load->view('painel/header');
    //     $this->load->view('painel/widgets', $data);
    //     $this->load->view('painel/footer');

    // }

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
            	case 5: return 140; break;
            	case 6: return 140; break;
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





    public function enviar_arquivos_antigo(){

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
    				case 2: $status_trabalho = 'Infelizmente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.'; break;
    				case 3: $status_trabalho = 'Seu trabalho está sendo analisado por um parecerista.'; break;
    				case 4: $status_trabalho = 'Houve um problema com seu trabalho sem o nome de autor, portanto será preciso reenviá-lo.'; break;
    				case 5: $status_trabalho = 'Houve um problema com seu trabalho com o nome de autor, portanto será preciso reenviá-lo.'; break;
    				case 6: $status_trabalho = 'Houve um problema com ambos trabalho, portanto será preciso reenviá-los'; break;
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
    	$data['dentro_do_prazo'] = $this->painel_model->get_diferenca_datas($id);

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


    	if($resposta == 'true'){
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

public function resend_article(){
	if($this->input->post('artigo_com_autor') !== false){
		$resposta1 = $this->do_upload_article('artigo_com_autor');
	}
	else
	{
		$resposta1['deu_certo'] = false;
	}

	if($this->input->post('artigo_sem_autor') !== false){
		$resposta2 = $this->do_upload_article('artigo_sem_autor');
	}
	else
	{
		$resposta2['deu_certo'] = false;
	}

	if($resposta1['deu_certo'] || $resposta2['deu_certo']){
		if($resposta1['deu_certo'])
		{
			$data['arquivo_com_nome_autor'] = $resposta1['message'];
		}
		if($resposta2['deu_certo'])
		{
			$data['arquivo_sem_nome_autor'] = $resposta2['message'];
		}
		$id = $this->session->userdata('usuario')->id;
		$data['status'] = 0;
		$data['data_limite'] = NULL;
		$data['justificativa'] = NULL;
		$this->db->where('id_participante', $id);
		$this->db->update('trabalho', $data);


		$this->log_model->insert('O participante reenviou o artigo.', $id);
		$this->session->set_flashdata('success', 'Artigo reenviado para análise.<br>Em breve você receberá a resposta.');
		echo "<br>Deu certo!";

	}else{

		if($resposta1['deu_certo'] != true) $this->session->set_flashdata('danger', $resposta1['message']);
		if($resposta2['deu_certo'] != true) $this->session->set_flashdata('danger', $resposta2['message']);
		echo "<br>Deu errado!";
	}

	redirect(base_url('Painel/enviar_arquivos'));
}

public function profile(){
	$data['mensagens'] = mensagens();
	$id = $this->session->userdata('usuario')->id;
	$this->db->where('id', $id);
	$usuario = $this->db->get('participante')->row();    




	$data['usuario'] = $usuario;
	$this->load->view('painel/html_header');
	$this->load->view('painel/header');
	$this->load->view('painel/profile', $data);
	$this->load->view('painel/footer');
}



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
    	$config['max_size']             = 8192;
    	$config['encrypt_name']         = TRUE;


    	$this->load->library('upload');
    	$this->upload->initialize($config);
    	if ( ! $this->upload->do_upload($name))
    	{


    		return $this->upload->display_errors();

    	}
    	else
    	{

        //inserir no banco
    		$foto = $this->upload->data('file_name');
    		$id = $this->session->userdata('usuario')->id;
    		$resposta =  $this->painel_model->update_image($foto, $id);
    		if($resposta) return 'true';
    		else return 'Ocorreu um problema no banco de dados. Por favor, tente mais tarde.';

    	}
    }

    public function do_upload_article($name){

    	$upload_path = 'uploads/artigo';


    	$config['upload_path']          = $upload_path;
    	$config['allowed_types']        = 'doc|docx|pdf';
    	$config['max_size']             = 10000;
    	$config['encrypt_name']         = TRUE;

    	$this->load->library('upload', $config);

    	if ( ! $this->upload->do_upload($name))
    	{

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



    public function getcouator($cpf)
    {
    	if ($cpf!="") {
    		$this->db->where('cpf', $cpf);
    		$this->db->where('(status_inscricao = 1 OR status_inscricao = 3)');
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


    public function minicursos(){
    	$id = $this->session->userdata('usuario')->id;
    	$this->db->where('id', $id);
    	$usuario = $this->db->get('participante')->row();

    	$data['minicurso'] = $this->minicurso_model->getAll();
    	foreach ($data['minicurso'] as $minicurso) {
    		$minicurso->vagasRestantes = $this->minicurso_model->vagasRestantes($minicurso->id, $usuario->status_inscricao);

    	}

    	$data['meusMinicursos'] = $this->minicurso_model->meusMinicursos($usuario->id);

    	$data['usuario'] = $usuario;
    	$data['mensagens'] = mensagens();
    	$this->load->view('painel/html_header');
    	$this->load->view('painel/header');
    	$this->load->view('painel/minicursos', $data);
    	$this->load->view('painel/footer');




    }

    public function minicursoInscrever($idMinicurso){
        if($this->minicurso_model->existsMinicurso($idMinicurso)){ //barra usuario troll
        	if(($this->session->userdata('usuario')->status_inscricao == 1) || ($this->session->userdata('usuario')->status_inscricao == 3)){
            	if($this->dataLimiteMinicurso()){ //verifica se ainda esta no prazo de se inscrever
            		$array = $this->minicurso_model->meusMinicursos($this->session->userdata('usuario')->id, "dia");
            		$dia =  $this->minicurso_model->getDia($idMinicurso);
            		$vagas = $this->minicurso_model->vagasRestantes($idMinicurso, $this->session->userdata('usuario')->status_inscricao);
            		if($vagas > 0){
            			if(!(minicursoInArray($array, $dia->dia, "dia"))){
            				$this->minicurso_model->inscreverMinicurso($this->session->userdata('usuario')->id, $idMinicurso);
            				$this->session->set_flashdata('success', "Inscrito no minicurso com sucesso.");
            			}
            			else
            				$this->session->set_flashdata('danger', "<b>Choque de horário. Você já está inscrito em outro minicurso neste mesmo horário. </b>");
            		}
            		else 
            			$this->session->set_flashdata('danger', "<b>Sem Vagas. Esse minicurso não possui mais vagas.</b>");
            	}
            	else{
            		$this->session->set_flashdata('danger', "<b>O prazo para inscrição já foi encerrado.</b>");
            	}
            }
            else{
            	$this->session->set_flashdata('danger', "<b>Não foi possível se inscrever pois sua inscrição ainda não foi aprovada.</b>");
            }
        }
        redirect(base_url('Painel/minicursos'));
    }
    private function dataLimiteMinicurso(){
    	date_default_timezone_set('America/Sao_Paulo');
    	$data = date('Y-m-d H:i');
    	if(self::DATALIMITE > $data)
    		return true;
    		else
    			return false;
    	}
    }