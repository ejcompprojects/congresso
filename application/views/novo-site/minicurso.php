<?php

require 'importacoes/header.php';
require 'importacoes/menu.php';

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<div class="row" style="margin-bottom: 0px;">
	<div class="col m12 s12 center animate fadeInLeft">
		<p class="intro brandon_t orn">MINICURSOS</p>
	</div>
</div>

<div class="row animate fadeInLeft">
	<p><small>*Clique na imagem para ampliar. <a class="blue-text" href="<?= base_url('assets/img/foldercompleto.jpg') ?>" target="_blank">CLIQUE AQUI para visualizar na íntegra.</a> </p>
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder1.jpg') ?>">
	</div>
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder2.jpg') ?>">
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
					<th class="align_center brandon_n">MANHÃ<br> 
						(08h00 - 11h30)
					</th>
					<td>
						<b>MINICURSO: "Literatura infantil e a Pedagogia Histórico-crítica"<br>
						Convidado:</b> Ângelo Antônio Abrantes (UNESP/Bauru)<br>
						<b>35 vagas</b><br><br>

						<b>MINICURSO: "A prática pedagógica em alfabetização: educação infantil<br>e séries iniciais do Ensino Fundamental"<br>
						Convidado:</b> Meire Cristina dos Santos Dangió (Secretaria Municipal de Educação de Bauru)<br>
						<b>35 vagas</b><br><br>

						<b>MINICURSO: "O ensino escolar na primeira infância"<br>
						Convidado:</b> Giselle Modé Magalhães (UFSCAR)<br>
						<b>35 vagas</b><br><br>

						<b>MINICURSO: "A dinâmica dos processos da avaliação neuropsicológica luriana e suas interfaces com a Pedagogia Histórico-Crítica"<br>
						Convidado:</b> Valeria Benevides; Amably Monari (USP/S.P.)<br>
						<b>35 vagas</b><br>
					</td>
					<th class="align_center"><span style="font-size: 10pt;" class="right_offset">FCT-UNESP</span></th>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<!-- <div class="divider 12u"></div> -->
