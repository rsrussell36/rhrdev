<?php
/*
Plugin Name: WordPress Importer Update
Plugin URI: http://kingscrestglobal.com/
Description: Update posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.
Author: King Crest Global
Author URI: https://kingscrestglobal.com/
Version: 1.0.0
Text Domain: wordpress-updater
License: GPLv3
*/

class RHRWPImporterUpdate {

	protected $existing_post;
	protected $path;

	function __construct() {
		add_filter( 'wp_import_existing_post', [ $this, 'wp_import_update_existing_post' ], 10, 2 );
		add_filter( 'wp_import_post_data_processed', [ $this, 'wp_import_update_post_data_processed' ], 10, 2 );
		add_action( 'admin_enqueue_scripts', [ $this, 'wp_import_update_enqueue' ] );
	}

	public function wp_import_update_existing_post( $post_id, $post ) {
		if ( $this->existing_post = $post_id ) {
			$post_id = 0; // force the post to be imported
		}
		return $post_id;
	}

	public function wp_import_update_post_data_processed( $postdata, $post ) {
		if ( $this->existing_post ) {
			// update the existing post
			$postdata['ID'] = $this->existing_post;
		}
		return $postdata;
	}
	public function wp_import_update_plugin_url($path = '')
    {
        $url = plugins_url( $path, __FILE__ );

        if ( is_ssl()
        and 'http:' == substr( $url, 0, 5 ) ) {
          $url = 'https:' . substr( $url, 5 );
        }
        return $url;
    }
	public function wp_import_update_enqueue(){
		wp_enqueue_script(
            'import-update-enqueue',
            $this->wp_import_update_plugin_url('wp-import-assign-authors.js'),
            ['jquery'],
            '1.0.0',
            true
        );
	}

}
new RHRWPImporterUpdate;