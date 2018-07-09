<?php defined('BASEPATH') OR exit('No direct script access allowed');
function minicursoInArray($array, $elem, $std = "id_minicurso"){
	for ($i=0; $i<count($array); $i++) {		
		if($array[$i]->$std == $elem)
			return true;
	}
	return false;
}
?>