<!-- 		<div class="12u">
			Mesa Redonda: <strong>"Educação Inclusiva e Pedagogia Histórico-crítica"</strong>
		</div>
		<div class="divider 12u"></div>

		<div class="12u">
			Objetiva-se apresentar estudos e reflexões sobre a educação inclusiva na perspectiva da Pedagogia Histórico-crítica.
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong>Data:</strong> 11/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 13:30 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 16:00
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong> Convidados: </strong><br>Anna Maria Lunardi Padilha<br>Régis Henrique dos Reis Silva
			<div class="divider 12u"></div>
		</div>



		<br><br><br><br>

		<div>
			<div class="12u">
				Mesa Redonda: <strong> “Fundamentos Filosóficos da Pedagogia Histórico-crítica e Políticas educacionais Contemporâneas”</strong>
			</div>
			<div class="divider 12u"></div>

			<div class="12u">
				Apresentar fundamentos filosóficos da Pedagogia Histórico-crítica e as políticas públicas implantadas nos últimos anos, as quais desvalorizam o trabalho educativo e o processo de ensino e aprendizagem
				<div class="divider 12u"></div>
			</div>
			<div class="12u">
				<strong>Data:</strong> 11/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 19:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 22:30
				<div class="divider 12u"></div>
			</div>
			<div class="12u">
				<strong> Convidados: </strong> Marise N. Ramos <br> Tiago Nicola Lavoura
				<div class="divider 12u"></div>
			</div>
		</div>
	-->

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
						<th class="align_center brandon_n">TARDE<br>
						(13h00 - 17h00)</th>
						<td>
							<b>MINICURSO: "Contribuições da Neuropsicologia para a compreensão do desenvolvimento das Funções Psicológicas Superiores e dos problemas de escolarização”<br>
							Convidado:</b>	Silvana Calvo Tuleski (UEM)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: "A alfabetização sob o enfoque histórico-crítico"<br>
							Convidados:</b>	Adriana de Fátima Franco (UEM); Ana Carolina Galvão Marsiglia (UFES)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: "Adolescência, atividade de estudo e formação de conceitos"<br>
							Convidado:</b>	Ricardo Eleutério dos Anjos (UNOESTE)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: "A organização da atividade de ensino pelo professor alfabetizador: contribuição da Teoria Histórico-Cultural"<br>
							Convidado:</b>	Fernando Wolff Mendonça (UEM)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: "Educação Ambiental Histórico-Crítica: uma construção coletiva"<br>
							Convidado:</b> Marília Freitas de Campos Tozzoni-Reis (UNESP/Botucatu); Marcela de Moraes Agudo<br>
							<b>35 lugares</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">FCT-UNESP</span></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- <div>
		<div class="12u">
			Minicurso: <strong> Contribuições da Neuropsicologia para a compreensão do desenvolvimento das Funções Psicológicas Superiores e dos problemas de escolarização</strong>
		</div>
		<div class="divider 12u"></div>

		<div class="12u">
			Apresentar pressupostos da neuropsicologia e as relações com o desenvolvimento das funções psicológicas superiores na compreensão de queixas e problemas escolares
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong>Data:</strong> 12/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 08:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 17:00
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong> Professor: </strong> &nbsp;&nbsp;&nbsp;&nbsp;Silvana Calvo Tuleski<br>
			<div class="divider 12u"></div>
		</div>


	</div>	
	<br><br><br>

	<div>
		<div class="12u">
			Minicurso: <strong> Literatura infantil e a Pedagogia Histórico-crítica</strong>
		</div>
		<div class="divider 12u"></div>

		<div class="12u">
			Apresentar a literatura infantil como elemento fundamental do desenvolvimento humano a partir dos pressupostos da Pedagogia Histórico-crítica
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong>Data:</strong> 12/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 08:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 17:00
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong> Professor: </strong> &nbsp;&nbsp;&nbsp;&nbsp;Angelo Antonio Abrantes<br>
			<div class="divider 12u"></div>
		</div>


	</div>	
	<br><br><br>

	<div>
		<div class="12u">
			Minicurso: <strong> O ensino escolar na primeira infância</strong>
		</div>
		<div class="divider 12u"></div>

		<div class="12u">
			Apresentar elementos teórico-filosóficos do ensino na primeira infância a partir da Psicologia Histórico-cultural
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong>Data:</strong> 12/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 13:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 17:00
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong> Professor: </strong> &nbsp;&nbsp;&nbsp;&nbsp;Giselle Modé Magalhães<br>
			<div class="divider 12u"></div>
		</div>


	</div>
	<br><br><br>

	<div>
		<div class="12u">
			Mesa Redonda: <strong>“Relações entre os Fundamentos Psicológicos da Pedagogia Histórico-crítica e Currículo”</strong>
		</div>
		<div class="divider 12u"></div>

		<div class="12u">
			Apresentar as relações entre os fundamentos psicológicos da Pedagogia Histórico-crítica e as ações de formação docente na elaboração e implantação de currículo escolar na rede municipal de Bauru/S.P.
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong>Data:</strong> 12/07/2018 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inicio:</strong> 19:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Término: </strong> 22:30
			<div class="divider 12u"></div>
		</div>
		<div class="12u">
			<strong> Convidados: </strong> <br>Ligia Marcia Martins <br> Juliana Campregher Pasqualini
			<div class="divider 12u"></div>
		</div>

	</div> -->

	<!-- </div> -->

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
						(08h00 - 11h30)</th>
						<td>
							<b>MINICURSO: “Contribuições da Neuropsicologia para a compreensão do desenvolvimento das Funções Psicológicas Superiores e dos problemas de escolarização”<br>
							Convidado:</b>	Silvana Calvo Tuleski (UEM)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: “A alfabetização sob o enfoque histórico-crítico”<br>
							Convidados:</b>	Ana Carolina Galvão Marsiglia (UFES); Adriana de Fátima Franco (UEM)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: “A organização da atividade de ensino pelo professor alfabetizador: contribuição da Teoria Histórico-Cultural”<br>
							Convidado:</b>	Fernando Wolff Mendonça (UEM)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: “Literatura infantil e a Pedagogia Histórico-crítica”<br>
							Convidado:</b>	Ângelo Antonio Abrantes (UNESP/Bauru)<br>
							<b>35 vagas</b><br><br>

							<b>MINICURSO: "Educação Ambiental Histórico-Crítica: uma construção coletiva"<br>
							Convidado:</b> Marília Freitas de Campos Tozzoni-Reis (UNESP/Botucatu); Marcela de Moraes Agudo<br>
							<b>35 vagas</b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">FCT-UNESP</span></th>
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
