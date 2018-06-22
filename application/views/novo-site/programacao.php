<?php

require 'importacoes/header.php';
require 'importacoes/menu.php';

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<div class="row" style="margin-bottom: 0px;">
	<div class="col m12 s12 center animate fadeInLeft">
		<p class="intro brandon_t orn">PROGRAMAÇÃO</p>
	</div>
</div>


<div class="row animate fadeInLeft">
<p><small>*Clique na imagem para ampliar. <a class="blue-text" href="<?= base_url('assets/img/foldercompleto.jpg') ?>" target="_blank">CLIQUE AQUI para visualizar na íntegra.</a> </p>
	
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder2.jpg') ?>">
	</div>
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder1.jpg') ?>">
	</div>
</div>

<div class="row animate fadeInLeft">
	<div class="col m12 s12 center">
		<button class="prog mudacor bt_date brandon_t responsive" style="padding: 5px 10px; border-radius: 3px;" onclick="programacao('#primeiro')">11/07</button>
		<button class="prog bt_date brandon_t responsive" style="padding: 5px 10px; border-radius: 3px;" onclick="programacao('#segundo')">12/07</button>
		<button class="prog bt_date brandon_t responsive" style="padding: 5px 10px; border-radius: 3px;" onclick="programacao('#terceiro')">13/07</button>	
	</div>
</div>

<!-- Primeira tabela -->
<div id="primeiro" class="animate fadeInLeft">
	<div class="12u">		
		<table class="responsive-table striped tw_cent">
			<tbody>
				<tr class="hide-responsive">
					<th style="width: 20%;" class="align_center">PERÍODO</th>
					<th class="align_center">ATIVIDADE</th>
					<th style="width: 20%;" class="align_center">LOCAL</th>
				</tr>
				<tr>
					<th class="align_center brandon_n">TARDE<br>
						(12h40 - 13h50)
					</th>
					<td>
						<b>Credenciamento e retirada do material do congresso<br>
					</td>
				</tr>
				<tr>
					<th class="align_center brandon_n">TARDE<br>
					(14h00 - 14h20)</th>
					<td>
						<b>Apresentação Capoeira</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
				<tr>
					<th class="align_center brandon_n">TARDE<br>
					(14h30 - 16h30)</th>
					<td>
						<b>Mesa: "Educação Inclusiva e Pedagogia Histórico-Crítica</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
				<tr>
					<th class="align_center brandon_n">TARDE<br>
					(14h50 - 18h30)</th>
					<td>
						<b>Exibição do Filme: "A escola toma partido"</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
				<tr>
					<th class="align_center brandon_n">NOITE<br>
					(18h50 - 19h30)</th>
					<td>
						<b>Orquestra de Cordas da Unoeste</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
				<tr>
					<th class="align_center brandon_n">NOITE<br>
					(19h00 - 19h30)</th>
					<td>
						<b>Apresentação de Expressão Artística: Orquestra de Cordas da UNOESTE.</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
				<tr>
					<th class="align_center brandon_n">NOITE<br>
					(19h50 - 22h30)</th>
					<td>
						<b>Mesa: "Fundamentos Filosóficos da Pedagogia.</b>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
				</tr>
			</tbody>
		</table>
	</div>
</div>

	<!-- Segunda tabela -->
	<div id="segundo" class="animate fadeInLeft">
		<div>
			<table class="responsive-table striped tw_cent">
				<tbody>
					<tr class="hide-responsive">
						<th style="width: 20%;" class="align_center">PERÍODO</th>
						<th class="align_center">ATIVIDADE</th>
						<th style="width: 20%;" class="align_center">LOCAL</th>
					</tr>
					<tr>
						<th class="align_center brandon_n">MANHÃ<br> 
						(07h40 - 8h00)</th>
						<td>
							<b>Registro presença; localização das salas.</b>
						</td>
					</tr>
					<tr>
						<th class="align_center brandon_n">MANHÃ<br>
						(07h00 - 12h00)</th>
						<td>
							<b>Apresentação e Comunicação de Trabalhos<br>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">CENTRO UNIVERSITÁRIO<br>(TOLEDO PRUDENTE)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">TARDE<br>
						(14h00 - 14h20)</th>
						<td>
							<b>Apresentação de Balé Livre<br>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">TARDE<br>
						(14h30 - 16h30)</th>
						<td>
							<b>Mesa: "Medicalização da Infância: avanço ou retrocesso"<br>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">TARDE<br>
						(16h50 - 18h30)</th>
						<td>
							<b>Exibição e Debate do filme: "A língua das mariposas"<br>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">SALA DE CINEMA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">NOITE<br>
						(19h00 - 22h30)</th>
						<td>
							<b>Mesa: "Relações entre os Fundamentos Psicólogos da Pedagogia Histórico-crítica e Currículo"<br>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Terceira tabela -->
	<div id="terceiro" class="animate fadeInLeft">
		<div>
			<table class="responsive-table striped tw_cent">
				<tbody>
					<tr class="hide-responsive">
						<th style="width: 20%;" class="align_center">PERÍODO</th>
						<th class="align_center">ATIVIDADE</th>
						<th style="width: 20%;" class="align_center">LOCAL</th>
					</tr>
					<tr>
						<th class="align_center brandon_n">MANHÃ<br>
						(07h40 - 08h00)</th>
						<td>
							<b>Registro de Presença; localização das salas</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">CENTRO UNIVERSITÁRIO<br>(TOLEDO PRUDENTE)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">MANHÃ E TARDE<br>
						<td>
							<b>MINICURSOS</b>
						</td>
					</tr>
					<tr>
						<th class="align_center brandon_n">TARDE<br>
						(14h00 - 16h00)</th>
						<td>
							<b>Mesa BNCC: "Algumas reflexões a partir da Pedagogia Histórico-crítica"</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">TARDE<br>
						(16h30 - 18h00)</th>
						<td>
							<b>Lançamento de Livros - Sessão de Autógrafos</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
					<tr>
						<th class="align_center brandon_n">NOITE<br>
						(19h15 - 19h50)</th>
						<td>
							<b>Avaliação e Balanço do Congresso</b>
						</td>
					</tr>
					<tr>
						<th class="align_center brandon_n">NOITE<br>
						(20h00 - 22h30)</th>
						<td>
							<b>Conferência de Encerramento: "A defesa da escola pública na perspectiva histórico-crítica em tempos de suícidio democrático"</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">TEATRO PAULO ROBERTO LISBOA<br>(CENTRO CULTURAL MATARAZZO)</span></th>
					</tr>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	$(".prog").click(function(){
		$(".prog").removeClass("mudacor")
		$(this).addClass("mudacor")
	})

	$(document).ready(function(){
		$('#segundo').hide();
		$('#terceiro').hide();
	});

	function programacao(div){
		$('#primeiro').hide();
		$('#segundo').hide();
		$('#terceiro').hide();

		$(div).fadeIn('slow');
	}

	$(document).ready(function(){
    $('.materialboxed').materialbox();
  	});
</script>	

<?php require 'importacoes/footer.php'; ?>
