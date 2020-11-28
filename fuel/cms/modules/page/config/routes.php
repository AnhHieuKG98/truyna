<?php

return array(
	
  #'_root_'  => 'home/index',  // The default route
  #'_404_'   => 'welcome/404',    // The main 404 route

	#'page(/:slug)?' => array('page/index', 'slug' => ''),
  'page/(:any)'       => 'page/index/$1'
);
