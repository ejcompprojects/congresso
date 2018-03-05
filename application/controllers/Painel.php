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

        //$foto_comprovante = $this->session->userdata('usuario')->foto_comprovante;
        $usuario = $this->painel_model->get($id);
        $foto_comprovante = $usuario->foto_comprovante;

        $info = array();
        // $success = array();
        // $danger = array();
        // $warning = array(); 

        $ponto = 0; //para poder marcar o avanço do participante
        $estagio = 2; //qual nível ele está.

        if($foto_comprovante == ''){//porque ainda não enviou o comprovante
            $info[] = 'Você não anexou a foto de seu comprovante de pagamento ainda!';
            $estagio =  2;
        }
        else{

           // $status_inscricao = $this->session->userdata('usuario')->status_inscricao;
            $status_inscricao = $usuario->status_inscricao;

            switch($status_inscricao){
                case 0: $info[] = 'Seu pagamento está em análise.'; $ponto += 20; $estagio = 3; break;
                case 1: $info[] = 'Seu pagamento foi <strong>aprovado!</strong>'; $ponto += 30; if(!$vai_submeter_trabalho) $estagio =5; else $estagio = 4; break;
                case 2: $info[] = 'Seu comprovante foi reprovado por nossa equipe, por favor, envie um novo comprovante <a href="'.base_url('Painel/enviar_arquivos').'">clicando aqui</a>.'; break;
                case 3: $info[] = 'Você está <strong>isento</strong> do pagamento deste evento.'; $ponto +=30; if(!$vai_submeter_trabalho) $estagio =5; else $estagio = 4; break;
            }
        }

        if($vai_submeter_trabalho){ 
            if($this->painel_model->possui_trabalho_anexado($id)){
                $status_trabalho = $this->painel_model->status_trabalho($id);
                switch($status_trabalho){
                    case 0: $info[] = 'Seu trabalho está em análise'; $ponto += 20; if($estagio == 3) $estagio = 4; break;
                    case 1: $info[] = 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'; $ponto += 30; if($estagio == 4) $estagio = 5; break;
                    case 2: $info[] = 'Infelimente seu trabalho <strong>não</strong> foi aprovado, mas você poderá ainda participar do Congresso.'; $ponto += 30; if($estagio == 4) $estagio = 5;   break;
                }
            }else{
                $info[] = 'Você deve enviar seu artigo até fim do mês!'; 
                if($estagio != 2) $estagio = 4;
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
        // $data['success'] = $success;
        // $data['danger'] = $danger;
        // $data['warning'] = $warning;
        $data['porcentagem'] = $porcentagem;
        $data['estagio'] = $estagio;
        $data['vai_submeter_trabalho'] = $vai_submeter_trabalho;


        $data['mensagens'] = mensagens();

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
        $mensagem.='<br>Participante: '.$nome;
        $mensagem.="<br>E-mail: ".$email;
        if($this->send_email_to_admin($mensagem)){
            $this->session->set_flashdata('success', 'Dúvida enviada com sucesso!<br>Em breve te responderemos através de seu e-mail. Fique ligado em sua caixa de entrada.');
        }else{
           $this->session->set_flashdata('danger', 'Houve um erro ao enviar o e-mail.Tente enviar a dúvida para o e-mail:'.EMAIL_ADMIN);
       }



       redirect(base_url('Painel#duvida'));
   }

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
            $this->db->update('administrador', $dados);

            $this->session->set_flashdata('success', 'Dados atualizados com sucesso!');

            }else{

                $this->session->set_flashdata('danger', 'Senha Nova e Repetir Senha estão diferentes!');
            }
            }else{ //se for diferente
                $this->session->set_flashdata('danger', 'Senha Atual incorreta!');

            }
     }
     else{
        $this->session->set_flashdata('success', 'Dados atualizados com sucesso!');
        $this->db->where('id', $id);
        $this->db->update('participante', $dados);

     }


redirect(base_url('Painel/profile'));

}

public function do_upload_image($name)
{



    $config['upload_path']          = 'uploads/comprovante';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
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

public function save($article, $name, $id){
    $eixo = $this->input->post('eixo');
    $titulo  = $this->input->post('titulo');

    if($this->painel_model->existe_trabalho($id)){
        $this->painel_model->update_trabalho($article, $name, $id, $titulo, $eixo);
    }else{
        $this->painel_model->insert_trabalho($article, $name, $id, $titulo, $eixo);
    }
}

}