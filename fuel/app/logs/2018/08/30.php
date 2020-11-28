<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2018-08-30 08:24:22 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\themes\backend\views\admin\shop\category\edit.php on line 1
ERROR - 2018-08-30 08:24:35 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\themes\backend\views\admin\shop\category\edit.php on line 1
ERROR - 2018-08-30 08:27:32 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 08:27:35 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 08:27:36 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 08:27:38 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 08:28:12 --> Error - The requested view could not be found: partials/blocks/cart_content.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 08:28:58 --> Notice - Undefined variable: theme_front in C:\xampp\htdocs\fu_cms\fuel\app\classes\controller\ajax.php on line 10
ERROR - 2018-08-30 08:35:11 --> Notice - Undefined variable: cart in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\partials\blocks\cart_content.php on line 2
ERROR - 2018-08-30 08:36:43 --> Notice - Undefined variable: cart in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\partials\blocks\cart_content.php on line 2
ERROR - 2018-08-30 08:38:52 --> Notice - Undefined variable: cart in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\partials\blocks\cart_content.php on line 2
ERROR - 2018-08-30 08:40:53 --> Notice - Undefined variable: cart in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\partials\blocks\cart_content.php on line 2
ERROR - 2018-08-30 10:29:20 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 11:19:18 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught ParseError: syntax error, unexpected '') this.value = this.defaultVa' (T_CONSTANT_ENCAPSED_STRING), expecting ')' in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 0
ERROR - 2018-08-30 12:05:11 --> Error - syntax error, unexpected '=>' (T_DOUBLE_ARROW) in C:\xampp\htdocs\fu_cms\fuel\cms\modules\order\classes\controller\order.php on line 81
ERROR - 2018-08-30 12:05:34 --> Notice - Undefined index: product in C:\xampp\htdocs\fu_cms\fuel\cms\modules\order\classes\controller\order.php on line 70
ERROR - 2018-08-30 12:05:41 --> Error - Property "id" not found for Order\Model_Order. in C:\xampp\htdocs\fu_cms\fuel\packages\orm\classes\model.php on line 1258
ERROR - 2018-08-30 12:06:37 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '2147483647-3' for key 'PRIMARY' with query: "INSERT INTO `fu_order_details` (`item_id`, `order_id`, `product_id`, `product_code`, `object_type`, `price`, `amount`, `extra`) VALUES ('2322626082', '3', 20, '', 'P', '160000', '1', '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:07:07 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '2147483647-4' for key 'PRIMARY' with query: "INSERT INTO `fu_order_details` (`item_id`, `order_id`, `product_id`, `product_code`, `object_type`, `price`, `amount`, `extra`) VALUES ('2322626082', '4', 20, '', 'P', '160000', '1', '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:08:10 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '0-0' for key 'PRIMARY' with query: "INSERT INTO `fu_order_details` (`product_id`, `product_code`, `object_type`, `price`, `amount`, `extra`) VALUES (21, '', 'P', '125000', '1', '')" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:15:37 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'updated_at' cannot be null with query: "INSERT INTO `fu_order_details` (`item_id`, `order_id`, `product_id`, `product_code`, `object_type`, `price`, `amount`, `extra`, `created_at`, `updated_at`) VALUES (1685985038, '7', 22, '11355', 'P', '130000', '1', '', 1535606137, null)" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:17:02 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'updated_at' cannot be null with query: "INSERT INTO `fu_orders` (`b_firstname`, `b_lastname`, `email`, `b_phone`, `b_address`, `created_at`, `updated_at`) VALUES ('GIang', 'Nguyen', 'nguyen.giang1702@gmail.com', '01666695902', '346 bến Vân đồn, P.1, Q.4', 1535606222, null)" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:19:33 --> Notice - Undefined variable: pagination in C:\xampp\htdocs\fu_cms\fuel\cms\themes\backend\views\modules\order\index.php on line 117
ERROR - 2018-08-30 12:29:19 --> Notice - Undefined variable: pagination in C:\xampp\htdocs\fu_cms\fuel\cms\themes\backend\views\modules\order\index.php on line 95
ERROR - 2018-08-30 12:36:35 --> 42S22 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'id' in 'where clause' with query: "SELECT * FROM `fu_orders` WHERE `id` = ''" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 12:37:32 --> 42S22 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'id' in 'where clause' with query: "SELECT * FROM `fu_orders` WHERE `id` = '8'" in C:\xampp\htdocs\fu_cms\fuel\core\classes\database\pdo\connection.php on line 223
ERROR - 2018-08-30 13:07:42 --> Fatal Error - Method Fuel\Core\View::__toString() must not throw an exception, caught Error: Class 'ehco\Kcart' not found in C:\xampp\htdocs\fu_cms\fuel\cms\themes\backend\layouts\template.html on line 0
ERROR - 2018-08-30 13:28:29 --> Notice - Undefined index: notes in C:\xampp\htdocs\fu_cms\fuel\cms\modules\order\classes\controller\order.php on line 72
ERROR - 2018-08-30 14:27:15 --> Error - Could not find asset: bootstrap-datetimepicker.min.js in C:\xampp\htdocs\fu_cms\fuel\core\classes\asset\instance.php on line 413
ERROR - 2018-08-30 15:10:01 --> Error - syntax error, unexpected '{', expecting ')' in C:\xampp\htdocs\fu_cms\fuel\app\classes\helper.php on line 35
ERROR - 2018-08-30 16:01:00 --> Error - Class 'Setting\Model_Setting' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\setting.php on line 76
ERROR - 2018-08-30 16:01:10 --> Error - Class 'Setting\Model_Setting' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\setting.php on line 76
ERROR - 2018-08-30 16:02:07 --> Error - Class 'Setting\Model_Setting' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\setting.php on line 76
ERROR - 2018-08-30 16:02:13 --> Error - Class 'Setting\Model_Setting' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\setting.php on line 76
ERROR - 2018-08-30 16:02:29 --> Error - Class 'Setting\Model_Setting' not found in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\setting.php on line 76
ERROR - 2018-08-30 16:29:22 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\shop.php on line 236
ERROR - 2018-08-30 16:29:31 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\shop.php on line 236
ERROR - 2018-08-30 16:51:06 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\shop.php on line 236
ERROR - 2018-08-30 16:51:21 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\shop.php on line 236
ERROR - 2018-08-30 16:51:41 --> Notice - Trying to get property of non-object in C:\xampp\htdocs\fu_cms\fuel\cms\modules\admin\classes\controller\shop.php on line 236
ERROR - 2018-08-30 17:12:30 --> Error - The requested view could not be found: layouts/partials/sidebar.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:14:16 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:14:37 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:14:41 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:15:47 --> Compile Error - Cannot redeclare Shop\Controller_Shop::action_index() in C:\xampp\htdocs\fu_cms\fuel\cms\modules\shop\classes\controller\shop.php on line 19
ERROR - 2018-08-30 17:16:24 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:16:40 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:17:04 --> Error - The requested view could not be found: shop/index.php in C:\xampp\htdocs\fu_cms\fuel\core\classes\view.php on line 492
ERROR - 2018-08-30 17:23:10 --> Notice - Undefined variable: content in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\layouts\default.php on line 19
ERROR - 2018-08-30 17:34:56 --> Notice - Undefined variable: shop_image_width in C:\xampp\htdocs\fu_cms\fuel\cms\themes\default\views\modules\shop\product\quick.php on line 6
