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
        $par_eixo['id_parecerista'] = $insert_id;

        foreach ($eixos as $eixo) {
            $par_eixo['id_eixo'] = $eixo;
            $this->db->insert(self::DB_RELATION,$par_eixo);
        }
        return true;
    }
    else return false;
}
}