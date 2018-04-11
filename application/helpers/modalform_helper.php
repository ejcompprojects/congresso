<?php defined('BASEPATH') OR exit('No direct script access allowed');
function modal($modal_id = "",
	$modal_title = "",
	$modal_formaction = "", 
	$modal_formid = "",
	$modal_inputs = array(),
	$modal_enctype = "",
	$modal_images = false){

	$modal_htmlinputs = '';

	foreach($modal_inputs as $input){
		if($input['name'] != 'id'){
			$divini = "<div class=\"form-group\"><label class=\"form-control-label\">". $input['label'] . "</label>";
			$divfim = "</div>";
			$modal_htmlinputs.= $divini.modal_input($input).$divfim;
			
		}
		
	}

	$html = file_get_contents(APPPATH . "/views/modals_html/modal_form.html");
	$html = str_replace("{{modal_id}}"			, $modal_id 		, $html);
	$html = str_replace("{{modal_title}}"		, $modal_title 		, $html);
	$html = str_replace("{{modal_formaction}}"	, $modal_formaction , $html);
	$html = str_replace("{{modal_formid}}"		, $modal_formid 	, $html);
	$html = str_replace("{{modal_inputs}}"		, $modal_htmlinputs , $html);
	$html = str_replace("{{modal_part}}"		, $modal_enctype 	, $html);

	$html = str_replace("{{modal_images}}", $modal_images ? getImage(base_url('uploads/default.jpg')) : "", $html);

	return $html;

}

function modal_input($input){
	if($input['type'] == "input_text") 		
		return(form_input(array('name' => $input['name'], 'id' => $input['name'], 'class' => 'form-control', 'disabled' => TRUE)));

	else if($input['type'] == 'input_file')
		return '<div class=""><a href="" target="_blank" id="'.$input['name'].'" class="btn btn-primary">CLIQUE AQUI PARA ABRIR O TRABALHO</a></div>';
	else if($input['type'] == 'special_select')
		return '<div class=""><select name="'.$input['name'].'" id="'.$input['name'].'" class="form-control"></select></div>';
	// else if($input['type'] == 'special_select')
	// 	return 
}


function modalForm($modal_id = "",
	$modal_title = "",
	$modal_formaction = "", 
	$modal_formid = "",
	$modal_inputs = array(),
	$modal_enctype = "",
	$modal_images = false
)
{
	$modal_htmlinputs = "";

	foreach ($modal_inputs as $inputs => $input) {
		// echo "<pre>";
		// print_r($input);
		// echo "</pre>";
		if(isset($input['label'])){
			$divini = "<div class=\"form-group\"><label class=\"form-control-label\">". $input['label'] . ":</label>";
			$divfim = "</div>";
		}else{
			$divini = "<div class='form-group'>";
		}
		$modal_htmlinputs .= $divini. getInput($input) . $divfim;
	}
	$html = file_get_contents(APPPATH . "/views/modals_html/modal_form.html");
	$html = str_replace("{{modal_id}}"			, $modal_id 		, $html);
	$html = str_replace("{{modal_title}}"		, $modal_title 		, $html);
	$html = str_replace("{{modal_formaction}}"	, $modal_formaction , $html);
	$html = str_replace("{{modal_formid}}"		, $modal_formid 	, $html);
	$html = str_replace("{{modal_inputs}}"		, $modal_htmlinputs , $html);
	$html = str_replace("{{modal_part}}"		, $modal_enctype 	, $html);

	$html = str_replace("{{modal_images}}", $modal_images ? getImage(base_url('uploads/default.jpg')) : "", $html);

	return $html;
}

function getImage($src){
	return "<div class='imageContainer'>
	<div class='image'>
	<img src='$src' width='172' heigth='172' id='userImage'>
	</div>
	<div class='removeImage'>
	<i class='fa fa-minus-circle'></i>
	</div></div>";
}

function getInput($input = array())
{
	if($input['type'] == 'link') return ('<div class=""><a href="" target="_blank" id="'.$input['attr']['id'].'" class="btn btn-primary">CLIQUE AQUI PARA ABRIR O TRABALHO</a></div>');
	if($input['type'] == "input_text") 		return(form_input($input['attr']));
	if($input['type'] == "input_file") 		return(form_upload($input['attr']));
	if($input['type'] == "input_textarea") 	return(form_textarea($input['attr']));
	if($input['type'] == "input_select") 	return(form_dropdown($input['attr'], $input['options'], $input['selected']));
	if($input['type'] == "input_password") return(form_password($input['attr']));
	if($input['type'] == "input_file") return(form_upload($input['attr']));
	if($input['type'] == 'image') return ("<div class='imageContainer'>
		<div class='image'>
		<img src='' width='350' heigth='350' id='".$input['attr']['id']."'>
		</div>
		</div>");
		if($input['type'] == 'select_especial'){
			
			$html = '';
			
			$html = "<div class=\"form-group\">";
			
			$html.= '<select class="form-control round-form" name="'.$input['attr']['name'].'" id="'.$input['attr']['id'].'">';
			
			foreach($input['content'] as $item){
				
				$html.='<option value="'.$item->id.'">'.$item->nome.'</option>';
				
			}
			
			$html.= '</select>';
			
			$html.= '</div>';
			
			return $html;
			
		}

		if($input['type'] == 'select_status_inscricao'){
			
			$html = '';
			
			$html = "<div class=\"form-group\">";
			
			$html.= '<select class="form-control round-form" name="'.$input['attr']['name'].'" id="'.$input['attr']['id'].'">';
			
			$html.= '<option value="0">Em Análise</option>';
			
			$html.= '<option value="1">Aprovado</option>';
			
			$html.= '<option value="2">Reprovado</option>';

			$html.= '<option value="3">Isento</option>';

			$html.= '</select>';
			
			$html.= '</div>';
			
			return $html;
			
		}

		
		if($input['type'] == 'select_status'){
			
			$html = '';
			
			$html = "<div class=\"form-group\">";
			
			$html.= '<select class="form-control round-form" name="'.$input['attr']['name'].'" id="'.$input['attr']['id'].'">';
			
			$html.= '<option value="0">Em Análise</option>';
			
			$html.= '<option value="1">Aprovado</option>';
			
			$html.= '<option value="2">Reprovado</option>';
			
			$html.= '</select>';
			
			$html.= '</div>';
			
			return $html;
			
		}


		if($input['type'] == 'select_booleano'){
			
			$html = '';
			
			$html = "<div class=\"form-group\">";
			
			$html.= '<select class="form-control round-form" name="'.$input['attr']['name'].'" id="'.$input['attr']['id'].'">';
			
			$html.= '<option value="0">Não</option>';
			
			$html.= '<option value="1">Sim</option>';

			$html.= '</select>';
			
			$html.= '</div>';
			
			return $html;
			
		}
		
	}