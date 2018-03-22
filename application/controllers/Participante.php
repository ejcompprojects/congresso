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
        $dados['funcao'] = 'listar_pagamento_analisar';
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

       
    public function recusar_comprovante_pagamento($id){
        $this->db->where('id', $id);
        $dados['status_inscricao'] = 2;
        $resposta = $this->db->update('participante', $dados);

        $this->db->where('id', $id);
        $this->db->select('nome');
        $usuario = $this->db->get('participante')->row();

        if($resposta){
            $this->log_model->insert_admin('O Administrador recusou o comprovante de pagamento do usuário com e-mail: '.$usuario->email, $this->session->userdata('usuario')->id);
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
            $this->log_model->insert_admin('O Administrador aceitou o comprovante de pagamento do usuário com e-mail: '.$usuario->email, $this->session->userdata('usuario')->id);
             $this->session->set_flashdata('success', 'Comprovante de pagamento do '.$usuario->nome.' <strong>aceito</strong> com sucesso!');
            
        }
        else{
             $this->session->set_flashdata('danger', 'Erro ao processar a requisição, por favor tente novamente mais tarde.');

        }
        redirect(base_url('Participante/listar_pagamento_analisar'));

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

            if($filtros['quantidade'] == '') $quantidade = 100;
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
        $dados['funcao'] = $funcao;
        $dados['filtros'] = $filtros;
        $dados['filtros_verbose'] = $filtros_verbose;
        $dados['quantidade'] = $num_rows;
        $dados['mensagens'] = mensagens();

       $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('listar-participantes', $dados);
        $this->load->view('footer-admin');
    }


    public function recusar_trabalho($id){
        $this->db->where('id_participante', $id);
        $dados['status'] = 2;
        $resposta = $this->db->update('trabalho', $dados);

        $this->db->where('id', $id);
        $this->db->select('nome');
        $usuario = $this->db->get('participante')->row();

        if($resposta){
             $this->session->set_flashdata('success', 'Trabalho do '.$usuario->nome.' <strong>recusado</strong> com sucesso!');
            
        }
        else{
             $this->session->set_flashdata('danger', 'Erro ao processar a requisição, por favor tente novamente mais tarde.');

        }
        redirect(base_url('Participante/listar_trabalho_analisar'));
    }

    public function confirmar_trabalho($id){
       $this->db->where('id_participante', $id);
        $dados['status'] = 1;
        $resposta = $this->db->update('trabalho', $dados);

        $this->db->where('id', $id);
        $this->db->select('nome');
        $usuario = $this->db->get('participante')->row();


        if($resposta){
             $this->session->set_flashdata('success', 'Trabalho do '.$usuario->nome.' <strong>aceito</strong> com sucesso!');
            
        }
        else{
             $this->session->set_flashdata('danger', 'Erro ao processar a requisição, por favor tente novamente mais tarde.');

        }
        redirect(base_url('Participante/listar_trabalho_analisar'));

    }


    public function listar_todos($attribute = 'nome', $order_by = 'ASC', $quantidade = 10, $nome = '0', $inicio = 0){
        $this->load->library('pagination');
         $funcao = 'listar_todos';
        $filtros = array();
        if(count($this->input->post()) != 0){ //se houve form.submit()
           

            $filtros['attribute'] = $this->input->post('attribute');
            $filtros['order_by'] = $this->input->post('order_by');
            $filtros['quantidade'] = $this->input->post('quantidade');
            $filtros['nome'] = $this->input->post('search_by');
            $filtros['tipo_inscricao'] = $this->input->post('tipo_inscricao');
            $filtros['status_inscricao'] = $this->input->post('status_inscricao');
            $filtros['status_trabalho'] = $this->input->post('status_trabalho');

            if($filtros['attribute'] == '') $attribute = 'nome';
            else $attribute = $filtros['attribute'];

            if($filtros['order_by'] == '') $order_by = 'ASC';
            else$order_by = $filtros['order_by'];

            if($filtros['quantidade'] == '') $quantidade = 100;
            else $quantidade = $filtros['quantidade'];


            if($filtros['nome'] == '') $nome = '0';
            else $nome = $filtros['nome'];


        }
        else{
            $filtros['attribute'] = $attribute;
            $filtros['order_by'] = $order_by;
            $filtros['quantidade'] = $quantidade;

            // $filtros['tipo_inscricao'] = $tipo_inscricao;
            // $filtros['status_inscricao'] = $status_inscricao;
            // $filtros['status_trabalho'] = $status_trabalho;

            if($nome != '0') $filtros['nome'] = $nome;
        }

        $num_rows = $this->participante_model->num_rows_todos($filtros);

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
            else if($filtros['attribute'] == 'vai_submeter_trabalho') $filtros_verbose['attribute'] = 'Vai Submeter Trabalho';
            else if($filtros['attribute'] == 'nao_vai_submeter_trabalho') $filtros_verbose['attribute'] = 'Não Vai submeter Trabalho';
            else if($filtros['attribute'] == 'data_registro') $filtros_verbose['attribute'] = 'Data de Registro';
            else if($filtros['attribute'] == 'estado') $filtros_verbose['attribute'] = 'Estado';

        }
        if(isset($filtros['order_by'])){
            if($filtros['order_by'] == 'ASC') $filtros_verbose['order_by'] = 'Do menor para o maior';
            else if($filtros['order_by'] == 'DESC') $filtros_verbose['order_by'] = 'Do maior para o menor';
        }
        if(isset($filtros['tipo_inscricao'])){
            if($filtros['tipo_inscricao'] == 1) $filtros_verbose['tipo_inscricao'] = 'Aluno Graduação';
            else if($filtros['tipo_inscricao'] ==  2) $filtros_verbose['tipo_inscricao'] = 'Aluno Pós-Graduação';
            else if($filtros['tipo_inscricao'] ==  3) $filtros_verbose['tipo_inscricao'] = 'Professor Universitário';
            else if($filtros['tipo_inscricao'] ==  4) $filtros_verbose['tipo_inscricao'] = 'Professor Ensino Público';
            else if($filtros['tipo_inscricao'] ==  5) $filtros_verbose['tipo_inscricao'] = 'Demais Profissionais';
        }
        if(isset($filtros['status_inscricao'])){
            if($filtros['status_inscricao'] == 0) $filtros_verbose['status_inscricao'] = 'Em Análise';
            else if($filtros['status_inscricao'] ==  1) $filtros_verbose['status_inscricao'] = 'Pagamento Aprovado';
            else if($filtros['status_inscricao'] ==  2) $filtros_verbose['status_inscricao'] = 'Pagamento Recusado';
            else if($filtros['status_inscricao'] ==  3) $filtros_verbose['status_inscricao'] = 'Não Enviou Comprovante';

        }
        if(isset($filtros['status_trabalho'])){
            if($filtros['status_trabalho'] == 0) $filtros_verbose['status_trabalho'] = 'Em Análise';
            else if($filtros['status_trabalho'] ==  1) $filtros_verbose['status_trabalho'] = 'Trabalho Aprovado';
            else if($filtros['status_trabalho'] ==  2) $filtros_verbose['status_trabalho'] = 'Trabalho Recusado';
        }

        $dados['eixos'] = $this->db->get('eixo')->result();
 
        $dados['titulo'] = 'Listar Participantes';
        $dados['participantes'] = $this->participante_model->list_all($filtros, $inicio); 
        $dados['paginacao'] = $this->pagination->create_links();
        $dados['funcao'] = $funcao;
        $dados['filtros'] = $filtros;
        $dados['filtros_verbose'] = $filtros_verbose;
        $dados['quantidade'] = $num_rows;
        $dados['mensagens'] = mensagens();

       $this->load->view('html-header-admin');
        $this->load->view('header-admin');
        $this->load->view('listar-todos-participantes', $dados);
        $this->load->view('footer-admin');
    }

    public function alterar_dados(){
 
        //print_r($this->input->post());exit();
 

 
        $id = $this->input->post('id');
 
        $status_inscricao = '';
 
        $status_inscricao = $this->input->post('status_inscricao');
 

 
        $eixo = '';
 
        $eixo = $this->input->post('eixo');
 

 
        $status = '';
 
        $status = $this->input->post('status');
 
        $ativo = '';

        $ativo = $this->input->post('ativo');

        $submeter_trabalho = $this->input->post('submeter_trabalho');
 
        // if(isset($status_inscricao) && $status_inscricao == ''){
 
        //     $status_inscricao = $this->input->post('status_inscricao'); 
 
        // }else{
 
        //     $status_inscricao = '';
 
        // }
 
        // if(isset($this->input->post('eixo')) && $this->input->post('eixo') == ''){
 
        //     $eixo = $this->input->post('eixo'); 
 
        // }else{
 
        //     $eixo = '';
 
        // }
 
        // if(isset($this->input->post('status')) && $this->input->post('status') == ''){
 
        //     $status = $this->input->post('status'); 
 
        // }else{
 
        //     $status = '';
 
        // }
 
     
        $usuario = $this->participante_model->update_dados($id, $status_inscricao, $eixo, $status, $ativo, $submeter_trabalho);
 
        $this->log_model->insert_admin('O Administrador alterou os dados do usuário com o nome: '.$usuario->nome, $this->session->userdata('usuario')->id);

 
        $this->session->set_flashdata('success', 'Dados de <strong>'.$usuario->nome.'</strong> alterado com sucesso!');
 

 
        redirect(base_url('Participante/listar_todos'));
 
    }
 

 
}