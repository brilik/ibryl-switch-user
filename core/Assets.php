<?php

namespace Core;

class Assets {

	/**
	 * Init assets.
	 */
	public function __construct() {
		add_action( 'get_header', [ $this, 'render' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
	}

	/**
	 * todo: need include template
	 *
	 * @return void
	 */
	public function render() {
		echo '<div id="' . IBRYL_SWITCH_USER_PLUGIN_NAME . '" class="close hidden"></div>';
	}

	/**
	 * Enqueues scripts.
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		/** Includes styles. */
		wp_enqueue_style(
			IBRYL_SWITCH_USER_PLUGIN_NAME . '-css',
			IBRYL_SWITCH_USER_DIR_PATH . 'assets/css/iswu-main.min.css',
			[],
			IBRYL_SWITCH_USER_VERSION
		);
		/** Includes scripts. */
		wp_enqueue_script(
			IBRYL_SWITCH_USER_PLUGIN_NAME . '-js',
			IBRYL_SWITCH_USER_DIR_PATH . 'assets/js/iswu-main.min.js',
			[ 'jquery' ],
			IBRYL_SWITCH_USER_VERSION,
			true
		);
		/** Localize scripts. */
		wp_localize_script(
			IBRYL_SWITCH_USER_PLUGIN_NAME . '-js',
			'iswu',
			[
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'pluginName' => IBRYL_SWITCH_USER_PLUGIN_NAME,
			]
		);
	}
}