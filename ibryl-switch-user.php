<?php

/*
 * Plugin Name: iBryl Switch User
 * Plugin URI: https://wordpress.org/plugins/ibryl-switch-user/
 * Description: Its mini tips for quickly switch by users.
 * Version: 1.0.0
 * Author: Vitalii Bryl
 * Author URI: https://www.linkedin.com/in/ibryl/
 * License: A "ibryl-switch-user" license name e.g. GPL2
*/

namespace ISWU_Core;

define( 'IBRYL_SWITCH_USER_PLUGIN_SLUG', 'plugin-switch-user' );
define( 'IBRYL_SWITCH_USER_PLUGIN_SHORT_NAME', 'iswu' );
define( 'IBRYL_SWITCH_USER_VERSION', "1.0.1" );
define( 'IBRYL_SWITCH_USER_DIR_PATH', plugin_dir_url( __FILE__ ) );

require_once 'core/ISWU_Bootstrap.php';
require_once 'core/ISWU_Ajax.php';
require_once 'core/ISWU_Assets.php';

ISWU_Bootstrap::init();
