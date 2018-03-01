<?php defined('BASEPATH') OR exit('No direct script access allowed');

function send_email($message, $email){
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
                else return 'true';
}