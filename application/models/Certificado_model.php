<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Certificado_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

    private function Quantidade(int $id, String $tabela, $is_filme = NULL):int{
        $relacao = "participante_" . $tabela;
        $this->db->select('COUNT(*) as quantidade');
        $this->db->from($tabela);
        $this->db->where($relacao.'.id_participante', $id);
        if($is_filme != NULL) $this->db->where($tabela . '.is_filme', $is_filme);
        $this->db->join($relacao, $tabela . '.id = ' . $relacao . '.id_' . $tabela);

        return (int)$this->db->get()->result()[0]->quantidade;
    }

    public function QuantidadeMinicursos(int $id):int{
        return $this->Quantidade($id, "minicurso", 0);
    }

    public function QuantidadePalestras(int $id):int{
        return $this->Quantidade($id, "palestra");
    }

    public function QuantidadeFilmes(int $id):int{
        return $this->Quantidade($id, "minicurso", 1);
    }
    public function getMinicursoByIdParticipante(int $id):array{
        $tabela     = "minicurso";
        $relacao    = "participante_" . $tabela;
        $this->db->select($tabela . '.nome, ' . $tabela . '.convidado');
        $this->db->from($tabela);
        $this->db->where($relacao.'.id_participante', $id);
        $this->db->where($tabela . '.is_filme', 0);
        $this->db->join($relacao, $tabela . '.id = ' . $relacao . '.id_' . $tabela);

        return $this->db->get()->result();

    }
}

?>