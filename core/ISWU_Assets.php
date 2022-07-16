<?php

namespace ISWU_Core;

class ISWU_Assets {

	/**
	 * Inits assets.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
	}

	/**
	 * Enqueues scripts.
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		/** Includes styles. */
		wp_enqueue_style(
			IBRYL_SWITCH_USER_PLUGIN_SLUG . '-css',
			IBRYL_SWITCH_USER_DIR_PATH . 'assets/css/iswu-main.min.css',
			[],
			IBRYL_SWITCH_USER_VERSION
		);
		/** Includes scripts. */
		wp_enqueue_script(
			IBRYL_SWITCH_USER_PLUGIN_SLUG . '-js',
			IBRYL_SWITCH_USER_DIR_PATH . 'assets/js/iswu-main.min.js',
			[ 'jquery' ],
			IBRYL_SWITCH_USER_VERSION,
			true
		);
		/** Localize scripts. */
		wp_localize_script(
			IBRYL_SWITCH_USER_PLUGIN_SLUG . '-js',
			IBRYL_SWITCH_USER_PLUGIN_SHORT_NAME,
			[
				'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
				'pluginSlug'      => IBRYL_SWITCH_USER_PLUGIN_SLUG,
				'pluginShortName' => IBRYL_SWITCH_USER_PLUGIN_SHORT_NAME,
			]
		);
	}
}