	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificado extends CI_Controller {
	protected $dados;
	private $msg;
	private $css;
	private $html;
	private $gerar = false;

	public function __construct(){
		parent::__construct();
		echo "<style>@font-face{font-family:agency fb;font-style:normal;font-weight:400;src:local('Agency FB'),local('AgencyFB-Regular'),url(" . base_url('assets/fonts/Agency_FB.ttf').") format('truetype')}</style>";
		$this->css = "
					body{
					  font-family: 'Agency FB';
					  /*background-color: #404d44;*/
					  background:url('".base_url('assets/img/modelo_certificado.jpg')."') no-repeat;
					  background-image-resolution:300dpi;
					  background-image-resize:6;
					  color: #42584c;
					}
					h1{
					  font-size: 44pt;
					}

					p{
					  font-size: 17pt;
					  text-indent: 30px;
					  text-align: justify;
					  paddin: 8px;
					}
					.banner{
					  	background-color: #fff9d6;
						width: 78%;
						left: 100px;
						position: absolute;
					  	top: 380px;
					  	height: 150px!important;

					}
					div{
					}";
		$this->html = "	<head>
							<title>Certificado</title>
							<style>" . $this->css . "</style>
						</head>
						<body style\"=font-family: 'Agency FB'\">
						<div class=\"banner\">
							<p>{{msg}}</p>
						</div>
					  </body>";
	}
	public function Minicurso(){
		if(!(isset($this->session->usuario->id) &&
			($this->session->usuario->id > 0))) exit("Não logado.");
		$this->load->model('certificado_model', 'model');
		$userId 	= $this->session->usuario->id;
		$minicurso 	= $this->model->getMinicursoByIdParticipante($userId);
		var_dump($minicurso);
		if(count($minicurso)){
			$this->msg 	= " Certificamos que <b>{{nome}}</b> participou do Minicurso
							<b>{{minicurso}}</b> ministrado por <b>{{minicursista}}</b> no
							<b>Congresso “Pedagogia Histórico-crítica: em defesa da
							Escola Pública e Democrática em tempos de projetos de
							‘’escolas sem partidos’’</b>, realizado no dia 13 de Julho,
							das 08h00 às 12h00, totalizando carga horária de 04 horas.";
			$this->msg 	= str_replace("{{nome}}",  			$this->session->usuario->nome, 	$this->msg);
			$this->msg 	= str_replace("{{minicurso}}",		$minicurso[0]->nome, 			$this->msg);
			$this->msg 	= str_replace("{{minicursista}}", 	$minicurso[0]->convidado, 		$this->msg);
			$this->html	= str_replace("{{msg}}", 			$this->msg,						$this->html);
			$this->gerar = true;
		}
		else
		{
			$this->dados['msg'] = "Infelizmente você não esteve presente em nenhum minicurso, então seu certificado de participação em minicurso não pode ser emitido!";
			$this->load->view('certificado/header');
			$this->load->view('certificado/error', $this->dados);
		}
	}
	public function Participacao(){

		if(!(isset($this->session->usuario->id) &&
			($this->session->usuario->id > 0))) exit("Não logado.");
		$this->load->model('certificado_model', 'model');

		$userId 	= $this->session->usuario->id;

		$this->msg 	= " Certificamos que <b>{{nome}}</b> participou do <b>Congresso “Pedagogia
						Histórico-crítica: em defesa da Escola Pública e Democrática
						em tempos de projetos de ‘’escolas sem partidos’’</b>, realizado
						de 11 a 13 de Julho de 2018, totalizando carga horária de 30
						horas.";
		$this->msg 	= str_replace("{{nome}}",  			$this->session->usuario->nome, 	$this->msg);
		$this->html	= str_replace("{{msg}}", 			$this->msg,						$this->html);

		$qtdM 		= $this->model->QuantidadeMinicursos($userId);
		$qtdP 		= $this->model->QuantidadePalestras($userId);
		$qtdF 		= $this->model->QuantidadeFilmes($userId);

		// echo $this->html;
		if(($qtdP >= 2 && $qtdM >= 1) || ($qtdP >= 2 && $qtdF >= 1) || ($qtdP >= 3)){
			$this->gerar = true;
		}
		else {
			$this->dados['msg'] = "Infelizmente você não esteve presente no número mínimo de atividades para que pudesse emitir seu certificado de participaçao no evento!";
			$this->load->view('certificado/header');
			$this->load->view('certificado/error', $this->dados);
		}
	}

	function __destruct(){
		if($this->gerar){
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetDisplayMode('fullpage');
			$pdf->WriteHTML($this->css,1);
			$pdf->WriteHTML($this->html);
			$pdf->Output('certificado-CPHC.pdf','I');
		}
	}

}
