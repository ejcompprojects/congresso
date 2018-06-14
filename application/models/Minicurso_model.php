<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Minicurso_model extends CI_Model{
	const DB_TABLE               = "minicurso";
	const DB_RELATION            = "participante_minicurso";
	const ID_COLUMN              = "id";
	const NOME_COLUMN            = "nome";
	const DIA_COLUMN             = "dia";
	const HORA_INI_COLUMN        = "horario_inicio";
	const HORA_FIM_COLUMN        = "horario_fim";
	const LIM_VAGAS_COLUMN       = "limite_vagas";
	const LIM_VAGAS_SEDUC_COLUMN = "limite_vagas_seduc";
	const DESCRICAO_COLUMN       = "descricao";
	const CONVIDADO_COLUMN       = "convidado";

	const NAO_PAGA               = 3;

	public function __construct(){
		parent::__construct();
	}
	public function getAll(){
		$this->db->select(self::ID_COLUMN.", ".self::NOME_COLUMN.", ".self::DIA_COLUMN.", ".self::HORA_INI_COLUMN.", ".self::HORA_FIM_COLUMN.", ".self::LIM_VAGAS_COLUMN.", ".self::DESCRICAO_COLUMN.", ".self::CONVIDADO_COLUMN.", ".self::LIM_VAGAS_SEDUC_COLUMN);
		return $this->db->get(self::DB_TABLE)->result_array();
		/*return $this->db->query("SELECT * FROM ".self::DB_TABLE)->result();*/
	}
	public function vagasRestantes($id_minicurso, $paga){
		if(!($paga==self::NAO_PAGA)){
			$this->db->select(self::LIM_VAGAS_COLUMN." as limite");
			$this->db->where("id", $id_minicurso);
			$not = "NOT";
		}
		else{
			$this->db->select(self::LIM_VAGAS_SEDUC_COLUMN." as limite");
			$this->db->where("id", $id_minicurso);
			$not = "";
		}
		$lim = $this->db->get(self::DB_TABLE)->result();
		
		$preenchidas = $this->db->query("SELECT id_tipo_inscricao FROM participante_minicurso 
			INNER JOIN participante ON participante.id = participante_minicurso.id_participante WHERE ".$not." id_tipo_inscricao  = ".self::NAO_PAGA." AND id_minicurso = ".$id_minicurso)->num_rows();
			/*$this->db->select("id_tipo_inscricao");
			$this->db->from("participante_minicurso");
			$this->db->join("participante", "participante.id = participante_minicurso");
			$this->db->where("id_tipo_inscricao", 3);*/
		$lim = (int) $lim[0]->limite - $preenchidas;
		return $lim;
	}
	public function meusMinicursos($id_usuario, $select = "id_minicurso, dia"){
		//$this->db->from();
		$this->db->select($select);
		$this->db->where("id_participante", $id_usuario);
		$this->db->join("minicurso","participante_minicurso.id_minicurso = minicurso.id");
		return $this->db->get(self::DB_RELATION)->result();
	}
	public function getDia($id_minicurso){
		$this->db->select("dia");
		$this->db->where("id", $id_minicurso);
		return $this->db->get(self::DB_TABLE)->row();
	}
	public function inscricaoMinicurso($id_participante, $id_minicurso){
		$data = array(
			'id_participante' => $id_participante,
			'id_minicurso' => $id_minicurso
		);
		$this->db->insert(self::DB_RELATION, $data);
	}

	public function inscreverMinicurso($id_participante, $id_minicurso){
		$data = array(
			'id_participante' => $id_participante,
			'id_minicurso' => $id_minicurso
		);
		$this->db->insert(self::DB_RELATION, $data);
	}

	public function existsMinicurso($id_minicurso){
		$this->db->where("id", $id_minicurso);
		$this->db->from(self::DB_TABLE);
		return ($this->db->count_all_results());
	}

	public function adicionarMinicurso($data){
		$this->db->insert(self::DB_TABLE, $data);
	}

	public function updateMinicurso($id, $data){
		$this->db->set($data);
		$this->db->where("id", $id);
		$this->db->update(self::DB_TABLE);
	}

	public function deleteMinicurso($id){
		$this->db->where('id', $id);
		$this->db->delete(self::DB_TABLE);
	}

	public function searchMinicurso($id){
		$this->db->where('id', $id);
		return $this->db->get(self::DB_TABLE)->row_array();
	}

	/*public function desinscreverMinicurso($id_participante, $id_minicurso){
		$data = array(
			'id_participante' => $id_participante,
			'id_minicurso' => $id_minicurso
		);
		$this->db->delete(self::DB_RELATION, $data);
	}*/

}