<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Trabalho_model extends CI_Model{

    public function __construct(){
        parent::__construct();
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

    public function get_all(){

        $this->db->select('trabalho.id_eixo as id_eixo, participante.email,trabalho.id_participante as id, trabalho.arquivo_sem_nome_autor, trabalho.arquivo_com_nome_autor, trabalho.justificativa, participante.nome, trabalho.titulo, eixo.nome as eixo, trabalho.data_registro as data, tipo_inscricao.tipo, trabalho.status');
        $this->db->order_by('trabalho.data_registro', 'ASC');
        $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
        return $this->db->get('participante')->result_array();
    }

    public function num_rows(){
        return $this->db->get('trabalho')->num_rows();
    }

    public function num_rows_where_status($status){
        $this->db->where('trabalho.status', $status);
        return $this->db->get('trabalho')->num_rows();
    }

    public function reenviar_trabalhos($id_participante, $status)
    {
        $this->db->where('id_participante', $id_participante);
        $data['status'] = $status;
        $data['data_resposta'] = date("Y-m-d H:i:s");
        return $this->db->update('trabalho', $data);
    }

    public function num_rows_enviados_para_pareceristas(){
        return $this->db->get('trabalho_parecerista')->num_rows();
    }

    public function get_all_trabalhos_que_foram_enviados_para_pareceristas(){
        $this->db->select('trabalho.arquivo_com_nome_autor, trabalho.arquivo_sem_nome_autor, participante.email as email, participante.nome as nome_participante, trabalho.titulo as titulo, eixo.nome as eixo, tipo_inscricao.tipo as tipo,  trabalho_parecerista.status_parecer as status,  parecerista.nome as nome_parecerista, trabalho_parecerista.data_registro as data, trabalho_parecerista.ativo as ativo, trabalho.justificativa as justificativa');
        $this->db->join('trabalho', 'trabalho_parecerista.id_trabalho = trabalho.id_participante', 'INNER');
        $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'INNER');
        $this->db->join('participante', 'trabalho.id_participante = participante.id', 'INNER');
        $this->db->join('tipo_inscricao', 'tipo_inscricao.id = participante.id_tipo_inscricao', 'INNER');
        $this->db->join('parecerista', 'trabalho_parecerista.id_parecerista = parecerista.id', 'INNER');


        return $this->db->get('trabalho_parecerista')->result_array();
    }
}