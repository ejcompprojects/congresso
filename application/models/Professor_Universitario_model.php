<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Professor_Universitario_model extends CI_Model{ 


    public function insert($dados){
        if($this->db->insert('professor_universitario',$dados)){
        	return TRUE;
        }else{
        	return FALSE;
        }
    }




} 