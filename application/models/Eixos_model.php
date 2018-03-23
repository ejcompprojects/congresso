<?php
class Eixos_model extends CI_Model{
    const DB_TABLE         = "eixo";
    const ID_COLUMN        = "id";
    const NOME_COLUMN      = "nome";

    public function __construct(){
        parent::__construct();
    }

    public function get(int $id){
        $this->db->where(self::ID_COLUMN, $id);
        $row = $this->db->get(self::DB_TABLE)->row();
        return $row;
    }
    public function get_all(){
        return $this->db->get(self::DB_TABLE)->result_array();
    }

    public function insert($eixo){
        return $this->db->insert(self::DB_TABLE, $eixo);
    }

    public function update($id, $eixo){
        $this->db->where(self::ID_COLUMN, $id);
        return $this->db->update(self::DB_TABLE, $eixo);
    }

    public function delete($id, $eixo){
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
}
?>