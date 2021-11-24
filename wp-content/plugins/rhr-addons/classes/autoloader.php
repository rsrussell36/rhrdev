<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Autoloader {

	private static $classes_map;

	public static function run() {
		spl_autoload_register([__CLASS__, 'rhr__autoload']);
	}

	public static function get_classes_map() {
		if(!self::$classes_map) {
			self::initial_classes_map();
		}
		return self::$classes_map;
	}

	public static function initial_classes_map() {
		self::$classes_map = [
			'Notice' => 'classes/class-notice.php',
			'Dashboard' => 'admin/class-dashboard.php',
			'Admin_Enqueue' => 'admin/class-admin-enqueue.php',
			'Locale' => 'admin/class-locale.php',
			'Enqueue' => 'classes/class-enqueue.php',
			'Utils' => 'classes/utils.php',
			'Integration' => 'classes/class-integration.php',
			'Template' => 'classes/class-template.php',
			'Editor' => 'classes/class-editor.php',
			'Arise' => 'components/arise/class-arise.php',
			'Query' => 'components/query/class-query.php',
		];
	}
	public static function rhr__components(){
		new Dashboard();
		new Admin_Enqueue();
        new Locale();
        new Enqueue();
        new Integration();
		new Query();
        new Editor();
        new Arise();
    }

	private static function rhr__load_class($relative_class_name) {
		$classes_map = self::get_classes_map();

		if(isset($classes_map[$relative_class_name])) {
			$filename = CREST_PATH . $classes_map[$relative_class_name];
		} else {
			$filename = strtolower(preg_replace(['/([a-z])([A-Z])/', '/_/', '/\\\/'], ['$1-$2', '-', "/"], $relative_class_name));
			$filename = CREST_PATH.$filename.'.php';
		}

		if(is_readable($filename)) {
			require $filename;
		}
	}

	private static function rhr__autoload($class) {
		if(0 !== strpos($class, __NAMESPACE__.'\\')) {
			return;
		}

		$relative_class_name = preg_replace('/^'.__NAMESPACE__.'\\\/', '', $class);
		$final_class_name = __NAMESPACE__.'\\'.$relative_class_name;

		if(!class_exists($final_class_name)) {
			self::rhr__load_class($relative_class_name);
		}
	}

}
