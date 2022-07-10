<?php

namespace Core;

class Bootstrap {

	/**
	 * inits core.
	 *
	 * @return void
	 */
	public static function init() {
		( new Ajax() );
		add_action( 'init', function () {
			if ( wp_doing_ajax() || is_user_logged_in() || is_admin() ) {
				( new Assets() );
			}
		} );
	}
}