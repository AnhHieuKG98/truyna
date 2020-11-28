<?php
return array(
  'active' => 'default',
  'fallback' => 'default',
  'paths' => array(			// theme files are outside the DOCROOT here
      APPPATH.'..'.DS.'cms'.DS.'themes',
  ),
  'assets_folder' => 'themes',	// so this implies <localpath>/public/themes/<themename>...
  'view_ext' => '.html',
  'info_file_name' => 'themeinfo.ini',
  'require_info_file' => false,
  'use_modules' => true,
);