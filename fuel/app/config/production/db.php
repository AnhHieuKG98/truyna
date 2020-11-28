<?php
/**
 * The production database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=truyna',
			'username'   => 'root',
			'password'   => '',
		),
    /* Giang thêm cấu hình khác dựa vào 
    https://fuelphp.com/docs/classes/database/introduction.html
    */
    'table_prefix'   => 'tmi_',
    'charset'        => 'utf8',
    'enable_cache'   => true,
	),
);
