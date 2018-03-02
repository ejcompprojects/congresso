<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Admin.php');


class Participante extends Admin {
    public function __construct(){
        parent::__construct();
        $this->load->helper('frontend_helper'); 
        $this->load->helper('modalform_helper'); 
        $this->load->model('Participante_model', 'participante_model');

    }

    /**
     * Função que retorna o HTML padrão do controller
     */
    public function listar_pagamento_analisar($attribute = 'nome', $order_by = 'ASC', $quantidade = 10, $nome = '0', $inicio = 0){
        $this->load->library('pagination');
        $funcao = 'listar_pagamento_analisar';
        $filtros = array();
        if(count($this->input->post()) != 0){ //se houve form.submit()


            $filtros['attribute'] = $this->input->post('attribute');
            $filtros['order_by'] = $this->input->post('order_by');
            $filtros['quantidade'] = $this->input->post('quantidade');
            $filtros['nome'] = $this->input->post('search_by');

            if($filtros['attribute'] == '') $attribute = 'nome';
            else $attribute = $filtros['attribute'];

            if($filtros['order_by'] == '') $order_by = 'ASC';
            else$order_by = $filtros['order_by'];

            if($filtros['quantidade'] == '') $quantidade = 10;
            else $quantidade = $filtros['quantidade'];


            if($filtros['nome'] == '') $nome = '0';
            else $nome = $filtros['nome'];
        }
        else{
            $filtros['attribute'] = $attribute;
            $filtros['order_by'] = $order_by;
            $filtros['quantidade'] = $quantidade;
            if($nome != '0') $filtros['nome'] = $nome;
        }

        $num_rows = $this->participante_model->num_rows_listar_pagamento_analisar($filtros);

        $config['base_url'] = base_url('Participante/'.$funcao.'/'.$attribute.'/'.$order_by.'/'.$quantidade.'/'.$nome.'/');
        $config['total_rows'] = $num_rows; 
        $config['per_page'] = $filtros['quantidade']; 
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['first_link'] = FALSE; 
        $config['last_link'] = FALSE; 
        $config['first_tag_open'] = "<li>";
        $config['first_tar_close'] = "</li>";
        $config['prev_link'] = "Anterior";
        $config['prev_tag_open'] = "<li class='prev'>";
        $config['prev_tag_close'] = "</li>";
        $config['next_link'] = "Proximo";
        $config['next_tag_open'] = "<li class='next'>";
        $config['next_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";
        $config['num_links'] = 3; 

        $qtde = $config['per_page'];
        //($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0; 

        $this->pagination->initialize($config);

        
        //$dados['noticias'] = $this->modelnoticias->listar_noticias_paginadas($qtde, $inicio)->result(); 


        if(isset($filtros['attribute'])){
            if($filtros['attribute'] == 'nome') $filtros_verbose['attribute'] = 'Nome';
            else if($filtros['attribute'] == 'data') $filtros_verbose['attribute'] = 'Data de Registro';

        }
        if(isset($filtros['order_by'])){
            if($filtros['order_by'] == 'ASC') $filtros_verbose['order_by'] = 'Do menor para o maior';
            else if($filtros['order_by'] == 'DESC') $filtros_verbose['order_by'] = 'Do maior para o menor';
        }

        $dados['titulo'] = 'Participantes Para Analisar o Pagamento';
        $dados['participantes'] = $this->participante_model->list_filter_pagamento_analisar($filtros, $inicio); 
        $dados['paginacao'] = $this->pagination->create_links();
        $dados['filtros'] = $filtros;
        $dados['filtros_verbose'] = $filtros_verbose;
        $dados['quantidade'] = $num_rows;
        $dados['mensagens'] = mensagens();

        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('listar-participantes', $dados);
        $this->load->view('footer-admin');
    }



    public function listar_trabalho_analisar($attribute = 'nome', $order_by = 'ASC', $quantidade = 10, $nome = '0', $inicio = 0){
        $this->load->library('pagination');
        $funcao = 'listar_trabalho_analisar';
        $filtros = array();
        if(count($this->input->post()) != 0){ //se houve form.submit()


            $filtros['attribute'] = $this->input->post('attribute');
            $filtros['order_by'] = $this->input->post('order_by');
            $filtros['quantidade'] = $this->input->post('quantidade');
            $filtros['nome'] = $this->input->post('search_by');

            if($filtros['attribute'] == '') $attribute = 'nome';
            else $attribute = $filtros['attribute'];

            if($filtros['order_by'] == '') $order_by = 'ASC';
            else$order_by = $filtros['order_by'];

            if($filtros['quantidade'] == '') $quantidade = 10;
            else $quantidade = $filtros['quantidade'];


            if($filtros['nome'] == '') $nome = '0';
            else $nome = $filtros['nome'];
        }
        else{
            $filtros['attribute'] = $attribute;
            $filtros['order_by'] = $order_by;
            $filtros['quantidade'] = $quantidade;
            if($nome != '0') $filtros['nome'] = $nome;
        }

        $num_rows = $this->participante_model->num_rows_listar_trabalho_analisar($filtros);

        $config['base_url'] = base_url('Participante/'.$funcao.'/'.$attribute.'/'.$order_by.'/'.$quantidade.'/'.$nome.'/');
        $config['total_rows'] = $num_rows; 
        $config['per_page'] = $filtros['quantidade']; 
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['first_link'] = FALSE; 
        $config['last_link'] = FALSE; 
        $config['first_tag_open'] = "<li>";
        $config['first_tar_close'] = "</li>";
        $config['prev_link'] = "Anterior";
        $config['prev_tag_open'] = "<li class='prev'>";
        $config['prev_tag_close'] = "</li>";
        $config['next_link'] = "Proximo";
        $config['next_tag_open'] = "<li class='next'>";
        $config['next_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";
        $config['num_links'] = 3; 

        $qtde = $config['per_page'];
        //($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0; 

        $this->pagination->initialize($config);

        
        //$dados['noticias'] = $this->modelnoticias->listar_noticias_paginadas($qtde, $inicio)->result(); 


        if(isset($filtros['attribute'])){
            if($filtros['attribute'] == 'nome') $filtros_verbose['attribute'] = 'Nome';
            else if($filtros['attribute'] == 'data') $filtros_verbose['attribute'] = 'Data de Registro';

        }
        if(isset($filtros['order_by'])){
            if($filtros['order_by'] == 'ASC') $filtros_verbose['order_by'] = 'Do menor para o maior';
            else if($filtros['order_by'] == 'DESC') $filtros_verbose['order_by'] = 'Do maior para o menor';
        }

        $dados['titulo'] = 'Participantes Para Analisar o Trabalho';
        $dados['participantes'] = $this->participante_model->list_filter_trabalho_analisar($filtros, $inicio); 
        $dados['paginacao'] = $this->pagination->create_links();
        $dados['filtros'] = $filtros;
        $dados['filtros_verbose'] = $filtros_verbose;
        $dados['quantidade'] = $num_rows;
        $dados['funcao'] = $funcao;
        $dados['mensagens'] = mensagens();

        $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('listar-participantes', $dados);
        $this->load->view('footer-admin');
    }

    public function recusar_comprovante_pagamento($id){
        $this->db->where('id', $id);
        $dados['status_inscricao'] = 2;
        $resposta = $this->db->update('participante', $dados);

        $this->db->where('id', $id);
        $this->db->select('nome');
        $usuario = $this->db->get('participante')->row();

        if($resposta){
           $this->session->set_flashdata('success', 'Comprovante de pagamento do '.$usuario->nome.' <strong>recusado</strong> com sucesso!');

       }
       else{
           $this->session->set_flashdata('danger', 'Erro ao processar a requisição, por favor tente novamente mais tarde.');

       }
       redirect(base_url('Participante/listar_pagamento_analisar'));
   }

   public function confirmar_comprovante_pagamento($id){
     $this->db->where('id', $id);
     $dados['status_inscricao'] = 1;
     $resposta = $this->db->update('participante', $dados);

     $this->db->where('id', $id);
     $this->db->select('nome');
     $usuario = $this->db->get('participante')->row();


     if($resposta){
       $this->session->set_flashdata('success', 'Comprovante de pagamento do '.$usuario->nome.' <strong>confirmado</strong> com sucesso!');

   }
   else{
       $this->session->set_flashdata('danger', 'Erro ao processar a requisição, por favor tente novamente mais tarde.');

   }
   redirect(base_url('Participante/listar_pagamento_analisar'));

}





}