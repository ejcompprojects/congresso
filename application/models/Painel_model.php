<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Painel_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}


	public function possui_trabalho_anexado($id){
		$this->db->where('id_participante', $id);
		$return = $this->db->get('trabalho')->row();
		if($return == NULL) return false;
		else return true;
	}

	public function status_trabalho($id){
		$this->db->where('id_participante', $id);
		$trabalho = $this->db->get('trabalho')->row();
		return $trabalho->status;
	}

	public function get($id){
		$this->db->where('id', $id);
		return $this->db->get('participante')->row();
	}

	public function update_image($foto, $id){
		$data['foto_comprovante'] = $foto;
		$data['status_inscricao'] = 0;
		$this->db->where('id', $id);
		return $this->db->update('participante', $data);
 	}

 	public function get_eixos(){
 		return $this->db->get('eixo')->result();
 	}

 	public function existe_trabalho($id){
 		$this->db->where('id_participante', $id );
 		$trabalho = $this->db->get('trabalho')->row();
 		if($trabalho == NULL) return false;
 		else return true;
 	}

 	public function update_trabalho($article, $name, $id, $titulo, $eixo){

 		$this->db->where('id_participante', $id);

 		if($name == 'artigo_sem_autor'){
 			$data['arquivo_sem_nome_autor'] = $article;
 		}else{
 			$data['arquivo_com_nome_autor'] = $article;
 		}

 		$data['titulo'] = $titulo;
 		$data['id_eixo']   = $eixo;

 		return $this->db->update('trabalho', $data);
 	}


 	public function insert_trabalho($article, $name, $id, $titulo, $eixo){
 		if($name == 'artigo_sem_autor'){
 			$data['arquivo_sem_nome_autor'] = $article;
 		}else{
 			$data['arquivo_com_nome_autor'] = $article;
 		}
 		$data['id_participante'] = $id;
 		$data['titulo'] = $titulo;
 		$data['id_eixo']   = $eixo;

 		return $this->db->insert('trabalho', $data);

 	}

 	public function get_diferenca_datas($id){
 		$this->db->where('id_participante', $id );
 		$trabalho = $this->db->get('trabalho')->row();
		$data_resposta = $trabalho->data_resposta;
		$data_limite =  date("Y-m-d H:i:s", strtotime("-3 day"));
 		if($data_resposta > $data_limite) return true;
 		else return false;
 	}
}