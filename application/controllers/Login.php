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
              $date = strtotime(date("Y-m-d H:i:s"));
              $date = md5($date);
              $date = substr($date, 0, 8);

              $senha = $this->crypt($date);

              $this->model->atualizaSenha($resposta->id, $senha);

              $message = 'Sua senha é:'.$date.'<br>';

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


              $resposta = $this->send_email($message, $email);

              if($resposta == 'true'){
               $this->session->set_flashdata('success', 'Fique tranquilo é comum esquecer a senha!<br>Enviamos um e-mail para <strong>'.$email.'</strong> com a sua nova senha.');  
             }
             else{
              $this->session->set_flashdata('danger', htmlspecialchars($resposta));  

            }


          }
          $this->forgot_password();
        }
      }

      private function send_email($message, $email){
        define('EMAIL', 'noreply.enejunesp@gmail.com') ;
        define('SENHA', 'En3#JuN3sP1313');
        define('NOME', 'Darlan');
        define('SUBJECT', 'Teste');

        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
                    'smtp_user' => EMAIL,// your mail name
                    'smtp_pass' => SENHA,
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1',
                    'wordwrap' => TRUE
                  );
        $this->load->library('email', $config);
                $this->email->from(EMAIL, NOME);//your mail address and name
                $this->email->to($email); //receiver mail

                $this->email->subject(SUBJECT);
                $this->email->message($message);

                if(!$this->email->send()){
                    //$this->session->set_flashdata('danger', htmlspecialchars($this->email->print_debugger()));  
                  return $this->email->print_debugger();
                    // print_r($this->email->print_debugger(), true);
                    // exit();
                }
                else return true;
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

    private function crypt ($password){
      $options = ['cost' => 12];
      $password = password_hash($password, PASSWORD_DEFAULT, $options);
      return $password; 
    }

    public function logout(){
      $this->session->sess_destroy();
      redirect('Login');
    }

  }
