<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Parecerista_model extends CI_Model{
    const DB_TABLE         = "parecerista";
    const DB_RELATION      = "parecerista_eixo";
    const ID_COLUMN        = "id";
    const NOME_COLUMN      = "nome";
    const CPF_COLUMN       = "cpf";
    const EMAIL_COLUMN     = "email";
    const CEL_COLUMN       = "celular";
    const TEL_COLUMN       = "telefone";
    const INST_COLUMN      = "instituicao";

    public function __construct(){
        parent::__construct();
    }

    public function email_exists($key){
        $this->db->where(self::EMAIL_COLUMN,$key);
        $query = $this->db->get(self::DB_TABLE);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function cpf_exists($key){
        $this->db->where(self::CPF_COLUMN,$key);
        $query = $this->db->get(self::DB_TABLE);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    function validaCPF($cpf = null) {
     
        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
     
        // Elimina possivel mascara
        $cpf = preg_match('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
         
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
             
            for ($t = 9; $t < 11; $t++) {
                 
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
    }


public function get(int $id){
    $this->db->where(self::ID_COLUMN, $id);
    $row = $this->db->get(self::DB_TABLE)->row();
    return $row;
}

public function insert($parecerista){
    return $this->db->insert(self::DB_TABLE, $parecerista);
}

public function update($id, $parecerista){
    $this->db->where(self::ID_COLUMN, $id);
    return $this->db->update(self::DB_TABLE, $parecerista);
}

public function delete($id, $parecerista){
    $this->db->where(self::ID_COLUMN, $id);
    return $this->db->delete(self::DB_TABLE);
}

public function list_all(){
    return $this->db->get(self::DB_TABLE)->result();
}

public function num_rows($filtros = array()){
    if(isset($filtros[self::NOME_COLUMN]) && $filtros[self::NOME_COLUMN] != ''){
        $this->db->like(self::DB_TABLE.'.'.self::NOME_COLUMN, $filtros[self::NOME_COLUMN]);
    }
    return $this->db->get(self::DB_TABLE)->num_rows();
}

public function cadastraParecerista($dados, $eixos){
    $this->db->insert(self::DB_TABLE,$dados);
    if($insert_id = $this->db->insert_id())
    {
        $this->load->model('Log_model', 'log_model');
        $this->log_model->insert_parecerista('Parecerista cadastrado com sucesso.', $insert_id);
        $par_eixo['id_parecerista'] = $insert_id;

        foreach ($eixos as $eixo) {
            $par_eixo['id_eixo'] = $eixo;
            $this->db->insert(self::DB_RELATION,$par_eixo);
        }
        return true;
    }
    else return false;
}

public function num_rows_listar_analisar($filtros = array(), $all, $inicio = 0){
    if(!isset($filtros['attribute'])){
        $filtros['attribute'] = 'nome';
    } 
    if(!isset($filtros['order_by'])){
        $filtros['order_by'] = 'ASC';
    }
    if(!isset($filtros['quantidade'])){
        $filtros['quantidade'] = 10;
    }

    $this->db->order_by($filtros['attribute'], $filtros['order_by']);
    $this->db->limit($filtros['quantidade'], $inicio);

    if(isset($filtros[self::NOME_COLUMN]) && $filtros[self::NOME_COLUMN] != ''){
        $this->db->like(self::DB_TABLE.".".self::NOME_COLUMN, $filtros['nome']);
    }
    $this->db->query("SELECT * FROM parecerista_eixo
        INNER JOIN parecerista ON parecerista.id = parecerista_eixo.id_parecerista
        INNER JOIN eixo ON eixo.id = parecerista_eixo.id_eixo");
    if(!$all){
        $this->db->where('status_inscricao', 0);
    }
    return $this->db->get(self::DB_TABLE)->num_rows();
}

public function list_filter_analisar($filtros = array(), $all, $inicio = 0){
    if(!isset($filtros['attribute'])){
        $filtros['attribute'] = 'nome';
    } 
    if(!isset($filtros['order_by'])){
        $filtros['order_by'] = 'ASC';
    }
    if(!isset($filtros['quantidade'])){
        $filtros['quantidade'] = 10;
    }
    $this->db->order_by($filtros['attribute'], $filtros['order_by']);
    $this->db->limit($filtros['quantidade'], $inicio);

    if(isset($filtros[self::NOME_COLUMN]) && $filtros[self::NOME_COLUMN] != ''){
        $this->db->like(self::DB_TABLE.".".self::NOME_COLUMN, $filtros['nome']);
    }
    // $this->db->select("parecerista.*, parecerista_eixo.*, eixo.nome as nome_eixo");
    // $this->db->join('parecerista', 'parecerista_eixo.id_parecerista = parecerista.id', 'inner');
    // $this->db->join('eixo', 'parecerista_eixo.id_eixo = eixo.id', 'inner');
    // if(!$all){
    //     $this->db->where('parecerista.status_inscricao', 0);
    // }
    // $results = $this->db->get('parecerista_eixo')->result();
    if(!$all){
        $this->db->where('parecerista.status_inscricao', 0);
    }

    $results = $this->db->get('parecerista')->result();

    return $results;
}

public function get_eixos_parecerista($id_parecerista){
    $this->db->select('eixo.nome');
    $this->db->where('id_parecerista', $id_parecerista);
    $this->db->join('eixo', 'parecerista_eixo.id_eixo = eixo.id', 'inner');
    return $this->db->get('parecerista_eixo')->result();
}

}