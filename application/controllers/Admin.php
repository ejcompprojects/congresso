<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Login.php');

/**
 * Classe responsável por gerenciar as ações de um administrador
 */
class Admin extends Login {
    public function __construct(){
        parent::__construct();
        $this->load->helper('frontend_helper'); 

    }

    /**
     * Função que retorna o HTML padrão do controller
     */
    public function index(){
        
        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('home');
        $this->load->view('footer-admin');

    }



 
}