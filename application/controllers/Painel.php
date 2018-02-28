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
        $this->load->model('Painel_model', 'painel_model');

    }

    /**
     * Função que retorna o HTML padrão do controller
     */
    public function index(){
        $id = $this->session->userdata('usuario')->id;
        $vai_submeter_trabalho = $this->session->userdata('usuario')->submeter_trabalho;

        $foto_comprovante = $this->session->userdata('usuario')->foto_comprovante;

        $info = array();
        $success = array();
        $danger = array();
        $warning = array(); 

        $ponto = 0; //para poder marcar o avanço do participante

        if($foto_comprovante == ''){//porque ainda não enviou o comprovante
            $warning[0] = 'Você não anexou a foto de seu comprovante de pagamento ainda!';
        }
        else{

            $status_inscricao = $this->session->userdata('usuario')->status_inscricao;
            switch($status_inscricao){
                case 0: $info[0] = 'Seu pagamento está em análise.'; $ponto = 20; break;
                case 1: $success[0] = 'Seu pagamento foi aprovado!'; $ponto = 30; break;
                case 2: $danger[0] = 'Seu comprovante foi reprovado por nossa equipe, por favor, envie um novo comprovante.'; break;
            }
        }

        if($vai_submeter_trabalho){ 
            if($this->painel_model->possui_trabalho_anexado($id)){
                $status_trabalho = $this->painel_model->status_trabalho($id);
                switch($status_trabalho){
                    case 0: $info[1] = 'Seu trabalho está em análise'; $ponto = 20; break;
                    case 1: $success[1] = 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'; $ponto = 30; break;
                    case 2: $danger[1] = 'Infelimente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.'; break;
                }
            }else{
                $warning[1] = 'Você deve enviar seu artigo até fim do mês!';
            }
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
        $data['success'] = $success;
        $data['danger'] = $danger;
        $data['warning'] = $warning;
        $data['porcentagem'] = $porcentagem;
        $data['vai_submeter_trabalho'] = $vai_submeter_trabalho;

        $this->load->view('painel/html_header');
        $this->load->view('painel/header');
        $this->load->view('painel/widgets', $data);
        $this->load->view('painel/footer');

    }

    public function send_doubt(){
        //enviar dúvida
        $email = $this->session->userdata('usuario')->email;
        $nome = $this->session->userdata('usuario')->nome;
        $mensagem = htmlspecialchars($this->input->post('message'));

    }


 
}