<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Professor_Publica_model extends CI_Model{ 


    public function insert($dados){
        if($this->db->insert('prof_ensino_publico',$dados)){
        	return TRUE;
        }else{
        	return FALSE;
        }
    }


    public function insertNivel($dados){
    	if($this->db->insert('prof_ensino_publico_nivel',$dados)){
        	return TRUE;
        }else{
        	return FALSE;
        }
    }

} 