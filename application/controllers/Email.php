<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Admin.php');


class Email extends Admin {
    public function __construct(){
        parent::__construct();
        $this->load->helper('frontend_helper'); 
        $this->load->helper('modalform_helper'); 
        $this->load->model('Participante_model', 'participante_model');

    }

    public function especifico($tipo_usuario = 'participante'){

        if($tipo_usuario == 'participante'){
        	$this->db->order_by('nome','ASC');
        	$this->db->join('tipo_inscricao', 'tipo_inscricao.id = participante.id_tipo_inscricao', 'INNER');
        	$objects = $this->db->get('participante')->result();
            foreach($objects as $participante){
                $participante->value = $participante->email;
                $participante->label = $participante->nome.' - '.$participante->tipo.' - '.$participante->estado;
            }
            
        }else if($tipo_usuario == 'parecerista'){
            $this->db->order_by('nome', "ASC");
            $objects = $this->db->get('parecerista')->result();
            foreach($objects as $parecerista){
                $parecerista->value = $parecerista->email;
                if($parecerista->instituicao == '') $parecerista->instituicao = 'Nenhuma';
                $parecerista->label = $parecerista->nome.' - '.$parecerista->instituicao;
            }
        }

        $dados['objects'] = $objects;
        $dados['mensagens'] = mensagens();
        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('email-especifico', $dados);
        $this->load->view('footer-admin');
    }


    public function grupo(){
        $this->db->order_by('tipo', 'ASC');
        $dados['tipos'] = $this->db->get('tipo_inscricao')->result();

        $dados['mensagens'] = mensagens();

        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('email-grupo', $dados);
        $this->load->view('footer-admin');
    }

    public function enviar_email_especifico(){
        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $title = $this->input->post('title');
        $resposta = $this->send_email_with_title($title,$message,$email);

        if($resposta == 1){
            $this->log_model->insert_admin('O Administrador enviou um e-mail para: '.$email.' usando enviar e-mail específico.', $this->session->userdata('usuario')->id);
            $this->session->set_flashdata('success', 'E-mail enviado com sucesso!');
        }else{
            $this->log_model->insert_admin('O Administrador tentou enviar um e-mail para: '.$email.' e houve uma falha do sistema.', $this->session->userdata('usuario')->id);
            $this->session->set_flashdata('danger', 'Houve um erro ao enviar este e-mail, por favor, tente novamente.');
            $this->session->set_flashdata('danger', htmlspecialchars($resposta));

        }

        redirect(base_url('Email/especifico'));
    }

    public function enviar_email_grupo(){
        $pagamento = $trabalho = $tipo_inscricao = '';

        $pagamento = $this->input->post('pagamento');
        $trabalho  = $this->input->post('trabalho');
        $tipo_inscricao = $this->input->post('tipo_inscricao');
        $message = $this->input->post('message');
        $title = $this->input->post('title');


        $participantes = $this->participante_model->select_participantes($pagamento, $trabalho, $tipo_inscricao);
        
        // print_r($participantes); exit();

        foreach($participantes as $participante){
            $resposta = $this->send_email_with_title($title, $message, $participante->email);
            if($resposta != 1){
                $this->session->set_flashdata('danger', 'Houve um erro ao enviar e-mail para '.$participante->email.'. Por favor, tente novamente mais tarde.');
                redirect(base_url('Email/grupo'));
            //break;

            }else{
                $this->log_model->insert_admin('O Administrador enviou um e-mail para: '.$participante->email.' usando o enviar e-mail grupo.', $this->session->userdata('usuario')->id);
            }
        }
        $this->session->set_flashdata('success', 'E-mails enviados com sucesso!');
        $html.= '';
        $html.= '<p>Os e-mails foram enviados para:</p>';
        $html.= '<ol>';

        foreach($participantes as $participante){
            $html.= '<li><strong>'.$participante->nome.'</strong> : '.$participante->email.'</li>';

        }
        $html.= '</ol>';
        $this->session->set_flashdata('success', $html);


        redirect(base_url('Email/grupo'));

    }

    public function pareceristas(){

        $dados['mensagens'] = mensagens();

        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('email-pareceristas', $dados);
        $this->load->view('footer-admin');
    }

    public function enviar_email_pareceristas(){

        $message = $this->input->post('message');
        $title = $this->input->post('title');

        $this->db->where('status_inscricao', 1);
        $pareceristas = $this->db->get('parecerista')->result();
      
        foreach($pareceristas as $parecerista){
            $resposta = $this->send_email_with_title($title, $message, $parecerista->email);
            if($resposta != 1){
                $this->session->set_flashdata('danger', 'Houve um erro ao enviar e-mail para '.$parecerista->email.'. Por favor, tente novamente mais tarde.');
                redirect(base_url('Email/pareceristas'));
            //break;

            }else{
                $this->log_model->insert_admin('O Administrador enviou um e-mail para: '.$parecerista->email.' usando o enviar e-mail para TODOS pareceristas.', $this->session->userdata('usuario')->id);
            }
        }
        $this->session->set_flashdata('success', 'E-mails enviados com sucesso!');
        $html.= '';
        $html.= '<p>Os e-mails foram enviados para:</p>';
        $html.= '<ol>';

        foreach($pareceristas as $parecerista){
            $html.= '<li><strong>'.$parecerista->nome.'</strong> : '.$parecerista->email.'</li>';

        }
        $html.= '</ol>';
        $this->session->set_flashdata('success', $html);


        redirect(base_url('Email/pareceristas'));

    }



}
?>