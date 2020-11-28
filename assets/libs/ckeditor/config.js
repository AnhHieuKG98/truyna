/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
//var theme_path = '../../assets/libs/';
var theme_path = public_path+'assets/libs/';
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
  
  config.filebrowserBrowseUrl = theme_path+'elfinder/elfinder.ckeditor.html'; //elfinder.html   /php/connector.php
	config.removePlugins = '';
	config.removeButtons = '';
  
  /*config.extraPlugins = 'image2';*/
  
  config.language = 'vi';
  
};
