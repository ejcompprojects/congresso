<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Trabalho_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_all_where_refused(){

        $this->db->select('trabalho.status, trabalho.status_coautores, trabalho.data_limite as prazo, trabalho.justificativa as justificativa, trabalho.id_eixo as id_eixo, participante.email,trabalho.id_participante as id, trabalho.arquivo_sem_nome_autor, trabalho.arquivo_com_nome_autor, trabalho.justificativa, participante.nome, trabalho.titulo, eixo.nome as eixo, trabalho.data_registro as data, tipo_inscricao.tipo');
        $this->db->order_by('trabalho.data_registro', 'ASC');
        $this->db->where('trabalho.status > 1');
        $this->db->where('trabalho.status != 3');
        $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
        return $this->db->get('participante')->result_array();
    }

    public function get_all(){

        $this->db->select('trabalho.id_eixo as id_eixo, participante.email,trabalho.id_participante as id, trabalho.arquivo_sem_nome_autor, trabalho.arquivo_com_nome_autor, trabalho.justificativa, participante.nome, trabalho.titulo, eixo.nome as eixo, trabalho.data_registro as data, tipo_inscricao.tipo, trabalho.status');
        $this->db->order_by('trabalho.data_registro', 'ASC');
        $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
        return $this->db->get('participante')->result_array();
    }

    public function get_all_where_status($status){

        $this->db->select('trabalho.id_eixo as id_eixo, participante.email,trabalho.id_participante as id, trabalho.arquivo_sem_nome_autor, trabalho.arquivo_com_nome_autor, trabalho.justificativa, participante.nome, trabalho.titulo, eixo.nome as eixo, trabalho.data_registro as data, tipo_inscricao.tipo');
        $this->db->order_by('trabalho.data_registro', 'ASC');
        $this->db->where('trabalho.status', $status);
        $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
        return $this->db->get('participante')->result_array();
    }

    public function num_rows_where_status($status){
        $this->db->where('trabalho.status', $status);
        return $this->db->get('trabalho')->num_rows();
    }


    public function get_where_status_parecer($status){

        $this->db->select('trabalho_parecerista.nota as nota, trabalho_parecerista.data_parecer as data_parecer, trabalho_parecerista.arquivo_parecer, parecerista.nome as parecerista, trabalho.id_eixo as id_eixo, participante.email,trabalho.id_participante as id, trabalho.arquivo_sem_nome_autor, trabalho.arquivo_com_nome_autor, trabalho.justificativa, participante.nome, trabalho.titulo, eixo.nome as eixo, trabalho.data_registro as data_submissao, tipo_inscricao.tipo, trabalho.status');
        $this->db->order_by('trabalho_parecerista.nota', 'DESC');
        $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        //$this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->join('trabalho_parecerista', 'trabalho.id_participante = trabalho_parecerista.id_trabalho', 'INNER');
        $this->db->join('parecerista', 'parecerista.id = trabalho_parecerista.id_parecerista', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');

        $this->db->where('trabalho_parecerista.status_parecer', $status);

        $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
        return $this->db->get('participante')->result_array();
    }

    public function num_rows_status_parecer($status){
        $this->db->where('trabalho_parecerista.status_parecer', $status);
        return $this->db->get('trabalho_parecerista')->num_rows();
    }

    public function num_rows(){
        return $this->db->get('trabalho')->num_rows();
    }

    public function num_rows_where_refused(){
        $this->db->where('trabalho.status > 1');
        $this->db->where('trabalho.status != 3');
        return $this->db->get('trabalho')->num_rows();
    }

    public function reenviar_trabalhos($id_participante, $status, $status_coautores, $data_limite, $justificativa)
    {
        $this->db->where('id_participante', $id_participante);
        $data['status'] = $status;
        $data['status_coautores'] = $status_coautores;
        $data['data_resposta'] = date("Y-m-d H:i:s");
        $data['data_limite'] = date("Y-m-d", strtotime($data_limite));
        $data['justificativa'] = $justificativa;
        return $this->db->update('trabalho', $data);
    }

    public function num_rows_enviados_para_pareceristas(){
        return $this->db->get('trabalho_parecerista')->num_rows();
    }

    public function get_all_trabalhos_que_foram_enviados_para_pareceristas(){
        $this->db->order_by('data', 'ASC');
        $this->db->select('participante.id as id_trabalho, trabalho.arquivo_com_nome_autor, trabalho.arquivo_sem_nome_autor, participante.email as email, participante.nome as nome_participante, trabalho.titulo as titulo, eixo.nome as eixo, tipo_inscricao.tipo as tipo,  trabalho_parecerista.status_parecer as status,  parecerista.nome as nome_parecerista, trabalho_parecerista.data_registro as data, trabalho_parecerista.ativo as ativo, trabalho_parecerista.justificativa_parecerista as justificativa');
        $this->db->join('trabalho', 'trabalho_parecerista.id_trabalho = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('participante', 'trabalho.id_participante = participante.id', 'INNER');
        $this->db->join('tipo_inscricao', 'tipo_inscricao.id = participante.id_tipo_inscricao', 'INNER');
        $this->db->join('parecerista', 'trabalho_parecerista.id_parecerista = parecerista.id', 'INNER');


        return $this->db->get('trabalho_parecerista')->result_array();
    }


    public function remover_trabalho_parecerista($id_trabalho){
        $this->db->where('id_trabalho', $id_trabalho);
        return $this->db->delete('trabalho_parecerista');

    }

    public function set_trabalho_status($id_trabalho, $status){
        $this->db->where('id_participante', $id_trabalho);
        $dados['status'] = $status;
        return $this->db->update('trabalho', $dados);
    }

    public function getCoautoresTrabalho($id_trabalho){
        $this->db->from("participante");
        $this->db->join("coautor", "coautor.id_participante = participante.id");
        $this->db->where("coautor.id_trabalho", $id_trabalho);
        return $this->db->get()->result_array();
    }
}