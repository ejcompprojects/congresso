<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Login.php');

/**
 * Classe responsável por gerenciar as ações de um administrador
 */
class PainelParecerista extends Login {
    private $all = false;
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario')->tipo_usuario == 'Participante') redirect(base_url('Painel'));
        else if($this->session->userdata('usuario')->tipo_usuario == 'Administrador') redirect(base_url('Admin'));
        $this->load->helper('date');
        $this->load->helper('frontend_helper'); 
        $this->load->helper('modalform_helper');
        $this->load->library('ListMaker');
        $this->load->model('Parecerista_Painel_model', 'pModel');
    }
    public function index(){

        $this->load->view('html-header-admin');
        $this->load->view('header-parecerista');
        $this->load->view('footer-admin');

    }
public function Pareceres()
{
    $this->visualizar();
}
public function insert()
{
    $justificativa = (null !== $this->input->post('justificativa')) ? $this->input->post('justificativa') : false;
    $id_trabalho    = $this->input->post('id');
    if(!$justificativa)
    {
        $msg_success    = "";
        $msg_error      = "";

        $parecer_file   = $this->do_upload_parecer("parecer");
        if(!$parecer_file['deu_certo']) $msg_error .= $parecer_file['message'];
    
        $dados_fields   = array('id', 'nota');


        $dados['id_parecerista']    = $this->session->userdata('usuario')->id;
        $dados['data_parecer']      = date("Y-m-d H:i:s");
        $dados['nota']              = $this->input->post('nota');
        $dados['status_parecer']    = ($dados['nota']>4.9) ? 1 : 2;
        $dados['arquivo_parecer']   = $parecer_file['message'];
        $dados['ja_deu_parecer']    = 1;


        foreach ($dados_fields as $field)
            $this->form_validation->set_rules($field , $field, "required");

        if ($this->form_validation->run() == FALSE || $msg_error != "")
        {
            $this->session->set_flashdata('dados', $dados);
            $this->session->set_flashdata('danger', $msg_error);
        }
        else
        {
            if($this->pModel->update($id_trabalho, $dados)){
                $participante   = $this->pModel->get_email_participante_trabalho($id_trabalho);

                 $this->log_model->insert_parecerista("Parecer realizado para " . $participante['nome'], $this->session->userdata('usuario')->id);
                 $this->session->set_flashdata(
                    'success', "Parecer realizado com sucesso!"
                 );
                $mensagem       = "Prezado(a) " . $participante['nome'] . ", seu trabalho foi avaliado!<br/>";
                $mensagem      .= "<b>Situação: </b>";
                $mensagem      .= ($dados['status_parecer']==1) ? "Aprovado" : "Reprovado";
                $mensagem      .= "<br/><b>Nota: </b>" . $dados['nota'];
                $mensagem      .= "<br/><br/>Atenciosamente, Comissão Avaliadora Congresso Pedagogia Hitórico-Crítica";

                if(parent::send_email_with_title('PHC - Avaliação do Trabalho', $mensagem, $participante['email'])){
                    $this->log_model->insert_parecerista("Avaliação de trabalho enviada para " . $participante['email'], $this->session->userdata('usuario')->id);
                }

            }
            else $this->session->set_flashdata(
                    'danger', "Parecer não realizado, tente novamente."
                );
        }
    }
    else
    {
        $dados['justificativa_parecerista'] = $justificativa;
       if($this->pModel->update_trabalho($id_trabalho, $dados)){
            unset($dados);
            $dados['ativo'] = 0;
            $dados['status_parecer'] = 0;
            $this->pModel->update($id_trabalho, $dados);
            $this->log_model->insert_parecerista("Avaliação de trabalho revogada " . $id_trabalho, $this->session->userdata('usuario')->id);
            $this->session->set_flashdata('success', "Parecer revogado com sucesso!");
       }
       else $this->session->set_flashdata('danger', "Não foi possível revogar o parecer!");
    }
    redirect(base_url('Parecerista/Pareceres'));
}
public function visualizar()
    {
        $dados['eixo_selected'] = (null !== $this->input->post('eixo')) ? $this->input->post('eixo') : 0;
        $dados['pareceres']     = $this->pModel->get_where_parecerista_eixo($_SESSION['usuario']->id, $dados['eixo_selected']);
        $dados['eixos']         = $this->pModel->get_all_where_eixo_paracer($_SESSION['usuario']->id);
        $dados['mensagens']     = mensagens();
        $this->load->view('html-header-admin');
        $this->load->view('header-parecerista');
        $this->load->view('listar-pareceres', $dados);
        $this->load->view('footer-admin');
    }
    public function do_upload_parecer($name){

        $upload_path = 'uploads/parecer';

        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = '|txt|doc|docx|pdf';
        $config['max_size']             = 8192;
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
}