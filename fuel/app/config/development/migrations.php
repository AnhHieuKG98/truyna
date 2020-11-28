<?php
return array (
  'version' => 
  array (
    'app' => 
    array (
      'default' => 
      array (
        0 => '001_create_users',
      ),
    ),
    'module' => 
    array (
      'blog' => 
      array (
        0 => '002_create_blog_posts',
        1 => '003_create_blog_categories',
        2 => '004_create_blog_category_posts',
      ),
    ),
    'package' => 
    array (
    ),
  ),
  'folder' => 'migrations/',
  'table' => 'migration',
  'flush_cache' => false,
);
