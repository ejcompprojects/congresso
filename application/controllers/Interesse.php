<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Admin.php');


class Interesse extends Admin {
    public function __construct(){
        parent::__construct();
        $this->load->helper('frontend_helper'); 
        $this->load->helper('modalform_helper'); 
        $this->load->model('Participante_model', 'participante_model');

    }

    public function index(){
    	$dados['mensagens'] = mensagens();
        $this->db->order_by('nome', 'ASC');
    	$minicursos = $this->db->get('minicurso')->result();
    	foreach($minicursos as $minicurso){
    		$this->db->where('id_minicurso', $minicurso->id);
    		$minicurso->quantidade = $this->db->get('participante_interesse_minicurso')->num_rows();
    	}

    	$dados['minicursos'] = $minicursos;
    	$this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('interesse-minicurso', $dados);
        $this->load->view('footer-admin');
    }


}
?>
