<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Login.php');

/**
 * Classe responsável por gerenciar as ações de um administrador
 */
class Admin extends Login {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario')->tipo_usuario == 'Participante') redirect(base_url('Painel'));
        $this->load->helper('frontend_helper'); 

    }

    /**
     * Função que retorna o HTML padrão do controller
     */
    public function index(){

        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('home');
        $this->load->view('footer-admin');

    }

    public function profile(){
        $id = $this->session->userdata('usuario')->id;
        $this->db->where('id', $id);
        $usuario = $this->db->get('administrador')->row();
        $dados['usuario'] = $usuario;
        $dados['mensagens'] = mensagens();
        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('profile', $dados);
        $this->load->view('footer-admin');


    }

    public function alterar_meus_dados(){
     $id = $this->session->userdata('usuario')->id;
     $nome =  $this->input->post('nome');
     $dados['nome'] = $nome;
     $senha_atual = $this->input->post('senha_atual');
     $senha_nova  = $this->input->post('senha_nova');
     $repetir_senha = $this->input->post('repetir_senha');


     $this->db->where('id', $id);
     $this->db->select('senha');
     $usuario = $this->db->get('administrador')->row();
     $senha = $usuario->senha;
     if($senha_nova != '' || $senha_atual != ''){
       if(password_verify($senha_atual, $senha)){ //senhas iguais:
           if($senha_nova == $repetir_senha){
            //devemos atualizar a senha:
            $dados['senha'] = $this->crypt($senha_nova);
            $this->db->where('id', $id);
            $this->db->update('administrador', $dados);

            $this->session->set_flashdata('success', 'Nome e senha atualizados com sucesso!');

            }else{

                $this->session->set_flashdata('danger', 'Senha Nova e Repetir Senha estão diferentes!');
            }
            }else{ //se for diferente
                $this->session->set_flashdata('danger', 'Senha Atual incorreta!');

            }
     }
     else{
        $this->session->set_flashdata('success', 'Nome atualizado com sucesso!');
        $this->db->where('id', $id);
        $this->db->update('administrador', $dados);

     }


redirect(base_url('Admin/profile'));

}




}