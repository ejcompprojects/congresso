<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['Parecerista'] = 'PainelParecerista'; 
$route['Parecerista/Pareceres'] = 'PainelParecerista/Pareceres';
$route['inscricao_parecerista'] = 'home/inscricao_parecerista';
$route['memoria'] = 'home/memoria';
$route['comissao'] = 'home/comissao';
$route['comissao_cientifica'] = 'home/comissao_cientifica';
$route['formatacao'] = 'home/formatacao';
$route['criterios'] = 'home/criterios';
$route['submissao'] = 'home/submissao';
$route['contato'] = 'home/contato';
$route['eixos'] = 'home/eixos';
$route['obras_saviani'] = 'home/obras_saviani';
$route['obras_phc'] = 'home/obras_phc';
$route['inscricao'] = 'home/inscricao';
$route['inscricao_seduc'] = 'home/inscricao_seduc';
$route['historico'] = 'home/historico';
$route['general_info'] = 'home/general_info';
$route['minicurso'] = 'home/minicurso';
$route['manutencao'] = 'home/manutencao';
$route['informacoes_gerais'] = 'home/informacoes_gerais';
$route['informacao_inscricao'] = 'home/informacao_inscricao';
$route['informacao_inscricao_com_submissao'] = 'home/informacao_inscricao_com_submissao';
$route['informacao_inscricao_sem_submissao'] = 'home/informacao_inscricao_sem_submissao';
$route['programacao'] = 'home/programacao';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
