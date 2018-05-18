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
    public function validaCPF($cpf = '') {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
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

    // public function list_all(){
    //     return $this->db->get(self::DB_TABLE)->result();

    // }
    
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


public function list_filter_trabalho_analisar($filtros = array(), $inicio = 0){
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
    $this->db->join('tipo_inscricao', 'tipo_inscricao.id = participante.id_tipo_inscricao', 'INNER');
    $this->db->join('trabalho', 'trabalho.id_participante = participante.id', 'INNER');
    $this->db->join('eixo', 'eixo.id = trabalho.id_eixo', 'INNER'); 
    $this->db->select('tipo_inscricao.tipo as tipo_inscricao, eixo.nome as eixo, trabalho.*, '.self::DB_TABLE . '.*');
    $this->db->where('trabalho.status', 0);
    $this->db->order_by('trabalho.data_registro', 'ASC');
    return $this->db->get(self::DB_TABLE)->result();


}

public function num_rows_listar_trabalho_analisar($filtros = array(), $inicio = 0){
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
$this->db->join('tipo_inscricao', 'tipo_inscricao.id = participante.id_tipo_inscricao', 'INNER');
$this->db->join('trabalho', 'trabalho.id_participante = participante.id', 'INNER');
$this->db->join('eixo', 'eixo.id = trabalho.id_eixo', 'INNER'); 
$this->db->select('tipo_inscricao.tipo as tipo_inscricao, eixo.nome as eixo, trabalho.*, '.self::DB_TABLE . '.*');
$this->db->where('trabalho.status', 0);
$this->db->order_by('trabalho.data_registro', 'ASC');
return $this->db->get(self::DB_TABLE)->num_rows();
}

public function num_rows_todos($filtros = array(), $inicio = 0){
    return count($this->list_all($filtros, $inicio));
    // if(!isset($filtros['attribute'])){
    //     $filtros['attribute'] = 'nome';
    // } 
    // if(!isset($filtros['order_by'])){
    //     $filtros['order_by'] = 'ASC';
    // }
    // if(!isset($filtros['quantidade'])){
    //     $filtros['quantidade'] = 10;
    // }

    // if($filtros['attribute'] == 'vai_submeter_trabalho'){
    //     $this->db->where('submeter_trabalho', 1);
    //     $filtros['attribute'] = 'nome';
    // }else if($filtros['attribute'] == 'nao_vai_submeter_trabalho'){
    //     $this->db->where('submeter_trabalho', 0);
    //     $filtros['attribute'] = 'nome';
    // }

    // if($filtros['attribute'] == 'data_registro'){
    //     $filtros['attribute'] = 'participante.data_registro';
    // }

    // $this->db->order_by($filtros['attribute'], $filtros['order_by']);
    // $this->db->limit($filtros['quantidade'], $inicio);

    // if(isset($filtros[self::NOME_COLUMN]) && $filtros[self::NOME_COLUMN] != ''){
    //     $this->db->like(self::DB_TABLE.".".self::NOME_COLUMN, $filtros['nome']);
    // }

    // if(isset($filtros['tipo_inscricao']) && $filtros['tipo_inscricao'] != ''){
    //     $this->db->where('id_tipo_inscricao', $filtros['tipo_inscricao']);
    // }
    
    // if(isset($filtros['status_inscricao']) && $filtros['status_inscricao'] != '' && $filtros['status_inscricao'] != 3){
    //     $this->db->where('status_inscricao', $filtros['status_inscricao']);
    // }else if(isset($filtros['status_inscricao']) && $filtros['status_inscricao'] == 3){
    //     $this->db->where('foto_comprovante', '');
    // }

    // if(isset($filtros['status_trabalho']) && $filtros['status_trabalho'] != ''){
    //     $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
    //     $this->db->where('trabalho.status', $filtros['status_trabalho']);
    // }

    // $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
    // $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'LEFT');
    // $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'LEFT');
    // $this->db->select('eixo.nome as eixo, tipo_inscricao.tipo as tipo_inscricao, '.self::DB_TABLE . '.*, trabalho.*');
    // return $this->db->get(self::DB_TABLE)->num_rows();
}

public function list_all($filtros = array(), $inicio = 0){
    if(!isset($filtros['attribute'])){
        $filtros['attribute'] = 'nome';
    } 
    if(!isset($filtros['order_by'])){
        $filtros['order_by'] = 'ASC';
    }
    if(!isset($filtros['quantidade'])){
        $filtros['quantidade'] = 10;
    }

    if($filtros['attribute'] == 'vai_submeter_trabalho'){
        $this->db->where('submeter_trabalho', 1);
        $filtros['attribute'] = 'nome';
    }else if($filtros['attribute'] == 'nao_vai_submeter_trabalho'){
        $this->db->where('submeter_trabalho', 0);
        $filtros['attribute'] = 'nome';
    }
    
    if($filtros['attribute'] == 'data_registro'){
        $filtros['attribute'] = 'participante.data_registro';
    }

    $this->db->order_by($filtros['attribute'], $filtros['order_by']);
    $this->db->limit($filtros['quantidade'], $inicio);

    if(isset($filtros[self::NOME_COLUMN]) && $filtros[self::NOME_COLUMN] != ''){
        $this->db->like(self::DB_TABLE.".".self::NOME_COLUMN, $filtros['nome']);
    }

    if(isset($filtros['tipo_inscricao']) && $filtros['tipo_inscricao'] != ''){
        $this->db->where('id_tipo_inscricao', $filtros['tipo_inscricao']);
    }
    
    if(isset($filtros['status_inscricao']) && $filtros['status_inscricao'] != '' && $filtros['status_inscricao'] != 3){
        $this->db->where('status_inscricao', $filtros['status_inscricao']);
    }else if(isset($filtros['status_inscricao']) && $filtros['status_inscricao'] == 3){
        $this->db->where('foto_comprovante', '');
    }

    if(isset($filtros['status_trabalho']) && $filtros['status_trabalho'] != ''){
        //$this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'INNER');
        $this->db->where('trabalho.status', $filtros['status_trabalho']);
    }
    $this->db->join('tipo_inscricao', 'participante.id_tipo_inscricao = tipo_inscricao.id', 'INNER');
    $this->db->join('trabalho', 'participante.id = trabalho.id_participante', 'LEFT');
    $this->db->join('eixo', 'trabalho.id_eixo = eixo.id', 'LEFT');
    $this->db->select('eixo.nome as eixo, eixo.id as id_eixo, tipo_inscricao.tipo as tipo_inscricao, '.self::DB_TABLE . '.*, trabalho.*');
    return $this->db->get(self::DB_TABLE)->result();
}

public function update_dados($id, $status_inscricao, $eixo, $status, $ativo, $submeter_trabalho){

    if($status_inscricao != ''){

        $this->db->where('id', $id);

        $dados['status_inscricao'] = $status_inscricao;

        $this->db->update('participante', $dados);

    }

    if($eixo != '' || $status != ''){

        $this->db->where('id_participante', $id);

        if($eixo != '') $dados1['id_eixo'] = $eixo;

        if($eixo != '') $dados1['status'] = $status;

        $this->db->update('trabalho', $dados1);

    }


    if($ativo != ''){
        $this->db->where('id',$id);
        $dados2['ativo'] = $ativo;

        $this->db->update('participante', $dados2);
    }

    if($submeter_trabalho != ''){
        $this->db->where('id', $id);
        $dados3['submeter_trabalho'] = $submeter_trabalho;

        $this->db->update('participante', $dados3);
    }

    $this->db->where('id', $id);

    $this->db->select('nome');

    return $this->db->get('participante')->row();



}


public function select_participantes($pagamento, $trabalho, $tipo_inscricao){

    if($pagamento != ''){
        switch($pagamento){
            case 'nao_anexou': $this->db->where('foto_comprovante', ''); break;
            case 0: $this->db->where('status_inscricao', 0); break;
            case 1: $this->db->where('status_inscricao', 1); break;
            case 2: $this->db->where('status_inscricao', 2); break;
            case 3: $this->db->where('status_inscricao', 3); break;

        }
    }
    if($trabalho != ''){
        switch($trabalho){
            case 'nao_anexou': $this->db->where('trabalho.id_participante IS NULL'); $this->db->where('participante.submeter_trabalho', 1); break;
            case '0': $this->db->where('trabalho.status', 0); break;
            case '1': $this->db->where('trabalho.status', 1); break;
            case '2': $this->db->where('trabalho.status', 2); break;
            case 'nao_submetera_trabalho': $this->db->where('participante.submeter_trabalho', 0); break;

            $this->db->select('trabalho.*, participante.*');
            $this->db->join('trabalho', ' participante.id = trabalho.id_participante', 'LEFT');
        }
    }else{
        $this->db->select('participante.*');
    }
    if($tipo_inscricao != ''){
     $this->db->where('participante.id_tipo_inscricao', $tipo_inscricao);
 }
 return $this->db->get('participante')->result();
}

public function get_all(){
    $this->db->order_by('nome', 'ASC');
    return $this->db->get('participante')->result();
}

public function update_image($foto, $id){
    $data['foto_comprovante'] = $foto;
        $data['status_inscricao'] = 1; //setamos como pago.
        $this->db->where('id', $id);
        return $this->db->update('participante', $data);
    }
    public function participantes_submeter_trabalho(){
        $this->db->where('submeter_trabalho', 1);
        $this->db->where('status_inscricao !=', 0);
        $this->db->where('status_inscricao !=', 2);
        $this->db->select('participante.id,participante.cpf,participante.nome, participante.email');
        $this->db->order_by('nome', 'ASC');
        return $this->db->get('participante')->result();
    }

    public function get_cpf($id=""){
        if($id != ""){
            $this->db->where('id', $id);
            $this->db->select('cpf');
            return $this->db->get('participante')->row();
        }
    }
}