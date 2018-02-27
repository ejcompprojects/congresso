<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
	if($input['type'] == "input_text") 		return(form_input($input['attr']));
	if($input['type'] == "input_file") 		return(form_upload($input['attr']));
	if($input['type'] == "input_textarea") 	return(form_textarea($input['attr']));
	if($input['type'] == "input_select") 	return(form_dropdown($input['attr'], $input['options'], $input['selected']));
	if($input['type'] == "input_password") return(form_password($input['attr']));
	if($input['type'] == "input_file") return(form_upload($input['attr']));
}