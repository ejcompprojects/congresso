<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	  public function __construct(){
        parent::__construct();
        $this->load->helper('frontend_helper'); 
        $this->load->model('Login_model', 'model');
        if(!$this->isLogged() && 
            get_class($this) != get_class()){
            redirect(base_url('Login'));
            exit();
        }
    }
	public function index(){
		$data['mensagens'] = mensagens();

		$this->load->view('header');
		$this->load->view('login', $data);
		$this->load->view('footer');
	}

	 /**
     * Método responsável por validar os dados inseridos pelo usuário
     * e verificar se a combinação inserida está armazenada no banco
     */
    public function authenticate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'email',
            'Email', 
            'required|valid_email'
        );
        $this->form_validation->set_rules(
            'senha', 
            'Senha', 
            'required|min_length[4]', 
            array('required' => 'Você deve preencher a %s.')
        );

        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('danger', validation_errors());
            $this->index();
        }else{
        	$resposta = $this->authenticateLogin($email, $senha);
            if($resposta == 'Participante'){
                redirect(base_url('Painel'));
            }else if($resposta == 'Administrador'){
            		redirect(base_url('Admin'));
        	    }

           		 else{
                $this->index();
            }
        }
    }


      /**
     * Método responsável por verificar se a senha inserida corresponde
     * ao hash armazenado
     * @param  String $email    Login
     * @param  String $password Senha
     * @return boolean          Retorna verdadeiro caso correspondam.
     */
    private function authenticateLogin($email, $password){
        $passwordHash = $this->model->getPasswordHashFromParticipante($email);
        if($email && password_verify($password, $passwordHash)){
            $usuario = $this->model->getParticipante($email);
            $usuario->tipo_usuario = 'Participante';
            $this->session->set_userdata(
                'usuario', 
                $usuario
            );
            return 'Participante';
        }else{
        	$passwordHash = $this->model->getPasswordHashFromAdministrador($email);
        	if($email && password_verify($password, $passwordHash)){
            $usuario = $this->model->getAdministrador($email);
            $usuario->tipo_usuario = 'Administrador';
            $this->session->set_userdata(
                'usuario', 
                $usuario
            );
            return 'Administrador';
	        }else{

	            $this->session->sess_destroy();           
	            $this->session->set_flashdata(
	                'danger', 
	                'E-mail ou Senha incorretos'
	            );
	            return FALSE;
	        }
    	}
    }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean Verdadeiro caso logado.
     */
    private function isLogged(){
        return $this->session->has_userdata('usuario');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('Login');
    }

}
