<?php
return array(
	#'_root_'  => 'welcome/index',  // The default route
  #'_404_'   => 'welcome/404',    // The main 404 route

  '_root_'  => 'home/index',  // The default route
  
  
  #'_404_'   => 'welcome/404',    // The main 404 route
  
  '_404_'   => 'frontend/404',    // The main 404 route
  

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

  //Modules 
  'saigon-discovery/cat/(:any)'       => 'discover/cat/$1',
  'saigon-discovery/(:any)'  => 'discover/detail/$1',  // module
  'saigon-discovery'  => 'discover/index',  // module
  
  //admin for modules
  #'admin/(:any)'   => 'admin/$1',    //default
  #'admin/(:any)'   => 'admin/$1',    //default
);
