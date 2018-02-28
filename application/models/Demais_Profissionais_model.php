<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Demais_Profissionais_model extends CI_Model{ 


    public function insert($dados){
        if($this->db->insert('demais_profissionais',$dados)){
        	return TRUE;
        }else{
        	return FALSE;
        }
    }




}