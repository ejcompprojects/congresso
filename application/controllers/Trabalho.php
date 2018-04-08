<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Admin.php');


class Trabalho extends Admin {
	public function __construct(){
		parent::__construct();
		$this->load->helper('frontend_helper'); 
		$this->load->helper('modalform_helper'); 
		$this->load->model('Trabalho_model', 'trabalho_model');

	}

	public function get_pareceristas($id_eixo){
		$this->db->where('parecerista_eixo.id_eixo', $id_eixo);
		$this->db->join('parecerista_eixo', 'parecerista.id = parecerista_eixo.id_parecerista', 'INNER');
		$this->db->select('nome as label, id as value');
		$pareceristas = $this->db->get('parecerista')->result();

		echo json_encode($pareceristas);
		// $html = '';
		// $html.= '<select name="parecerista" id="parecerista" class="form-control">';
		// $html.='<option value="" disabled="true" readonly selected>Selecione um parecerista</option>';
		// foreach($pareceristas as $parecerista){
		// 	$html.= '<option value="'.$parecerista->id.'">'.$parecerista->nome.'</option>';
		// }
		// $html.= "</select>";
		// echo $html;
	}
	

	public function listar_validados(){
		$status = 1; //1 é status VÁLIDO


		$table_header = array(
			
			array('icon' => 'fa fa-user', 'label' => 'Nome'),
			array('icon' => 'fa fa-book', 'label' => 'Título Trabalho'),
			array('icon' => 'fa fa-user', 'label' => 'Eixo'),
			array('icon' => 'fa fa-user', 'label' => 'Tipo usuário'),
			array('icon' => 'fa fa-user', 'label' => 'Data de Submissão')

		);

		$table_body = array('nome', 'titulo', 'eixo', 'tipo', 'data');


		$data_input_modal = array(
			//array('name' => 'justificativa', 'label' 	=> 'Justificativa', 'type' => 'input_text'),
			array('name' => 'id_eixo', 'label' => '', 'type' => 'hidden'),
			array('name' => 'id', 'label' => 'ID', 'type' => 'input_text'),
			array('name' => 'nome', 'label' 	=> 'Nome','type' 	=> 'input_text'),
			array('name' => 'email', 'label' 	=> 'E-mail', 'type' => 'input_text'),
			array('name' => 'tipo', 'label' 	=> 'Tipo', 'type' => 'input_text'),
			array('name' => 'titulo', 'label' 	=> 'Titulo', 'type' => 'input_text'),
			array('name' => 'eixo', 'label' 	=> 'Eixo', 'type' => 'input_text'),
			array('name' => 'data', 'label' 	=> 'Data', 'type' => 'input_text'),
			array('name' => 'arquivo_sem_nome_autor', 'label' 	=> 'Arquivo Sem Nome Autor', 'type' => 'input_file'),
			array('name' => 'arquivo_com_nome_autor', 'label' 	=> 'Arquivo Com Nome Autor', 'type' => 'input_file'),
			array('name' => 'pareceristas', 'label' => 'Selecione o parecerista', 'type' => 'special_select', 'url' => ''.base_url('Trabalho/get_pareceristas/'), 'id' => 'id_eixo')
			

		);

		

		$objects = $this->trabalho_model->get_all_where_status($status);


		//converter a data para PT-BR
		for($i = 0 ; $i < count($objects); $i++){
			$objects[$i]['data'] = date('d/m/Y H:i:s', strtotime($objects[$i]['data']));
			//$objects[$i]['pareceristas'] = $this->get_pareceristas($objects[$i]['id_eixo']);
		}
		// print_r($objects); exit();

		$dados['table_header'] 		= $table_header;
		$dados['table_body']	 	= $table_body;
		$dados['objects'] 			= $objects;
		$dados['data_input_modal']  = $data_input_modal;


		$dados['funcao'] 			= 'listar_validados';
		$dados['titulo'] 			= 'Trabalhos Validados';

		$dados['quantidade'] 		= $this->trabalho_model->num_rows_where_status($status);
		$dados['mensagens'] 		= mensagens();
		$dados['url'] = array('aprovar' => base_url('Trabalho/aprovar/'), 'reprovar' => base_url('Trabalho/reprovar/'));

		$this->load->view('html-header-admin');
		$this->load->view('header-admin');
		$this->load->view('listar-trabalhos', $dados);
		$this->load->view('footer-admin');
	}


	public function aprovar($id_participante){
		
		if($this->input->post('pareceristas') != ''){

			$update['status'] = 3;
			$this->db->where('id_participante', $id_participante);
			$this->db->update('trabalho', $update);

			$dados['id_trabalho'] = $id_participante;
			$dados['id_parecerista'] = $this->input->post('pareceristas');

			$this->db->insert('trabalho_parecerista', $dados);

			$this->db->where('id_participante', $id_participante);
			$this->db->select('titulo');
			$trabalho = $this->db->get('trabalho')->row();

			$this->db->where('id',$this->input->post('pareceristas'));
			$parecerista = $this->db->get('parecerista')->row();
			$this->session->set_flashdata('success', 'Trabalho '.$trabalho->nome.' adicionado ao parecerista '.$parecerista->nome.'.');
		}else{
			$this->session->set_flashdata('danger', 'Selecione um parecerista.');
		
		}
			redirect('Trabalho/listar_validados');
	}

}


?>