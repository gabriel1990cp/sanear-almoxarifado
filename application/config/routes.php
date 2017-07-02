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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#USUARIOS
$route['usuarios']	         	   	          = 'usuario/index';
$route['usuarios/(:any)']		   	          = 'usuario/index/$1';
$route['cadastrar-usuario']			          = 'usuario/create_user';
$route['consultar-usuario']			          = 'usuario/search/';
$route['deletar-usuario/(:any)']	          = 'usuario/delete/$1';
$route['editar-usuario/(:any)']	              = 'usuario/edit/$1';
$route['visualizar-usuario/(:any)']	          = 'usuario/view/$1';

#FUNCIONARIOS
$route['funcionarios']	         	   	      = 'funcionario/index';
$route['funcionarios/(:any)']		   	      = 'funcionario/index/$1';
$route['cadastrar-funcionario']			      = 'funcionario/create_employee';
$route['consultar-funcionario']			      = 'funcionario/search/';
$route['deletar-funcionario/(:any)']	      = 'funcionario/delete/$1';
$route['editar-funcionario/(:any)']	          = 'funcionario/edit/$1';
$route['visualizar-funcionario/(:any)']	      = 'funcionario/view/$1';

#EQUIPES
$route['equipes']	         	   	          = 'equipe/index';
$route['equipes/(:any)']		   	          = 'equipe/index/$1';
$route['cadastrar-equipe']			          = 'equipe/create_team';
$route['consultar-equipe']			          = 'equipe/search/';
$route['deletar-equipe/(:any)']	              = 'equipe/delete/$1';
$route['editar-equipe/(:any)']	              = 'equipe/edit/$1';
$route['gerenciar-equipe/(:any)']	          = 'equipe/manager_team/$1';


#ESTOQUE
$route['estoque-entrada']	         	   	  = 'estoque/create_stock';


