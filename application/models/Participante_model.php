<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Participante_model extends CI_Model{
    const DB_TABLE         = "participante";
    const ID_COLUMN        = "id";
    const NOME_COLUMN      = "nome";
    const DESCRICAO_COLUMN = "descricao";

    public function __construct(){
        parent::__construct();
    }

      function email_exists($key){
        $this->db->where('email',$key);
        $query = $this->db->get('participante');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function cpf_exists($key){
        $this->db->where('cpf',$key);
        $query = $this->db->get('participante');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

  
  
    public function get(int $id){
        $this->db->where(self::ID_COLUMN, $id);
        $row = $this->db->get(self::DB_TABLE)->row();
        return $row;
    }


    public function insert($participante){
        return $this->db->insert(self::DB_TABLE, $participante);
    }

    public function update($id, $participante){
        $this->db->where(self::ID_COLUMN, $id);
        return $this->db->update(self::DB_TABLE, $participante);

    }

    public function delete($id, $participante){
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

 public function cadastraParticipante($dados){
    $this->db->insert('participante',$dados);
    $insert_id = $this->db->insert_id();
    return $insert_id;
}

public function list_filter($filtros = array(), $inicio = 0){
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

 $this->db->select(self::DB_TABLE . '.*');

 return $this->db->get(self::DB_TABLE)->result();


}

public function list_filter_pagamento_analisar($filtros = array(), $inicio = 0){
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
    $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
    $this->db->select('tipo_inscricao.tipo as tipo_inscricao, '.self::DB_TABLE . '.*');
    $this->db->where('status_inscricao', 0);
    $this->db->where("foto_comprovante != ''");
    return $this->db->get(self::DB_TABLE)->result();


}

public function num_rows_listar_pagamento_analisar($filtros = array(), $inicio = 0){
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
$this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
$this->db->select('tipo_inscricao.tipo, '.self::DB_TABLE . '.*');
$this->db->where('status_inscricao', 0);
$this->db->where("foto_comprovante != ''");
return $this->db->get(self::DB_TABLE)->num_rows();
}


}