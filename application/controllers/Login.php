<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper('frontend_helper'); 
		$this->load->model('Login_model', 'model');
    $this->load->model('Log_model', 'log_model');
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

public function forgot_password(){
	$data['mensagens'] = mensagens();

	$this->load->view('header');
	$this->load->view('forgot-password', $data);
	$this->load->view('footer');
}

public function esqueci_senha(){

	$this->load->library('form_validation');
	$this->form_validation->set_rules('email',
		'E-mail',
		'required|valid_email' 
	);
	$this->form_validation->set_rules('cpf',
		'CPF',
		'required',
		'min_length[12]',
		'max_length[20]'
	);

	$email = $this->input->post('email');
	$cpf = $this->input->post('cpf');

	if(!$this->form_validation->run()){
		$this->session->set_flashdata('danger', validation_errors());
		$this->forgot_password();
        }else{ //porque deu certo:
        	$resposta = $this->verificaEmailECpf($email, $cpf);
            if($resposta == NULL){ //combinação inválida!
            	$this->session->set_flashdata('danger', 'Combinação inválida entre e-mail e cpf.');

            }
            else{ //devemos enviar e-mail e dar a mensagem
                //enviador de e-mail
             $id = $resposta->id;



             $date = strtotime(date("Y-m-d H:i:s"));
             $date = md5($date);
             $date = substr($date, 0, 8);

             $senha = $this->crypt($date);

             $this->model->atualizaSenha($resposta->id, $senha);
             $message = '';
             $message.= '<h1>CONGRESSO: PEDAGOGIA HISTÓRICO-CRÍTICA</h1>';
             $message.= '<h2>Fique tranquilo, é comum esquecer a senha! Por isso fizemos este recurso pra você!</h2>';
             $message.= '<p style="font-size:12pt;">Sua <strong>nova</strong> senha é:'.$date.'</p>';
             $message.= '<br>';
             $message.= '<a href="'.base_url('Login').'" target="_blank">CLIQUE AQUI PARA IR DE VOLTA PARA O CONGRESSO</a>';

                // $config = Array(
                //     'protocol' => 'smtp',
                //     'smtp_host' => 'ssl://smtp.googlemail.com',
                //     'smtp_port' => 465,
                //     'smtp_user' => self::EMAIL,// your mail name
                //     'smtp_pass' => self::SENHA,
                //     'mailtype'  => 'html', 
                //     'charset'   => 'iso-8859-1',
                //     'wordwrap' => TRUE
                // );
                // $this->load->library('email', $config);
                // $this->email->from(self::EMAIL, self::NOME);//your mail address and name
                // $this->email->to($email); //receiver mail

                // $this->email->subject(self::SUBJECT);
                // $this->email->message($message);

                // if(!$this->email->send()){
                //     //$this->session->set_flashdata('danger', htmlspecialchars($this->email->print_debugger()));  
                //     $this->session->set_flashdata('danger', $message);  
                //     // print_r($this->email->print_debugger(), true);
                //     // exit();
                // }

             $title = 'Recuperar Senha - Congresso';
             $resposta = $this->send_email_with_title($title,$message, $email);

             if($resposta == 'true'){
              $this->log_model->insert('Foi enviado o e-mail de esqueci minha senha para o participante.', $id);
        
              $this->session->set_flashdata('success', 'Fique tranquilo é comum esquecer a senha!<br>Enviamos um e-mail para <strong>'.$email.'</strong> com a sua nova senha.');  
            }
            else{
              $this->log_model->insert('Houve um erro no envio do e-mail para o participante.', $id);
              $this->session->set_flashdata('danger', htmlspecialchars($resposta));  

            }


          }
          $this->forgot_password();
        }
      }

      public function send_email_to_admin($message){

       $config = Array(
        'useragent' => 'CodeIgniter',
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'smtp_timeout' => 5,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,

                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                  );

       $this->load->library('email', $config);
                $this->email->from(EMAIL, 'Mensagem Enviada Através do Painel');//your mail address and name
                $this->email->to(EMAIL_ADMIN); //receiver mail

                $this->email->subject('Mensagem Enviada Através do Painel');
                $this->email->message($message);

                if(!$this->email->send()){
                    //$this->session->set_flashdata('danger', htmlspecialchars($this->email->print_debugger()));  
                	return $this->email->print_debugger();
                    // print_r($this->email->print_debugger(), true);
                    // exit();
                }
                

                else{
                  $this->log_model->insert_email('Mensagem Enviada Através do Painel', $email);
                  return true;
                }
              }



              public function send_email($message, $email){
               $title = 'Congresso: Pedagogia Histórico-Crítica';
               $config = Array(
                'useragent' => 'CodeIgniter',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'smtp_timeout' => 5,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,

                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                  );


               $html = '';
               $html.= '<!DOCTYPE html><html>';
               $html.= $message;
               $html.= '</html>';

               $message = $html;

               $title = 'Congresso PHC 2018';

               $this->load->library('email', $config);
                $this->email->from(EMAIL, $title);//your mail address and name
                $this->email->to($email); //receiver mail

                $this->email->subject($title);
                $this->email->message($message);

                if(!$this->email->send()){
                    //$this->session->set_flashdata('danger', htmlspecialchars($this->email->print_debugger()));  
                	return $this->email->print_debugger();
                    // print_r($this->email->print_debugger(), true);
                    // exit();
                }

                else{
                  $this->log_model->insert_email('Confirmar Email', $email);

                  return true;
                }
              }


              public function send_email_with_title($title, $message, $email){

               $config = Array(
                'useragent' => 'CodeIgniter',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'smtp_timeout' => 5,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,

                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                  );

               $html = '';
               $html.= '<!DOCTYPE html><html>';
               $html.= $message;
               $html.= '</html>';

               $message = $html;

               $this->load->library('email', $config);
                $this->email->from(EMAIL, $title);//your mail address and name
                $this->email->to($email); //receiver mail

                $this->email->subject($title);
                $this->email->message($message);

                if(!$this->email->send()){
                    //$this->session->set_flashdata('danger', htmlspecialchars($this->email->print_debugger()));  
                	return $this->email->print_debugger();
                    // print_r($this->email->print_debugger(), true);
                    // exit();
                }
               

                else {
                   $this->log_model->insert_email($title, $email);
                   return true;
                }
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
	 		}else if($resposta == 'Parecerista')
      {
        redirect(base_url('Parecerista'));
      }

      else{
       $this->index();
     }
   }
 }

 private function verificaEmailECpf($email, $cpf){
   return $this->model->verificaEmailECpf($email, $cpf);
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
      		$nome = explode(" ", $usuario->nome);
      		$primeiro_nome = $nome[0];
      		$usuario->primeiro_nome = $primeiro_nome;


      		if($usuario->ativo == 0){
      			$this->session->set_flashdata('danger', 'Você ainda não <strong>ativou</strong> seu e-mail.<br>Caso não tenha recebido o e-mail de confirmação, entre em contato com a organização ou <br> <a target="_blank" href="'.base_url('home/reenviarEmailAtivacao/'.$usuario->id).'">CLIQUE AQUI PARA REENVIAR E-MAIL DE ATIVAÇÃO</a>.');
      			return FALSE;
      		}else{
           $this->log_model->insert('O participante efetuou o login.', $usuario->id);

           $this->session->set_userdata(
            'usuario', 
            $usuario
          );
           return 'Participante';
         }


       }else{
        $passwordHash = $this->model->getPasswordHashFromAdministrador($email);
        if($email && password_verify($password, $passwordHash)){
         $usuario = $this->model->getAdministrador($email);
         $usuario->tipo_usuario = 'Administrador';

         $this->log_model->insert_admin('O Administrador efetuou o login.', $usuario->id);

         $this->session->set_userdata(
          'usuario', 
          $usuario
        );
         return 'Administrador';
       }else{

         $passwordHash = $this->model->getPasswordHashFromParecerista($email);
         if($email && password_verify($password, $passwordHash)){
          $usuario = $this->model->getParecerista($email);
          $usuario->tipo_usuario = 'Parecerista';

          if($usuario->status_inscricao == 1)
          {
            $this->log_model->insert_parecerista('O parecerista efetuou o login.', $usuario->id);
            $this->session->set_userdata(
              'usuario', 
              $usuario
            );
            return 'Parecerista';
          }else if($usuario->status_inscricao == 2){
            $this->session->set_flashdata('danger', 'Seu cadastro foi reprovado, entre em contato com a organização para mais informações');
            return FALSE;
          }else{
            $this->session->set_flashdata('danger', 'Seu cadastro ainda não foi aprovado por um administrador');
            return FALSE;
          }

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
  }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean Verdadeiro caso logado.
     */
    private function isLogged(){
    	return $this->session->has_userdata('usuario');
    }

    public function crypt ($password){
    	$options = ['cost' => 12];
    	$password = password_hash($password, PASSWORD_DEFAULT, $options);
    	return $password; 
    }

    public function logout(){
     $this->log_model->insert('O participante saiu do painel.', $this->session->userdata('usuario')->id);
     $this->session->sess_destroy();
     redirect('Login');
   }

 }
