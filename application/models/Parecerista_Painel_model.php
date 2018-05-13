<?php  defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH."models/Search_filter.php");
require_once(APPPATH.'controllers/Admin.php');
 
class Parecerista_Painel_model extends CI_Model{
    const DB_TABLE            = "trabalho_parecerista";
    const ID_TRABALHO         = "id_trabalho";
    const ID_PARACERISTA      = "id_parecerista";
    const DATE_REGISTRO       = "data_registro";
    const DATE_PARECER        = "data_parecer";
    const STATUS              = "status_parecer";
    const VAR_NOTA            = "nota";
    const ARQ_PARECER         = "arquivo_parecer";
    const IS_ATIVO            = "ativo";
    const IS_PARECER          = "ja_deu_parecer";
    const NAME_COLUMN         = "titulo";
 
    public function __construct(){
      parent::__construct();
    }
 
    public function get(int $id){
      $this->db->where(self::ID_PARACERISTA, $id);
      return $this->db->get(self::DB_TABLE)->row_array();
    }
 
    public function getByName(string $nome){
      $this->db->where(self::NAME_COLUMN, $nome);
      $result = $this->db->get(self::DB_TABLE)->row_array();
      $image  = $this->imageModel->get($row[self::ID_COLUMN]);
      return new Parceiro($result[self::ID_COLUMN],
                          $result[self::NAME_COLUMN],
                          $image,
                          $result[self::SITE_COLUMN]
                         );
    }
 
    public function update($id, $dados){
      $this->db->where(self::ID_TRABALHO, $id);
      return $this->db->update(self::DB_TABLE, $dados);
    }
 
    public function remove(Parceiro $Parceiro){       
      $this->db->where(self::ID_COLUMN, $Parceiro->getID());
      $this->db->delete(self::DB_TABLE);
      if($this->successQuery()){
        $this->log(self::DB_TABLE, Log::DELETE);
          return true;
      }
      return false;
    }
 
    public function list_all(){
        $result = $this->db->get(self::DB_TABLE)->result_array();;
        $Parceiros = array();
        foreach ($result as $key => $value) {
            $image = $this->imageModel->get(self::DB_TABLE, $value[self::ID_COLUMN]);
            $Parceiros[$key] = new Parceiro($value[self::ID_COLUMN],
                                            $value[self::NAME_COLUMN],
                                            $image,
                                            $value[self::SITE_COLUMN]);
        }
        return $Parceiros;
    }
 
    public function num_rows(searchFilter $filter){
         $this->db = $filter->numRows($this->db);
        return $this->db->get(self::DB_TABLE)->num_rows();
    }

    public function num_rows_like(searchFilter $filter){
         $this->db = $filter->numRows($this->db);
        return $this->db->get(self::DB_TABLE)->num_rows();
    }
 
    public function list_filter(searchFilter $filter){
 
        $this->db   = $filter->applyFilter($this->db);
        $this->db->select(self::DB_TABLE . '.*');
        return $this->db->get(self::DB_TABLE)->result_array();

    }
    public function defaultFilter(){
        return new searchFilter(self::DB_TABLE,
                                self::VAR_NOTA,
                                searchFilter::ASCENDANT,
                                0,
                                20,
                                self::VAR_NOTA);
    }

    public function countAll(){
        return $this->db->count_all(self::DB_TABLE);
    }

    public function get_all_where_parecerista($id_parecerista){

        $this->db->select('t.titulo, t.arquivo_sem_nome_autor, tp.data_registro, t.id_eixo, tp.id_trabalho, tp.status_parecer');
        $this->db->order_by('tp.data_registro', 'ASC');
        $this->db->where('tp.id_parecerista', $id_parecerista);
        $this->db->where('tp.status_parecer', 0);
        $this->db->where('tp.ativo', 1);
        $this->db->where('tp.ja_deu_parecer', 0);
        $this->db->join('trabalho t', 't.id_participante = tp.id_trabalho', 'INNER');
        return $this->db->get('trabalho_parecerista tp')->result_array();
    }
    public function get_where_parecerista_eixo($id_parecerista, $eixo){

        $this->db->select('t.titulo, t.arquivo_sem_nome_autor, tp.data_registro, t.id_eixo, tp.id_trabalho, tp.status_parecer');
        $this->db->order_by('tp.data_registro', 'ASC');
        $this->db->where('tp.id_parecerista', $id_parecerista);
        $this->db->where('tp.status_parecer', 0);
        $this->db->where('tp.ativo', 1);
        if($eixo != 0) $this->db->where('t.id_eixo', $eixo);
        $this->db->where('tp.ja_deu_parecer', 0);
        $this->db->join('trabalho t', 't.id_participante = tp.id_trabalho', 'INNER');
        return $this->db->get('trabalho_parecerista tp')->result_array();
    }
    public function get_all_where_eixo_paracer($id_parecerista){

        $this->db->select('e.id, e.nome');
        $this->db->order_by('e.nome', 'ASC');
        $this->db->where('pe.id_parecerista', $id_parecerista);
        $this->db->join('eixo e', 'pe.id_eixo = e.id', 'INNER');
        return $this->db->get('parecerista_eixo pe')->result_array();
    }
    public function get_email_participante_trabalho($id_trabalho)
    {
      $this->db->select('p.email, p.nome');
      $this->db->where('p.id', $id_trabalho);
      return $this->db->get('participante p')->row_array();
    }

    public function update_trabalho($id, $dados){
      $this->db->where("id_trabalho", $id);
      return $this->db->update("trabalho_parecerista", $dados);
    }
}
 
 
?>