<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2018-08-21 04:21:43 --> Error - Module 'setting1' could not be found at 'APPPATH/\..\cms\modules\setting1\' in C:\xampp\htdocs\fu_cms\fuel\core\classes\module.php on line 91
ERROR - 2018-08-21 04:23:06 --> 42S02 - SQLSTATE[42S02]: Base table or view not found: 1146 Table 'fu_cms.fu_posts' doesn't exist with query: "SELECT `fu_t0`.`id` AS `t0_c0`, `fu_t0`.`default` AS `t0_c1`, `fu_t0`.`type` AS `t0_c2`, `fu_t0`.`module` AS `t0_c3`, `fu_t0`.`label` AS `t0_c4`, `fu_t0`.`note` AS `t0_c5`, `fu_t0`.`name` AS `t0_c6`, `fu_t0`.`value` AS `t0_c7` FROM `fu_posts` AS `fu_t0`" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 04:23:16 --> Error - Call to undefined method Orm\Query::as_array() in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\backend.php on line 26
ERROR - 2018-08-21 04:23:27 --> 42S02 - SQLSTATE[42S02]: Base table or view not found: 1146 Table 'fu_cms.fu_posts' doesn't exist with query: "SELECT `fu_t0`.`id` AS `t0_c0`, `fu_t0`.`default` AS `t0_c1`, `fu_t0`.`type` AS `t0_c2`, `fu_t0`.`module` AS `t0_c3`, `fu_t0`.`label` AS `t0_c4`, `fu_t0`.`note` AS `t0_c5`, `fu_t0`.`name` AS `t0_c6`, `fu_t0`.`value` AS `t0_c7` FROM `fu_posts` AS `fu_t0`" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 04:25:05 --> Notice - Undefined variable: settings in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\backend.php on line 28
ERROR - 2018-08-21 04:33:18 --> Error - Call to undefined method Orm\Query::and_where() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 22
ERROR - 2018-08-21 04:34:39 --> Error - Call to undefined method Orm\Query::and_where() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 22
ERROR - 2018-08-21 04:35:20 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 23
ERROR - 2018-08-21 05:04:53 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected ':', expecting ',' or ';' in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 05:05:05 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected ':', expecting ',' or ';' in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 05:05:18 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected ':', expecting ',' or ';' in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 05:05:25 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected ':', expecting ',' or ';' in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 05:08:29 --> Notice - Undefined index: s in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\index.php on line 13
ERROR - 2018-08-21 05:13:45 --> Error - Call to undefined method Fuel\Core\Request::get() in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog.php on line 12
ERROR - 2018-08-21 05:39:02 --> Notice - Undefined variable: current_user in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog.php on line 63
ERROR - 2018-08-21 05:42:02 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 05:59:43 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 06:00:08 --> Runtime Deprecated code usage - Non-static method Helper::create_seo_name() should not be called statically in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog.php on line 84
ERROR - 2018-08-21 06:00:23 --> Runtime Deprecated code usage - Non-static method Helper::create_seo_name() should not be called statically in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog.php on line 84
ERROR - 2018-08-21 06:22:58 --> Notice - Undefined variable: text in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 38
ERROR - 2018-08-21 06:31:59 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 06:32:04 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 06:59:49 --> Notice - Undefined variable: pagination in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 18
ERROR - 2018-08-21 07:00:40 --> Notice - Undefined variable: pagination in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\index.php on line 112
ERROR - 2018-08-21 07:19:50 --> Error - The requested view could not be found: admin/blog/category/_form.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-21 07:20:17 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 07:21:37 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`) VALUES ('Tin thế giới', 'tin-the-gioi', '', '', null, null)" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 07:24:56 --> Notice - Undefined variable: post in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 57
ERROR - 2018-08-21 07:36:06 --> Error - Class 'Model_Blog_Category' not found in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 29
ERROR - 2018-08-21 07:36:15 --> Runtime Deprecated code usage - Non-static method Blog\Model_Blog_Category::fn_get_categories() should not be called statically in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 29
ERROR - 2018-08-21 07:41:13 --> Error - Using $this when not in object context in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 84
ERROR - 2018-08-21 07:41:26 --> Error - Call to undefined function Blog\fn_get_categories() in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 84
ERROR - 2018-08-21 07:46:34 --> Fatal Error - Maximum execution time of 300 seconds exceeded in C:\xampp\htdocs\fu_cms\fuel\packages\orm\classes\model.php on line 1258
ERROR - 2018-08-21 07:46:54 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 92
ERROR - 2018-08-21 07:47:28 --> Notice - Undefined index: category_id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 92
ERROR - 2018-08-21 07:47:34 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 92
ERROR - 2018-08-21 07:49:41 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 93
ERROR - 2018-08-21 07:52:17 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 94
ERROR - 2018-08-21 07:52:52 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 94
ERROR - 2018-08-21 07:53:27 --> Error - syntax error, unexpected '}' in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 95
ERROR - 2018-08-21 07:53:36 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 94
ERROR - 2018-08-21 07:55:26 --> Notice - Undefined index: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 94
ERROR - 2018-08-21 07:55:54 --> Warning - Invalid argument supplied for foreach() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 90
ERROR - 2018-08-21 07:59:04 --> Error - Class 'Blog\DB' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 83
ERROR - 2018-08-21 07:59:32 --> Fatal Error - Allowed memory size of 134217728 bytes exhausted (tried to allocate 380928 bytes) in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 86
ERROR - 2018-08-21 08:00:31 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:04:03 --> Error - Using $this when not in object context in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 91
ERROR - 2018-08-21 08:04:25 --> Notice - Undefined variable: level in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 92
ERROR - 2018-08-21 08:05:25 --> Error - Call to undefined function array_append() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 50
ERROR - 2018-08-21 08:05:56 --> Error - Call to undefined function array_append() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 50
ERROR - 2018-08-21 08:06:03 --> Error - Call to undefined function array_append() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 50
ERROR - 2018-08-21 08:06:15 --> Error - Using $this when not in object context in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 50
ERROR - 2018-08-21 08:06:37 --> Error - Call to undefined function array_append() in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 50
ERROR - 2018-08-21 08:10:50 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:11:28 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:11:52 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 08:11:57 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:12:28 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:12:29 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:13:56 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:14:13 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:14:19 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:15:08 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:15:09 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 18
ERROR - 2018-08-21 08:16:06 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\create.php on line 2
ERROR - 2018-08-21 08:16:26 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\create.php on line 2
ERROR - 2018-08-21 08:18:15 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:18:23 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:19:36 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 08:25:35 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:28:33 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:31:43 --> Notice - Undefined index: frefix in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 98
ERROR - 2018-08-21 08:56:43 --> Error - No partial named "layouts/partials/css_head" can be found in the "css_head" section. in C:\xampp\htdocs\fu_cms\fuel\core\classes\theme.php on line 465
ERROR - 2018-08-21 09:22:17 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:22:30 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:22:32 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:22:37 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:22:39 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:23:11 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:23:13 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:23:19 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:23:23 --> Runtime Recoverable error - Object of class Fuel\Core\Asset_Instance could not be converted to string in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\partials\js_head.html on line 7
ERROR - 2018-08-21 09:40:50 --> Error - Call to undefined method Fuel\Core\Asset_Instance::add_mtime() in C:\xampp\htdocs\fu_cms\fuel\core\classes\asset\instance.php on line 142
ERROR - 2018-08-21 10:10:41 --> Notice - Undefined variable: post in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\_form.php on line 33
ERROR - 2018-08-21 10:30:35 --> Notice - Undefined variable: model in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\index.php on line 52
ERROR - 2018-08-21 10:32:00 --> Notice - Undefined variable: model in C:\xampp\htdocs\fu_cms\fuel\app\views\admin\blog\category\index.php on line 52
ERROR - 2018-08-21 10:48:14 --> Error - Class 'Cachea' not found in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 27
ERROR - 2018-08-21 10:59:43 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:00:12 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:00:46 --> Error - Call to a member function cached() on array in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 90
ERROR - 2018-08-21 11:01:10 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:28:01 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:28:14 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:28:16 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:28:17 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:30:39 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:30:41 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:30:52 --> Error - Call to a member function fetchAll() on array in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\cached.php on line 31
ERROR - 2018-08-21 11:35:13 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:35:20 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:35:31 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:35:38 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:35:45 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:36:00 --> Notice - Undefined variable: categories in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 19
ERROR - 2018-08-21 11:36:09 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:36:34 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:37:57 --> Error - syntax error, unexpected 'Cache' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 32
ERROR - 2018-08-21 11:37:59 --> Error - syntax error, unexpected 'Cache' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 32
ERROR - 2018-08-21 11:38:08 --> Error - syntax error, unexpected 'Cache' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 32
ERROR - 2018-08-21 11:38:38 --> Error - syntax error, unexpected 'Cache' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 32
ERROR - 2018-08-21 11:39:10 --> Error - Arr::merge() - all arguments must be arrays. in C:\xampp\htdocs\fu_cms\fuel\core\classes\arr.php on line 873
ERROR - 2018-08-21 11:45:50 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 11:46:48 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:47:09 --> Error - not found in C:\xampp\htdocs\fu_cms\fuel\core\classes\cache\storage\driver.php on line 282
ERROR - 2018-08-21 11:53:19 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 11:53:33 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 11:53:34 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 11:53:35 --> Notice - Undefined variable: title in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 10
ERROR - 2018-08-21 17:17:17 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 17:18:19 --> Error - Invalid method call.  Method validate does not exist. in C:\xampp\htdocs\fu_cms\fuel\packages\orm\classes\model.php on line 740
ERROR - 2018-08-21 17:20:26 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 17:55:19 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to undefined method Fuel\Core\Html::test() in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 17:57:38 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Using $this when not in object context in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 17:57:51 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 17:59:06 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 17:59:29 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:00:37 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:02:06 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:03:03 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:04:53 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:04:56 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:06:27 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:07:45 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Call to a member function get_config() on null in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:10:04 --> Error - File "APPPATH/\classes\shtml.php" does not contain class "Shtml" in C:\xampp\htdocs\fu_cms\fuel\core\classes\autoloader.php on line 397
ERROR - 2018-08-21 18:10:21 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Undefined constant 'Fuel\Core' in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:10:27 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected '\' (T_NS_SEPARATOR), expecting identifier (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-21 18:10:30 --> Error - File "APPPATH/\classes\shtml.php" does not contain class "Shtml" in C:\xampp\htdocs\fu_cms\fuel\core\classes\autoloader.php on line 397
ERROR - 2018-08-21 18:31:23 --> shutdown - The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver. in C:\xampp\htdocs\fu_cms\fuel\core\classes\session\driver.php on 626
ERROR - 2018-08-21 18:53:21 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test', 'test', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:53:41 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test', 'test', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:53:48 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:56:01 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:56:30 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:57:04 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:57:11 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 18:57:17 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'parent_id' cannot be null with query: "INSERT INTO `fu_blog_categories` (`title`, `slug`, `summary`, `body`, `status`, `parent_id`, `image`) VALUES ('test123', 'test123', '', '', null, null, '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-21 19:46:12 --> Error - Argument 1 passed to Blog\Model_Blog_Category::_event_after_save() must be an instance of Blog\Orm\Model, none given in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 93
ERROR - 2018-08-21 19:46:33 --> Warning - Missing argument 1 for Blog\Model_Blog_Category::_event_after_save() in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 93
ERROR - 2018-08-21 19:46:42 --> Warning - Missing argument 1 for Blog\Model_Blog_Category::_event_after_save() in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 93
ERROR - 2018-08-21 19:49:18 --> Error - Call to undefined method Blog\Model_Blog_Category::factory() in C:\xampp\htdocs\fu_cms\fuel\packages\orm\classes\model.php on line 1144
ERROR - 2018-08-21 19:49:40 --> Error - Class 'Blog\Blog\Model_Blog_Category' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\blog\classes\model\blog\category.php on line 95
ERROR - 2018-08-21 19:50:46 --> Error - Call to undefined method Blog\Model_Blog_Category::factory() in C:\xampp\htdocs\fu_cms\fuel\packages\orm\classes\model.php on line 1144
ERROR - 2018-08-21 20:01:35 --> Error - syntax error, unexpected 'echo' (T_ECHO) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 16
ERROR - 2018-08-21 20:01:48 --> Error - syntax error, unexpected 'echo' (T_ECHO) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 16
ERROR - 2018-08-21 20:01:57 --> Error - syntax error, unexpected 'print_r' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 16
ERROR - 2018-08-21 20:02:12 --> Error - syntax error, unexpected 'print_r' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 16
ERROR - 2018-08-21 20:02:22 --> Error - syntax error, unexpected 'print_r' (T_STRING) in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 16
ERROR - 2018-08-21 20:02:33 --> Error - syntax error, unexpected '}' in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 17
ERROR - 2018-08-21 20:02:39 --> Error - syntax error, unexpected '}' in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 17
ERROR - 2018-08-21 20:03:04 --> Error - syntax error, unexpected '}' in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 18
ERROR - 2018-08-21 20:04:20 --> Notice - Undefined variable: delete_selected in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 18
ERROR - 2018-08-21 20:24:48 --> Error - Call to undefined method Orm\Query::execute() in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 23
ERROR - 2018-08-21 20:27:43 --> Notice - Undefined variable: id in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\admin\blog\category.php on line 30
ERROR - 2018-08-21 20:28:58 --> 42000 - SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'null' at line 1 with query: "SELECT `fu_t0`.`id` AS `t0_c0`, `fu_t0`.`title` AS `t0_c1`, `fu_t0`.`slug` AS `t0_c2`, `fu_t0`.`summary` AS `t0_c3`, `fu_t0`.`body` AS `t0_c4`, `fu_t0`.`status` AS `t0_c5`, `fu_t0`.`parent_id` AS `t0_c6`, `fu_t0`.`image` AS `t0_c7` FROM `fu_blog_categories` AS `fu_t0` WHERE `fu_t0`.`id` IN null" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
