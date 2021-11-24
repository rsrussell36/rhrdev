<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Arise{

	const UPLOADS_DIR = '/rhrs/';
	private static $instance = null;
	public $transient_widgets;
	public $rhrs_registered_widgets;


	public function __construct(){
        $this->rhrs_registered_widgets = $this->rhrs__registered_widgets();

		$this->transient_widgets = [];
		$this->transient_extensions = [];
		if(!defined('RHRS__PREMIUM')){
			add_action('elementor/frontend/before_render', array($this, 'collect_transient_widgets'));
		}

        add_action('wp_print_footer_scripts', array($this, 'generate_scripts_frontend'));

		add_action( 'admin_bar_menu', [ $this, 'rhrs_cache_admin_bar' ], 300 );
		add_action('wp_ajax_rhrs_purge_current_clear', array($this, 'rhrs_current_page_clear_cache'));

		if(is_user_logged_in()){
			add_action( 'wp_head', [ $this, 'rhrs_purge_clear_print_style' ]);
		}

		add_action('wp_enqueue_scripts', [$this, 'rhrs_enqueue_scripts']);

		if (is_admin()) {
			add_action('wp_ajax_rhrs_clear_cache', array($this, 'rhrs_remove_clear_caches_files'));
			add_action('wp_ajax_backend_clear_cache', array($this, 'rhrs_backend_clear_cache'));
		}
    }

	public static function get_wp_uploads_dir() {
        return wp_upload_dir();
    }
    public static function get_base_uploads_dir() {
        $wp_upload_dir = self::get_wp_uploads_dir();
        return $wp_upload_dir['basedir'] . DIRECTORY_SEPARATOR . self::UPLOADS_DIR;
    }
    public static function get_base_uploads_url() {
        $wp_upload_dir = self::get_wp_uploads_dir();
        return $wp_upload_dir['baseurl'] . self::UPLOADS_DIR;
    }
    public static function set_files_dir() {
        return self::get_base_uploads_dir();
    }
    public static function set_files_url() {
        return self::get_base_uploads_url();
    }
    public function _cache_dir_name() {
        return $this->set_files_dir();
    }
    public function _cache_url_name() {
        return $this->set_files_url();
    }
    public function collect_transient_widgets($widget)
    {
        if($widget->get_name() === 'global') {
            $global_widget = new \ReflectionClass(get_class($widget));
            $template_data = $global_widget->getProperty('template_data');

            $template_data->setAccessible(true);

            if($data_global = $template_data->getValue($widget)) {
				$widget_name=$this->get_global_widgets_use($data_global['content']);
				$widget_options=in_array($widget_name[0],array_keys($this->rhrs_registered_widgets));
                $this->transient_widgets = array_merge($this->transient_widgets, $widget_name);
            }
        } else {
            $this->transient_widgets[] = $widget->get_name();
			$widget_options=in_array($widget->get_name(),array_keys($this->rhrs_registered_widgets));
		}
    }

	public function rhrs_merge_files($paths = [], $file = 'rhrs-style.min.css',$type='')
    {

        $output = '';

        if (!empty($paths)) {
            foreach ($paths as $path) {
                $output .= file_get_contents($this->secure_path_url($path));
            }
        }

		if(!empty($type) && $type=='css'){
			// Remove comments
			$output = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $output);
			// Remove space after colons
			$output = str_replace(': ', ':', $output);
			// Remove whitespace
			$output = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $output);
			//Remove Last Semi colons
			$output = preg_replace('/;}/', '}', $output);
		}

        return file_put_contents($this->secure_path_url($this->_cache_dir_name() . DIRECTORY_SEPARATOR . $file), $output);
    }
    public function rhrs_generate_scripts($elements, $file_name = null)
    {

        if (empty($elements)) {
            return;
        }

        if (!file_exists($this->_cache_dir_name())) {
            wp_mkdir_p($this->_cache_dir_name());
        }

        // default load js and css (editor and every widget)
        $js_url = array(
        	//CREST_WIDGETS . 'common/wow/wow.min.js',
        	CREST_PATH . 'assets/general/rhrs.min.js',
        );
        $css_url = array(
        	//CREST_WIDGETS . 'common/animation/animate.css',
			CREST_PATH . "assets/general/rhr.min.css",
        );
        // collect dependancy css and js
        $js_url = array_merge($js_url, $this->rhrs_dependency_widgets($elements, 'js'));
        $css_url = array_merge($css_url, $this->rhrs_dependency_widgets($elements, 'css'));

        // merge widgets files
        $this->rhrs_merge_files($css_url, ($file_name ? $file_name : 'rhrs') . '.min.css','css');
        $this->rhrs_merge_files($js_url, ($file_name ? $file_name : 'rhrs') . '.min.js','js');
    }
    public function check_cache_files($post_type = null, $post_id = null)
    {

        $css_url = $this->_cache_dir_name() . DIRECTORY_SEPARATOR . ($post_type ? 'rhrs-' . $post_type : 'rhrs') . ($post_id ? '-' . $post_id : '') . '.min.css';
        $js_url = $this->_cache_dir_name() . DIRECTORY_SEPARATOR . ($post_type ? 'rhrs-' . $post_type : 'rhrs') . ($post_id ? '-' . $post_id : '') . '.min.js';

        if (is_readable($this->secure_path_url($css_url)) && is_readable($this->secure_path_url($js_url))) {
			return true;
        }
        return false;
    }
    public function rhrs_dependency_widgets(array $elements, $type)
    {
        $paths = [];
		if(has_filter('rhrs_pro_registered_widgets')) {
			$this->rhrs_registered_widgets = apply_filters('rhrs_pro_registered_widgets', $this->rhrs_registered_widgets );
		}
        foreach ($elements as $element) {
            if (isset($this->rhrs_registered_widgets[$element])) {
                if (!empty($this->rhrs_registered_widgets[$element]['dependency'][$type])) {
                    foreach ($this->rhrs_registered_widgets[$element]['dependency'][$type] as $path) {
                        $paths[] = $path;
                    }
                }
            } elseif (isset($this->registered_extensions[$element])) {
                if (!empty($this->registered_extensions[$element]['dependency'][$type])) {
                    foreach ($this->registered_extensions[$element]['dependency'][$type] as $path) {
                        $paths[] = $path;
                    }
                }
            }
        }

        return array_unique($paths);
    }
    public function get_global_widgets_use($widgets) {
        $get_widget = [];

        array_walk_recursive($widgets, function($val, $key) use (&$get_widget) {
            if($key == 'widgetType') {
                $get_widget[] = $val;
            }
        });

        return $get_widget;
    }
    public function generate_scripts_frontend()
    {

        if ($this->is_preview_mode()) {
            return;
        }

        $replace = [
            'rhrs-woocommerce' => 'product-rhrs',
        ];
        //Pro
		if(has_filter('rhrs_pro_transient_widgets')) {
			$this->transient_widgets = apply_filters('rhrs_pro_transient_widgets', $this->transient_widgets);
		}

        $elements = array_map(function ($val) use ($replace) {
			$val = str_replace(['rhrs-'], [''], $val);
		    return (array_key_exists($val, $replace) ? $replace[$val] : $val);
        }, $this->transient_widgets);
		// Pro Hook
		if(has_filter('rhrs_pro_registered_widgets')) {
			$this->rhrs_registered_widgets = apply_filters('rhrs_pro_registered_widgets', $this->rhrs_registered_widgets );
		}

        $elements = array_intersect(array_keys($this->rhrs_registered_widgets), $elements);

        $extensions = apply_filters('rhrs/section/after_render', $this->transient_extensions);

        $elements = array_unique(array_merge($elements, $extensions));

		global $wp_query;
        if (is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404()) {

            $queried_object = get_queried_object_id();
			if(is_search()){
				$queried_object = 'search';
			}
			if(is_404()){
				$queried_object = '404';
			}
            $post_type = (is_singular() ? 'post' : 'term');
            $old_elements = (array) get_metadata($post_type, $queried_object, 'rhrs_transient_widgets', true);

            // sort two array for compare
            sort($elements);
            sort($old_elements);

            if ($old_elements != $elements) {

                update_metadata($post_type, $queried_object, 'rhrs_transient_widgets', $elements);

                // if not empty widgets, regenerate cache files
                if (!empty($elements)) {
                    $this->rhrs_generate_scripts($elements, 'rhrs-' . $post_type . '-' . $queried_object);

                    // load generated files - fallback
                    $this->enqueue_frontend_load($queried_object, $post_type);
                }
            }

            // if no cache files, generate new
            if (!$this->check_cache_files($post_type, $queried_object)) {
                $this->rhrs_generate_scripts($elements, 'rhrs-' . $post_type . '-' . $queried_object);
            }

            // if no widgets, remove cache files
            if (empty($elements)) {
               $this->remove_files_unlink($post_type, $queried_object);
            }
        }
    }
    public function rhrs_enqueue_scripts()
	{
		if ( is_admin_bar_showing() ) {
			wp_enqueue_script(
				'rhrs-purge-js',
				$this->plugin_path_security(CREST_URL . 'assets/general/purge.min.js'),
				['jquery'],
				CREST_VERSION,
				true
			);
			echo '<script> var rhrs_ajax_url = "'.admin_url("admin-ajax.php").'";
			var rhrs_nonce = "'.wp_create_nonce("rhrs-addons").'";</script>';
		}

		if ($this->is_preview_mode()) {

			// generate fallback scripts
			if (!$this->check_cache_files()) {
				$rhrs_widget_settings = $this->get_rhrs_widget_settings();
				//pro
				if(has_filter('rhrs_widget_settings')) {
					$rhrs_widget_settings = apply_filters('rhrs_widget_settings', $rhrs_widget_settings);
				}
				$this->rhrs_generate_scripts($rhrs_widget_settings);
			}
			// enqueue scripts

			if ($this->check_cache_files()) {
				$css_file = $this->_cache_url_name() . 'rhrs.min.css';
				$js_file = $this->_cache_url_name() . 'rhrs.min.js';
			} else {
				$css_file = CREST_URL . 'assets/general/rhrs.min.css';
				$js_file = CREST_URL . 'assets/general/rhrs.min.js';
			}
			wp_enqueue_style(
				'rhrs-editor-css',
				$this->plugin_path_security($css_file),
				false,
				CREST_VERSION
			);

			wp_enqueue_script(
				'rhrs-editor-js',
				$this->plugin_path_security($js_file),
				['jquery'],
				CREST_VERSION,
				true
			);
			echo '<script> var rhrs_ajax_url = "'.admin_url('admin-ajax.php').'";</script>';
			//extended assets hook
			do_action('rhrs/after_enqueue_scripts', $this->check_cache_files());

		} else {
			global $wp_query;
			if (is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404()) {

				$queried_obj = get_queried_object_id();
				if(is_search()){
					$queried_obj = 'search';
				}
				if(is_404()){
					$queried_obj = '404';
				}
				$post_type = (is_singular() ? 'post' : 'term');
				$elements = (array) get_metadata($post_type, $queried_obj, 'rhrs_transient_widgets', true);

				if (empty($elements)) {
					return;
				}
				$this->enqueue_frontend_load($post_type, $queried_obj);
			}
		}
	}
	protected function enqueue_frontend_load($post_type, $queried_obj)
	{
		if ($this->check_cache_files($post_type, $queried_obj)) {
			$css_file = $this->_cache_url_name() . 'rhrs-' . $post_type . '-' . $queried_obj . '.min.css';
			$js_file = $this->_cache_url_name() . 'rhrs-' . $post_type . '-' . $queried_obj . '.min.js';
		} else {
			if (file_exists($this->_cache_dir_name() . 'rhrs.min.css') && file_exists($this->_cache_dir_name() . 'rhrs.min.js')) {
				$css_file = $this->_cache_url_name() . 'rhrs.min.css';
				$js_file = $this->_cache_url_name() . 'rhrs.min.js';
			}else{
				$css_file = CREST_URL . 'assets/general/rhrs.min.css';
				$js_file = CREST_URL . 'assets/general/rhrs.min.js';
			}
		}
		$auspicous_version = get_post_meta( $queried_obj, '_elementor_css', true );
		if(!empty($auspicous_version) && !empty($auspicous_version['time'])){
			$auspicous_version = $auspicous_version['time'];
		}else{
			$auspicous_version = time();
		}

		wp_enqueue_style('rhrs-front-'.$post_type,$css_file,false,$auspicous_version);

		wp_enqueue_script('rhrs-front-'.$post_type,$js_file,['jquery'],$auspicous_version,true);

		echo '<script> var rhrs_ajax_url = "'.admin_url('admin-ajax.php').'";</script>';
		//extended assets hook
		do_action('rhrs/after_enqueue_scripts', $this->check_cache_files($post_type, $queried_obj));
	}
	public function rhrs_remove_clear_caches_files()
    {
		check_ajax_referer('rhrs_nonce', 'security');
		$this->remove_dir_files($this->_cache_dir_name());
		wp_send_json(true);
    }
    public function rhrs_backend_clear_cache()
    {
		check_ajax_referer('rhrs_nonce', 'security');
		$this->remove_backend_dir_files();
		wp_send_json(true);
    }
    public function rhrs_current_page_clear_cache()
    {

		check_ajax_referer('rhrs-addons', 'security');

		$rhrs_name = '';
		if(isset($_POST['rhrs_name']) && !empty($_POST['rhrs_name'])){
			$rhrs_name = $_POST['rhrs_name'];
		}
		if( $rhrs_name == 'rhrs-all') {
			// remove All cache files
			$this->remove_dir_files($this->_cache_dir_name());
		}else {
			// Current Page cache files
			$this->remove_current_page_dir_files( $this->_cache_dir_name(), $rhrs_name );
		}
		wp_send_json(true);
    }
    public function plugin_path_security($url) {
        return preg_replace(['/^http:/', '/^https:/', '/(?!^)\/\//'], ['', '', '/'], $url);
    }
    public function rhrs_cache_admin_bar( \WP_Admin_Bar $wp_admin_bar ) {

		global $wp_admin_bar;

		if ( ! is_super_admin()
			 || ! is_object( $wp_admin_bar )
			 || ! function_exists( 'is_admin_bar_showing' )
			 || ! is_admin_bar_showing() ) {
			return;
		}

		$queried_obj = get_queried_object_id();
		if(is_search()){
			$queried_obj = 'search';
		}
		if(is_404()){
			$queried_obj = '404';
		}
		$post_type = (is_singular() ? 'post' : 'term');

		if (file_exists($this->_cache_dir_name() . '/rhrs-' . $post_type . '-' . $queried_obj . '.min.css') || file_exists($this->_cache_dir_name() . '/rhrs-' . $post_type . '-' . $queried_obj . '.min.js')) {

				//Parent
				$wp_admin_bar->add_node( [
					'id'	=> 'rhrs-purge-clear',
					'meta'	=> array(
						'class' => 'rhrs-purge-clear',
					),
					'title' => esc_html__( 'RHR Performance', 'rhrs' ),

				] );

				//Child Item
				$args = array();
				array_push($args,array(
					'id'		=>	'rhrs-purge-all-pages',
					'title'		=>	esc_html__( 'Purge All Pages', 'rhrs' ),
					'href'		=> 	'#clear-rhrs-all',
					'parent'	=>	'rhrs-purge-clear',
					'meta'   	=> 	array( 'class' => 'rhrs-purge-all-pages' ),
				));

				array_push($args,array(
					'id'     	=>	'rhrs_current_page',
					'title'		=>	esc_html__( 'Purge Current Page', 'rhrs' ),
					'href'		=>	'#clear-rhrs-' . $post_type . '-' . $queried_obj,
					'parent' 	=>	'rhrs-purge-clear',
					'meta'   	=>	array( 'class' => 'rhrs_current_page' ),
				));

				sort($args);
				foreach( $args as $each_arg) {
					$wp_admin_bar->add_node($each_arg);
				}
		}
	}
	public function rhrs_purge_clear_print_style() {
		if((is_admin_bar_showing())){
		?>
			<style>#wpadminbar .rhrs-purge-clear > .ab-item:before {content: '';background-image: url(<?php echo CREST_URL . 'assets/_images/purge_logo.png'; ?>) !important;background-size: 15px !important;background-position: center;width: 20px;height: 20px;background-repeat: no-repeat;top: 50%;transform: translateY(-50%);}</style>
		<?php
		}
	}
	public function is_preview_mode(){
        if (isset($_REQUEST['doing_wp_cron'])) {
            return true;
        }
        if (wp_doing_ajax()) {
            return true;
        }
        if (isset($_GET['elementor-preview'])) {
            return true;
        }
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'elementor') {
            return true;
        }

        return false;
    }
    public function remove_files_unlink($post_type = null, $post_id = null)
    {
        $css_path_url = $this->secure_path_url(CREST_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'rhrs-' . $post_type : 'ausoicious') . ($post_id ? '-' . $post_id : '') . '.min.css');
        $js_path_url = $this->secure_path_url(CREST_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'rhrs-' . $post_type : 'ausoicious') . ($post_id ? '-' . $post_id : '') . '.min.js');

        if (file_exists($css_path_url)) {
            unlink($css_path_url);
        }

        if (file_exists($js_path_url)) {
            unlink($js_path_url);
        }
    }
    public function secure_path_url($path_url)
    {
        $path_url = str_replace(['//', '\\\\'], ['/', '\\'], $path_url);

        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path_url);
    }
    public function remove_dir_files($path_url)
    {
        if (!is_dir($path_url) || !file_exists($path_url)) {
            return;
        }

        foreach (scandir($path_url) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            unlink($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . $item));
        }
    }
    public function remove_backend_dir_files()
    {
        if (file_exists($this->_cache_dir_name() . '/rhrs.min.css')) {
            unlink($this->secure_path_url($this->_cache_dir_name() . DIRECTORY_SEPARATOR . '/rhrs.min.css'));
        }
        if(file_exists($this->_cache_dir_name() . '/rhrs.min.js')){
            unlink($this->secure_path_url($this->_cache_dir_name() . DIRECTORY_SEPARATOR . '/rhrs.min.js'));
        }
    }
    public function remove_current_page_dir_files( $path_url, $rhrs_name = '' ) {

        if ((!is_dir($path_url) || !file_exists($path_url)) && empty($rhrs_name)) {
            return;
        }

        if (file_exists($path_url . '/'. $rhrs_name. '.min.css')) {
            unlink($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . '/'. $rhrs_name . '.min.css'));
        }
        if(file_exists($path_url . '/'. $rhrs_name. '.min.js')){
            unlink($this->secure_path_url($path_url. DIRECTORY_SEPARATOR . '/'. $rhrs_name . '.min.js'));
        }
    }
    public function get_rhrs_widget_settings($element = null)
    {
    	$_inactive       = _get_inactive();
    	//widget id replace database widget id
        $replace = [
            'posts' => 'rhr-posts',
            'breadcrumbs' => 'rhr-breadcrumbs',
        ];

        $merge = [
            'rhr-editor'
        ];
        $elements = array_keys($replace);

        $elements = array_map(function ($val) use ($replace) {
        	if ( ! in_array( $val, _get_inactive() ) ) {
	            return (array_key_exists($val, $replace) ? $replace[$val] : $val);
	        }
        }, $elements);

        $result =array_unique($merge);
        $elements =array_merge($result , $elements);
        return (isset($element) ? (isset($elements[$element]) ? $elements[$element] : 0) : array_filter($elements));
    }
    public function rhrs__registered_widgets(){
	    return apply_filters('rhrs/registered_widgets', [

	        'rhr-breadcrumbs' => [
	            'dependency' => [
	                'css' => [
						CREST_WIDGETS . 'breadcrumbs/css/breadcrumbs.css',
	                ],
	                'js' => [

	                ],
	            ],
	        ],
	        'rhr-posts' => [
	            'dependency' => [
	                'css' => [
										CREST_WIDGETS . 'common/animate.min.css',
										CREST_WIDGETS . 'posts/owl.carousel.min.css',
										CREST_WIDGETS . 'posts/posts.css',
	                ],
	                'js' => [
										CREST_WIDGETS . 'posts/owl.carousel.min.js',
	                	CREST_WIDGETS . 'posts/posts.js',
	                	CREST_WIDGETS . 'posts/posts.js',
	                ],
	            ],
	        ],
	    ]);
	}
}
